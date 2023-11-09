<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEvento;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('evento.index', compact('eventos'));
    }

    public function create()
    {
        return view('evento.create');
    }

    public function store(StoreEvento $request)
    {
        $eventos = Evento::all();
        if($eventos){
            Evento::where('status',1)->update(['status'=>0]);
            Evento::create($request->post());
        }else{
            Evento::create($request->post());
        }
        return redirect()->route('evento.index');
    }

    public function edit(Evento $evento, $id)
    {
        $evento = Evento::findOrFail($id);
        return view('evento.edit',compact('evento'));
    }

    public function update(Request $request)
    {
        Evento::where('status',1)->update(['status'=>0]);
        $evento = Evento::find($request->id);
        $evento->update($request->all());
        return redirect(route('evento.index'));
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();
        return redirect()->route('evento.index');
    }
}
