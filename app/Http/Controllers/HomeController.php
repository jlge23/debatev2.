<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Evento;
use App\Models\Juego;
use App\Models\Pregunta;
use App\Models\Dificultade;
use App\Models\Tipo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dificultades = Dificultade::select(\DB::raw('COUNT(*) AS dificultad'))->get();
        $eventos = Evento::select(\DB::raw('COUNT(*) AS evento'),'status')->groupBy('status')->get();
        $equipos = Equipo::select(\DB::raw('COUNT(*) AS equipo'))->get();
        $tipos = Tipo::select(\DB::raw('COUNT(*) AS nombre'))->get();
        $preguntas = Pregunta::select(\DB::raw('COUNT(*) AS pregunta'))->where('demo',0)->get();
        $demo = Pregunta::select(\DB::raw('COUNT(*) AS demo'))->where('demo',1)->get();
        $juegos = Juego::select(\DB::raw('COUNT(*) AS juego'))->get();
        return view('home',compact('dificultades','eventos','equipos','tipos','preguntas','demo','juegos'));
    }
}
