<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDificultad;
use App\Models\Dificultade;
use Illuminate\Http\Request;

class DificultadeController extends Controller
{
    public function index()
    {
        $dificultades = Dificultade::all();
        return view("dificultad.index",compact('dificultades'));
    }

    public function create()
    {
        return view("dificultad.create");
    }

    public function store(StoreDificultad $request)
    {
        Dificultade::create($request->post());
        return redirect()->route('dificultad.index');
    }

    public function edit(Dificultade $dificultad, $id)
    {
        $dificultad = Dificultade::findOrFail($id);
        return view('dificultad.edit',compact('dificultad'));
    }

    public function update(Request $request)
    {
        $dificultad = Dificultade::findOrFail($request->id);
        $dificultad->update($request->all());
        return redirect(route('dificultad.index'));
    }

    public function destroy($id)
    {
        $dificultad = Dificultade::findOrFail($id);
        $dificultad->delete();
        return redirect()->route('dificultad.index');
    }
}
