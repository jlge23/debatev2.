@vite(['resources/js/relog.js'])
<form id="FRM_desarrollo" class="form-horizontal" action="{{route('juego.update')}}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="tiempo" id="tiempo" value="{{$pregunta[0]->dificultad->tiempo}}">
    <input type="hidden" name="equipo" id="equipo" value="{{$equipo->id}}">
    <input type="hidden" name="duracion" id="duracion" value="">
    <input type="hidden" name="preg" id="preg" value="{{$pregunta[0]->id}}">
    <input type="hidden" name="respuesta" id="respuesta" value="{{$pregunta[0]->respuestas[0]->validez}}">
    <input type="hidden" name="respuesta_id" id="respuesta_id" value="{{$pregunta[0]->respuestas[0]->id}}" readonly>
    <input type="hidden" name="validez" id="validez" value="0">
    <input type="hidden" name="seleccion" id="seleccion" value="0">
    <input type="hidden" name="puntos" id="puntos" value="{{$pregunta[0]->dificultad->puntaje}}">
    <input type="hidden" name="tipo" id="tipo" value="{{$pregunta[0]->tipo_id}}">
    <h3 class="text text-uppercase">Pregunta N°: [<b>{{$pregunta[0]->numero}}</b>] - <b>{{$pregunta[0]->pregunta}}</b></h3>
    <div class="row">
        <div class="col-md-6">
            @include('juego.relog')
        </div>
        <div class="col-md-6">
            <br>
            <center>
                <button type="button" id="start3" class="btn btn-primary">Iniciar cuenta regresiva</button>&nbsp;&nbsp;
                <button type="button" id="stop3" class="btn btn-warning" disabled>Detener cuenta regresiva</button>
            </center>
        </div>
    </div>
    <hr>
    <div id="resp" style="display: none">
        <div class="input-group">
            <span class="input-group-text"><button type="button" name="mensaje" id="mensaje" class="btn btn-dark">Mostrar respuesta</button></span>
                {{--<textarea style="display: none" id="R" class="form-control text-uppercase fw-bold fs-4" disabled>{{$pregunta[0]->respuestas[0]->respuesta}}</textarea></span>--}}
                <h2 style="display: none" id="R" class="alert alert-dark text text-uppercase">Respuesta correcta:&nbsp;<b>{{$pregunta[0]->respuestas[0]->respuesta}}</b></h2>
        </div>
        <div class="row">
            <div class="col-md-2 fw-bold fs-4"><b>Valoración</b>&nbsp;</div>
            <div class="col-md-2 fw-bold fs-4" id="val"></div>
            <div class="col-md-8">                  
                <input type="range" list="vals" class="form-range" min="0" max="{{$pregunta[0]->dificultad->puntaje}}" step="1" id="opcion" name="opcion" value="0">
                <datalist id="vals">
                    @for ($i = 0; $i <= ($pregunta[0]->dificultad->puntaje); $i++)
                        <option value="{{$i}}" label="{{$i}}"></option>
                    @endfor
                </datalist>
            </div>
        </div>
        <hr>
        <center><button type="submit" class="btn btn-success">Guardar y continuar</button></center>
    </div>
</form>
