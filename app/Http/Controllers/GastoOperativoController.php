<?php

namespace App\Http\Controllers;

use App\Models\GastoOperativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GastoOperativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gastos=GastoOperativo::orderBy('id', 'desc')->paginate(10);
        return view('operativos.gasto.index',compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("operativos.gasto.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                 // Validar los datos del formulario
                 $validatedData = $request->validate([
                    'monto' => 'required',
                    'fecha' => 'required',
                    'descripcion' => 'required',
                    // 'id_personal' => Auth::user()->id,


                ]);

                $validatedData['id_personal']=/* Auth::user()->id ? Auth::user()->id : */11;
                $gasto =GastoOperativo::create($validatedData);

                if ($gasto) {
                    return redirect()->route('gasto.index')->with('success', 'gasto creado correctamente');
                } else {
                    return redirect()->back()->withErrors(['msg' => 'Error al crear el promocion.']);
                }
    }

    /**
     * Display the specified resource.
     */
    public function show(GastoOperativo $gastoOperativo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $gasto = GastoOperativo::find($request->id_gasto);
        return view("operativos.gasto.edit", compact('gasto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GastoOperativo $gastoOperativo)
    {
          // Validar los datos del formulario
          $validatedData = $request->validate([
            'monto' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            // 'id_personal' => Auth::user()->id,


        ]);

        $gastoOperativo->id_personal=Auth::user()->id;
        $gastoOperativo->update($validatedData);

        if ($gastoOperativo) {
            return redirect()->route('gasto.index')->with('success', 'gasto creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el promocion.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gasto=GastoOperativo::findOrFail($id);
        $gasto->delete();
        return redirect()->route('gasto.index');
    }
}
