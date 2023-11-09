@vite(['resources/js/relog.js'])
<form id="FRM_vf" class="form-horizontal" action="{{route('juego.update')}}" method="POST">
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
                <button type="button" id="start1" class="btn btn-primary">Iniciar cuenta regresiva</button>&nbsp;&nbsp;
                <button type="button" id="stop1" class="btn btn-warning" disabled>Detener cuenta regresiva</button>
            </center>
        </div>
    </div>
    <hr>
    {{-- <h1 id="OPT" style="display: none"> --}}
    <h1 id="OPT" style="display: block">
        <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="opcion1" name="opcion" value="1" data-text="VERDADERO" disabled>&nbsp;Verdadero
            <label class="form-check-label" for="opcion1"></label>
        </div>
        <b>|&nbsp;</b>
        <div class="form-check-inline">
            <input type="radio" class="form-check-input" id="opcion2" name="opcion" value="0" data-text="FALSO" disabled>&nbsp;Falso
            <label class="form-check-label" for="opcion2"></label>
        </div>
    </h1>
    <div id="resp" style="display: none">
        <hr>
        <h2 class="alert alert-dark text text-uppercase">Respuesta correcta:&nbsp;<b>{{$pregunta[0]->respuestas[0]->respuesta}}</b></h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h1 id="mensaje" class=""></h1>
            </div>
        </div>
        <center><button type="submit" class="btn btn-success">Guardar y continuar</button></center>
    </div>
</form>
