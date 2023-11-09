<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTipo;

class TipoController extends Controller
{
    public function index()
    {
        $tipos = Tipo::all();
        return view('tipo.index', compact('tipos'));
    }

    public function create()
    {
        $tiempos = Tipo::all();
        return view('tipo.create',compact('tiempos'));
    }

    public function store(StoreTipo $request)
    {
        Tipo::create($request->post());
        return redirect()->route('tipo.index');
    }

    public function edit(Tipo $tipo, $id)
    {
        $tiempos = Tipo::all();
        $tipo = Tipo::findOrFail($id);
        return view('tipo.edit',compact('tipo','tiempos'));
    }

    public function update(Request $request)
    {
        $tipo = Tipo::findOrFail($request->id);
        $tipo->update($request->all());
        return redirect(route('tipo.index'));
    }

    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->delete();
        return redirect()->route('tipo.index');
    }
}
