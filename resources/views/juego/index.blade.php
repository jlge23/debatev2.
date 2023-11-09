@extends('layouts.app')
@section('title','Datos del Juego')
@vite(['resources/js/juegos.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
@section('content')
    @isset($evento)
        @if(count($evento) > 0)
            @isset($preguntas)
                @if($preguntas == -1)
                    <div class="container">
                        <h1 class="alert alert-warning text text-dark">No se han encontrado preguntas registradas. Puede registrarlas aquí&nbsp;<a href='pregunta'>Modulo de preguntas</a></h1>
                    </div>
                @else
                    @if($preguntas == 0)
                        <div class="container" id="final">
                            <h1 class="alert alert-warning text text-dark">Se han agotado las preguntas. Puede registrar mas aquí:&nbsp;<a href='pregunta'>Modulo de preguntas</a> o, <a href='informe'>Ver resultados del Juego</a>
                            &nbsp;<button class="btn btn-danger" type="button" id="resetear" name="resetear">Reiniciar juego</button></h1>
                        </div>
                    @else
                        @if(isset($equipo))
                            <div class="container" id="inicio">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Evento activo:&nbsp;<b>{{$evento[0]->nombre.". [".$evento[0]->descripcion."]"}}</b></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Turno:&nbsp;<b>Equipo [{{$equipo->id}}]&nbsp;-&nbsp;{{$equipo->nombre." - [".$equipo->descripcion."]"}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    @if(count($actual) > 0)
                                        <div class="col-md-2">
                                            @if(count($ronda) > 0)
                                                <h4>Ronda: [<b>{{ $ronda[0]->ronda + 1}}</b>]</h4>
                                            @else
                                                <h4>Ronda: [<b>1</b>]</h4>
                                            @endif
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="list-group list-group-horizontal-sm">
                                            @foreach($actual as $act)
                                                <li class="list-group-item">
                                                    {{$act->name.": [".$act->y."]"}}
                                                </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="col-md-2">
                                            <h4>Ronda: [<b>1</b>]</h4>
                                        </div>
                                        <div class="col-md-7">
                                            <h4><label class="text text-white bg-dark">Esperando que inicie el juego</label></h4>
                                        </div>
                                    @endif
                                    <div class="col-md-1">
                                        @isset($demo)
                                            @if($demo == 0)
                                                <h4>
                                                    <button class="btn btn-sm btn-primary" type="button" id="demo" name="demo" data-juego="{{$demo}}">Activar Demo</button>
                                                </h4>
                                            @else
                                                <h4>
                                                    <button class="btn btn-sm btn-danger" type="button" id="demo" name="demo" data-juego="{{$demo}}">Desactivar Demo</button>
                                                </h4>
                                            @endif
                                        @endisset
                                    </div>
                                    <div class="col-md-1">
                                        <h4>
                                            <button class="btn btn-sm btn-warning" type="button" id="resetear" name="resetear">Reiniciar juego</button>
                                        </h4>
                                    </div>
                                </div>
                                <form action="" method="POST" class="form-control">
                                    @isset($equipo)
                                        <input type="hidden" name="equipo" id="equipo" value="{{$equipo->id}}" readonly>
                                    @endisset
                                    <div id="juego">
                                        <table id="DT_juego" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Dificultad</th>
                                                    <th>Puntaje</th>
                                                    <th>Tiempo en segundos</th>
                                                    <th>Preguntas disponibles</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Dificultad</th>
                                                    <th>Puntaje</th>
                                                    <th>Tiempo en segundos</th>
                                                    <th>Preguntas disponibles</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="container">
                                <h1 class="alert alert-warning text text-dark">No se encuentran equipos registrados, puede registrarlos aqui:&nbsp;<a href='equipo'>Equipos</a>
                            </div>
                        @endif
                    @endif
                @endif
            @endisset
        @endif
    @else
        <div class="container">
            <h1 class="alert alert-warning text text-dark">No hay eventos activos. Dirijase al menu <a href="evento">Eventos</a></h1>
        </div>
    @endisset
@endsection
