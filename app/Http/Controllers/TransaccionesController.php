<?php

namespace App\Http\Controllers;

use App\Models\GastoOperativo;
use App\Models\MetodoDePago;
use App\Models\SolicitarServicio;
use App\Models\transacciones;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaccionesController extends Controller
{
    public function guardarPagoDeReserva(Request $request)
    {

        $metodoPago = new MetodoDePago();
        $metodoPago->tipo_de_metodo_de_pago = $request->tipo_de_metodo_de_pago;
        $metodoPago->numero_tarjeta = $request->numero_tarjeta;
        $metodoPago->nombre_en_la_tarjeta = $request->nombre_en_la_tarjeta;
        $metodoPago->fecha_vencimiento = $request->fecha_vencimiento;
        $metodoPago->cvv_cvc = $request->cvv_cvc;
        $metodoPago->id_cliente = auth()->user()->id;
        $metodoPago->save();

        $transaccion = new transacciones();
        $transaccion->id_solicitar = $request->id_reserva;
        $transaccion->fecha = Carbon::now();
        $transaccion->monto = $request->monto;
        $transaccion->estado = $request->estado;
        $transaccion->id_metodo = $metodoPago->id;
        $transaccion->save();

        return  redirect()->route('cliente.inicio');
    }

    public function showPago(Request $request)
    {
        // Obtener la solicitud de servicio por ID con la transacción y el método de pago
        $solicitud = SolicitarServicio::with(['transaccion.metodoPago'])->findOrFail($request->id_reserva);

        //   dd($solicitud);
        return view("view-cliente.views.showPago", compact('solicitud'));
    }





    public function reportes(Request $request)
    {
        // Obtén los tipos de pago y los montos totales
        /*    $datos = \DB::table('transacciones')
            ->join('metodo_de_pago', 'transacciones.id_metodo', '=', 'metodo_de_pago.id')
            ->select('metodo_de_pago.tipo_de_metodo_de_pago', \DB::raw('SUM(transacciones.monto) as total_monto'))
            ->groupBy('metodo_de_pago.tipo_de_metodo_de_pago')
            ->get();

        // Prepara los datos para el gráfico
        $tiposDePago = $datos->pluck('tipo_de_metodo_de_pago');
        $montos = $datos->pluck('total_monto');

        return view('reporte-estadisticas.index', compact('tiposDePago', 'montos')); */

        // Obtener las transacciones y métodos de pago para los filtros
        // Obtener métodos de pago
        $metodosDePago = MetodoDePago::all();

        // Crear la consulta base
        $query = transacciones::join('metodo_de_pago', 'transacciones.id_metodo', '=', 'metodo_de_pago.id')
            ->select('metodo_de_pago.tipo_de_metodo_de_pago', \DB::raw('SUM(transacciones.monto) as total_monto'))
            ->groupBy('metodo_de_pago.tipo_de_metodo_de_pago');

        // Aplicar filtros de fecha
        if ($request->fecha_inicio && $request->fecha_fin) {
            $fechaInicio = Carbon::parse($request->fecha_inicio)->startOfDay();
            $fechaFin = Carbon::parse($request->fecha_fin)->endOfDay();
            $query->whereBetween('transacciones.fecha', [$fechaInicio, $fechaFin]);
        }

        // Aplicar filtro de método de pago
        if ($request->metodo_pago) {
            $query->where('metodo_de_pago.tipo_de_metodo_de_pago', $request->metodo_pago);
        }

        // Obtener los resultados de la consulta
        $transacciones = $query->get();

        // Datos para el gráfico
        $labels = $transacciones->pluck('tipo_de_metodo_de_pago');
        $data = $transacciones->pluck('total_monto');



        // Crear la consulta base para gastos operativos
        $gastosOperativosQuery = GastoOperativo::select('fecha', \DB::raw('SUM(monto) as total_monto'))
            ->groupBy('fecha')
            ->orderBy('fecha');

        // Aplicar filtros de fecha a gastos operativos
        if ($request->fecha_inicio && $request->fecha_fin) {
            $gastosOperativosQuery->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }

        // Obtener los resultados de la consulta de gastos operativos
        $gastosOperativos = $gastosOperativosQuery->get();

        // Datos para el gráfico de gastos operativos
        $labelsGastosOperativos = $gastosOperativos->pluck('fecha');
        $dataGastosOperativos = $gastosOperativos->pluck('total_monto');

        return view('reporte-estadisticas.index', [
            'transacciones' => $transacciones,
            'metodosDePago' => $metodosDePago,
            'labels' => $labels,
            'data' => $data,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'metodo_pago_id' => $request->metodo_pago_id,
            'labelsGastosOperativos' => $labelsGastosOperativos,
            'dataGastosOperativos' => $dataGastosOperativos,
        ]);
    }
}
