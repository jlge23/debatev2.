<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Http\Requests\UpdateEquipo;
use App\Http\Requests\StoreEquipo;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipo.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipo.create');
    }

    public function store(StoreEquipo $request)
    {
        Equipo::create($request->post());
        return redirect()->route('equipo.index');
    }

    public function edit(Equipo $equipo, $id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipo.edit',compact('equipo'));
    }

    public function update(UpdateEquipo $request)
    {
        $equipo = Equipo::findOrFail($request->id);
        $equipo->update($request->all());
        return redirect(route('equipo.index'));
    }

    public function destroy($id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();
        return redirect()->route('equipo.index');
    }
}
