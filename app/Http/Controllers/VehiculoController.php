<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::with('conductor')->orderBy('id', 'desc')->paginate(10);
        return view("operativos.vehiculo.index", compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $conductores=Conductor::where("estado","!=","ocupado")->get();
        return view("operativos.vehiculo.create",compact('conductores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'modelo' => 'required',
            'marca' => 'required',
            'placa' => 'required',
            'numero_de_seguro' => 'required',
            'fecha_vencimiento_seguro' => 'required|date',
            'estado' => 'required',
            'id_conductor' => 'required',

        ]);
         $actualizarEstadoConductor=Conductor::find($request->id_conductor);
         $actualizarEstadoConductor->estado="ocupado";
         $actualizarEstadoConductor->update();

        $vehiculo =Vehiculo::create($validatedData);

        if ($vehiculo) {
            return redirect()->route('vehiculo.index')->with('success', 'vehiculo creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el cliente.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $conductores=Conductor::where("estado","!=","ocupado")->get();
        $vehiculo = Vehiculo::find($request->id_vehiculo);
        return view("operativos.vehiculo.edit", compact('vehiculo','conductores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vehiculo $vehiculo)
    {
        $validatedData = $request->validate([
            'modelo' => 'required',
            'marca' => 'required',
            'placa' => 'required',
            'numero_de_seguro' => 'required',
            'fecha_vencimiento_seguro' => 'required|date',
            'estado' => 'required',
            'id_conductor' => 'required',

        ]);


        // Actualizar el vehiculo y guardar los datos
        $vehiculo->update($validatedData);

        // Verificar si el vehiculo fue actualizado correctamente
        if ($vehiculo) {
            return redirect()->route('vehiculo.index')->with('success', 'vehiculo actualizado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al actualizar el vehiculo.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehiculo=Vehiculo::findOrFail($id);
        $vehiculo->estado='inactivo';
        $vehiculo->update();
        return redirect()->route('vehiculo.index');
    }
}
