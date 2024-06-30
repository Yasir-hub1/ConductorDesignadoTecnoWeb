<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Servicio;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promociones = Promocion::with('servicio')->orderBy('id', 'desc')->paginate(10);
        return view("operativos.promocion.index", compact('promociones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servicios=Servicio::all();
        return view("operativos.promocion.create",compact('servicios'));
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
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'descuento' => 'required',
            'id_servicio' => 'required',

        ]);


        $promo =Promocion::create($validatedData);

        if ($promo) {
            return redirect()->route('promocion.index')->with('success', 'promocion creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el promocion.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $servicios=Servicio::all();
        $promocion = Promocion::find($request->id_promocion);
        return view("operativos.promocion.edit", compact('promocion','servicios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promocion $promocion)
    {
         // Validar los datos del formulario
         $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'descuento' => 'required',
            'id_servicio' => 'required',

        ]);


        $promocion->update($validatedData);

        if ($promocion) {
            return redirect()->route('promocion.index')->with('success', 'promocion creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el promocion.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $promocion=Promocion::findOrFail($id);
        $promocion->delete();
        return redirect()->route('promocion.index');
    }
}
