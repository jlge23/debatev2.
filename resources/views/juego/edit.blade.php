@extends('layouts.app')
@section('title','Editar datos de la Juego')
@section('content')
@vite(['resources/js/juegos.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
<body id="P">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6"><h4>Jugando:&nbsp;<b>{{$equipo->nombre.". [".$equipo->descripcion."]"}}</b></h4></div>
            <div class="col-md-6"><h4>Pregunta de&nbsp;<b>{{$pregunta[0]->tipo->nombre}}</b></h4></div>
        </div>
        <div class="row">
            <div class="col-md-4">Dificultad seleccionada:&nbsp;<b>{{$pregunta[0]->dificultad->dificultad}}</b></div>
            <div class="col-md-2">Valor:&nbsp;<b>{{$pregunta[0]->dificultad->puntaje}}</b></div>
            <div class="col-md-4">Tiempo para responder:&nbsp;<b>{{$pregunta[0]->dificultad->tiempo}}&nbsp;segundos</b></div>
            <div class="col-md-2">
                <button class="btn btn-danger" type="button" id="anular" name="anular">¡Ocurrió un problema!</button></h1>
            </div>
        </div>
        <hr>
        @switch($pregunta[0]->tipo_id)
            @case(1)
                @include("juego.vf")
            @break
            @case(2)
                @include("juego.sel")
            @break
            @case(3)
                @include("juego.des")
            @break
        @endswitch
    </div>
</body>
@endsection
