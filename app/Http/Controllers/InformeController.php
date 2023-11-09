<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Evento;
use App\Models\Juego;

class InformeController extends Controller
{
    protected function evento(){
        $evento = Evento::where('status','=',1)->get();//devuelve informacion del Evento activo
        return $evento;
    }

    public function index()
    {
        $evento = $this->evento();//devuelve informacion del Evento activo
        return view('informe.index',compact('evento'));
    }

    public function resultados(){
        $this->evento();//devuelve informacion del Evento activo
        $i = 1;
        $juegos = DB::table('juegos')
            ->join('equipos', function ($join) {
                $join->on('equipos.id', '=', 'juegos.equipo_id');})
            ->join('respuestas', function ($join) {
                $join->on('respuestas.id', '=', 'juegos.respuesta_id');})
            ->join('preguntas', function ($join) {
                $join->on('preguntas.id', '=', 'respuestas.pregunta_id');})
            ->join('tipos', function ($join) {
                $join->on('tipos.id', '=', 'preguntas.tipo_id');})
            ->join('dificultades', function ($join) {
                $join->on('dificultades.id', '=', 'preguntas.dificultade_id');})

            ->select('juegos.id','equipos.nombre','preguntas.numero','dificultades.dificultad AS dificultad','tipos.nombre AS tipo','preguntas.pregunta','respuestas.respuesta','juegos.seleccion','juegos.acierto','juegos.puntos','juegos.tiempo')
            ->where('juegos.evento_id','=',$this->evento()[0]->id)
            ->orderBy('juegos.id','asc')->get();
        foreach($juegos as $juego){
            $data['data'][] = array(
                'id' => $i,
                'nombre' => $juego->nombre,
                'numero' => $juego->numero,
                'tipo' => $juego->tipo,
                'dificultad' => $juego->dificultad,
                'pregunta' => $juego->pregunta,
                'respuesta' => $juego->respuesta,
                'seleccion' => $juego->seleccion,
                'acierto' => $juego->acierto,
                'puntos' => $juego->puntos,
                'tiempo' => $juego->tiempo
            );
            $i++;
        }
        if(empty($data)){
            return $data['data'][] = 'null';
        }else{
            return $data;
        }
    }

    public function graficos($grafico){
        $this->evento();//devuelve informacion del Evento activo
        switch($grafico){
            case 0:
                $equipos = DB::table('juegos')
                    ->join('equipos', function ($join) {
                        $join->on('equipos.id', '=', 'juegos.equipo_id');
                    })
                    ->select('equipos.id','equipos.nombre')
                    ->where('juegos.evento_id','=',$this->evento()[0]->id)
                    ->groupBy('equipos.id','equipos.nombre')
                    ->orderBy('equipos.id')
                    ->get();

                foreach($equipos as $key => $equipo){
                    $A['categories'][$key] = array($equipo->nombre);
                }
                $A['series'][0] = array('name' => 'ACIERTOS');
                foreach($equipos as $key => $equipo){
                    $C1 = Juego::select(DB::raw('COUNT(juegos.acierto) AS data'))->where('acierto','=',1)->where('evento_id','=',$this->evento()[0]->id)->where('equipo_id','=',$equipo->id)->get();
                    $A['series'][0]['data'][$key] = array($C1[0]->data);
                }
                $A['series'][1] = array('name' => 'DESACIERTOS');
                foreach($equipos as $key => $equipo){
                    //$C2 = Juego::select(DB::raw('COUNT(juegos.acierto) AS data'))->where('acierto','=',0)->whereNotNull('tiempo')->where('evento_id','=',$this->evento()[0]->id)->where('equipo_id','=',$equipo->id)->whereNot('seleccion','Pierde turno')->whereNot('seleccion','Tiempo agotado')->get();
                    $C2 = Juego::select(DB::raw('COUNT(juegos.acierto) AS data'))->where('acierto','=',0)->where('evento_id','=',$this->evento()[0]->id)->where('equipo_id','=',$equipo->id)->whereNot('seleccion','Pierde turno')->whereNot('seleccion','Tiempo agotado')->get();
                    $A['series'][1]['data'][$key] = array($C2[0]->data);
                }
                $A['series'][2] = array('name' => 'TIEMPO AGOTADO');
                foreach($equipos as $key => $equipo){
                    $C3 = Juego::select(DB::raw('COUNT(juegos.acierto) AS data'))->where('acierto','=',0)->where('evento_id','=',$this->evento()[0]->id)->where('equipo_id','=',$equipo->id)->where('seleccion','Tiempo agotado')->get();
                    $A['series'][2]['data'][$key] = array($C3[0]->data);
                }
                $A['series'][3] = array('name' => 'PERDIÓ SU TURNO');
                foreach($equipos as $key => $equipo){
                    $C4 = Juego::select(DB::raw('COUNT(juegos.acierto) AS data'))->where('acierto','=',0)->where('evento_id','=',$this->evento()[0]->id)->where('equipo_id','=',$equipo->id)->where('tiempo','0.00')->get();
                    $A['series'][3]['data'][$key] = array($C4[0]->data);
                }
                return json_encode($A,JSON_NUMERIC_CHECK);
            break;
            case 1:
                $equipos = DB::table('juegos')
                    ->join('equipos', function ($join) {
                        $join->on('equipos.id', '=', 'juegos.equipo_id');
                    })
                    ->select('equipos.nombre AS name',DB::raw('SUM(juegos.puntos) AS y'),'equipos.nombre AS drilldown')
                    ->where('juegos.evento_id','=',$this->evento()[0]->id)
                    ->groupBy('equipos.nombre','equipos.id')
                    ->orderBy('equipos.id')
                    ->get();
                return json_encode($equipos,JSON_NUMERIC_CHECK);
            break;
            case 2:
                $equipos = DB::table('juegos')
                    ->join('equipos', function ($join) {
                        $join->on('equipos.id', '=', 'juegos.equipo_id');
                    })
                    ->select('equipos.nombre AS name',DB::raw('SUM(juegos.puntos) AS y'))
                    ->where('juegos.evento_id','=',$this->evento()[0]->id)
                    ->groupBy('equipos.nombre','equipos.id')
                    ->orderBy('equipos.id')
                    ->get();
                return json_encode($equipos,JSON_NUMERIC_CHECK);
            break;
            case 3:
                $arr[] = array();
                $equipos = DB::table('juegos')
                    ->join('equipos', function ($join) {
                        $join->on('equipos.id', '=', 'juegos.equipo_id');
                    })
                    ->select('equipos.id','equipos.nombre')
                    ->where('juegos.evento_id','=',$this->evento()[0]->id)
                    ->groupBy('equipos.id','equipos.nombre')
                    ->orderBy('equipos.id')
                    ->get();
                foreach($equipos as $k =>$value){
                    $tiempo = Juego::select('juegos.tiempo')->where('juegos.equipo_id','=',$value->id)->where('juegos.evento_id','=',$this->evento()[0]->id)->groupBy('juegos.id','juegos.tiempo')->get();
                    $arr[$k] = array('name' => $value->nombre);
                    foreach($tiempo as $key => $t){
                        if($t->tiempo){
                            $arr[$k]['data'][$key] = array($t->tiempo);
                        }else{
                            $arr[$k]['data'][$key] = array(0);
                        }
                    }
                }

                return json_encode($arr,JSON_NUMERIC_CHECK);
            break;
            /* case 4:
                $arr[] = array();
                $preguntas = Pregunta::select(
                    DB::raw("CASE WHEN id THEN 'Activas' ELSE 'Inactivas' END AS pregunta"),
                    DB::raw("COUNT(id) AS id"))->groupBy('id')->get();
                foreach($preguntas as $key => $value){
                    $arr[$key] = array($value->pregunta,$value->status);
                }
                return json_encode($arr,JSON_NUMERIC_CHECK);
            break; */
        }

    }
}
