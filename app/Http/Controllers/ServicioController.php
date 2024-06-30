<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios=Servicio::orderBy('id', 'desc')->paginate(10);
          return view("operativos.servicio.index",compact("servicios"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("operativos.servicio.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',


        ]);


        $servicio =Servicio::create($validatedData);

        if ($servicio) {
            return redirect()->route('servicio.index')->with('success', 'Servicio creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el Servicio.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $servicio = Servicio::find($request->id_servicio);
        return view("operativos.servicio.edit",compact('servicio'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',


        ]);


        $servicio->update($validatedData);

        if ($servicio) {
            return redirect()->route('servicio.index')->with('success', 'Servicio creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el Servicio.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $servicio=Servicio::findOrFail($id);

        $servicio->delete();
        return redirect()->route('servicio.index');
    }
}
