<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use App\Models\Dificultade;
use App\Models\Tipo;
use App\Models\Respuesta;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
    public function index(Request $request)
    {
        $preguntas = Pregunta::with('respuestas','tipo','dificultad')->get();
        return view('pregunta.index', compact('preguntas'));
    }

    public function create()
    {
        $tipos = Tipo::select('id','nombre','opciones')->where('status',1)->get();
        $dificultades = Dificultade::select('id','dificultad','puntaje','tiempo')->where('status',1)->get();
        return view('pregunta.create',compact('tipos','dificultades'));
    }

    public function store(Request $request)
    {
        //$cuantas = DB::table('preguntas')->select(DB::raw('COUNT(preguntas.id) AS cuantos'))->where('status',1)->get();
        $cuantas = DB::table('preguntas')->select(DB::raw('COUNT(preguntas.id) AS cuantos'))->get();
        $pregunta = Pregunta::create([
            'numero' => $cuantas[0]->cuantos + 1,
            'pregunta' => $request->pregunta,
            'tipo_id' => $request->tipo_id,
            'dificultade_id' => $request->dificultade_id,
            'demo' => $request->demo,
            'status' => $request->status
        ]);

        switch($pregunta->tipo_id){
            case 1://verdadero y falso
                $R = new Respuesta;
                $R->pregunta_id = $pregunta->id;
                $R->respuesta = $request->input('respuesta')[0];
                $R->validez = $request->validez;
                $R->status = 1;
                $R->save();
                unset($R);
            break;
            case 2://seleccion simple
                foreach($request->input('respuesta') as $key => $value){
                    $R = new Respuesta;
                    $R->pregunta_id = $pregunta->id;
                    $R->respuesta = $value;
                    $R->validez = $request->validez == $key+1 ? 1 : 0;
                    $R->status = 1;
                    $R->save();
                    unset($R);
                }
            break;
            case 3://desarrollo
                $R = new Respuesta;
                $R->pregunta_id = $pregunta->id;
                $R->respuesta = $request->input('respuesta')[0];
                $R->validez = $request->validez;
                $R->status = 1;
                $R->save();
                unset($R);
            break;
        }
        return redirect()->route('pregunta.index');
    }

    public function edit($id)
    {
        $dificultades = Dificultade::all();
        $pregunta = Pregunta::where('id',$id)->with('respuestas','tipo','dificultad')->get();
        return view('pregunta.edit',compact('pregunta','dificultades'));
    }

    public function update(Request $request, $id)
    {
        //return $request->all();die();
        $pregunta = Pregunta::findOrFail($id);
        $pregunta->update([
            'pregunta' => $request->pregunta,
            'dificultade_id' => $request->dificultade_id,
            'demo' => $request->demo,
            'status' => $request->status
        ]);
        switch($request->tipo_id){
            case 1://verdadero y falso
                $pregunta->respuestas()->update([
                    "respuesta"=>$request->respuesta[0],
                    "validez"=>$request->opcion
                ]);
            break;
            case 2://seleccion simple
                for($i=0;$i<count($request->respuesta);$i++){
                    $pregunta->respuestas()->where('id',$request->respuesta_id[$i])->update([
                        "pregunta_id"=>$request->pregunta_id,
                        "respuesta"=>$request->respuesta[$i],
                        "validez"=> $request->respuesta_id[$i] == $request->opcion ? 1 : 0,
                        "status"=>1
                    ]);
                }
            break;
            case 3://desarrollo
                $pregunta->respuestas()->update([
                    "respuesta"=>$request->respuesta[0]
                ]);
            break;
        }
        return redirect(route('pregunta.index'));
    }

    public function destroy($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        $pregunta->delete();
        return redirect()->route('pregunta.index');
    }
}
