<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Conductor;
use App\Models\Servicio;
use App\Models\SolicitarServicio;
use Illuminate\Http\Request;

class SolicitarServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas=SolicitarServicio::orderBy('id', 'desc')->paginate(10);
        return view("operativos.reserva.index",compact("reservas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servicios=Servicio::all();
        $clientes=Cliente::all();
        $conductores=Conductor::where("estado","=","libre")->get();
        return view("operativos.reserva.create",compact('servicios','clientes','conductores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha_solicitud' => 'required',
            'fecha_servicio' => 'required',
            'costo_adicional' => 'required',
            'origen' => 'required',
            'destino' => 'required',
            'estado' => 'required',
            'tipo_servicio' => 'required',
            'id_cliente'=>'required',
            'id_servicio'=>'required',
            'id_conductor'=>'required',


        ]);


        $reserva =SolicitarServicio::create($validatedData);

        if ($reserva) {
            return redirect()->route('reserva.index')->with('success', 'reserva creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el cliente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SolicitarServicio $solicitarServicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $servicios=Servicio::all();
        $clientes=Cliente::all();
        $conductores=Conductor::where("estado","=","libre")->get();
        $reserva=SolicitarServicio::find($request->id_reserva);
        return view("operativos.reserva.edit",compact('servicios','clientes','conductores','reserva'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SolicitarServicio $reserva)
    {
        // dd($request->all());
       // Validar los datos del formulario
       $validatedData = $request->validate([
        'fecha_solicitud' => 'required',
        'fecha_servicio' => 'required',
        'costo_adicional' => 'required',
        'origen' => 'required',
        'destino' => 'required',
        'estado' => 'required',
        'tipo_servicio' => 'required',
        'id_cliente'=>'required',
        'id_servicio'=>'required',
        'id_conductor'=>'required',


    ]);
    // Actualizar el vehiculo y guardar los datos
    $reserva->update($validatedData);

    // Verificar si el reserva fue actualizado correctamente
    if ($reserva) {
        return redirect()->route('reserva.index')->with('success', 'reserva actualizado correctamente');
    } else {
        return redirect()->back()->withErrors(['msg' => 'Error al actualizar el vehiculo.']);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $reserva=SolicitarServicio::find($id);
       $reserva->estado="cancelado";
       $reserva->update();
       return redirect()->route("reserva.index");
    }
}
