@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>DEBATE es una pequeña aplicación Web construida con PHP y Laravel 10 Framework para realizar juegos de preguntas y respuestas por equipos. Version 2.0 beta</h3>
                    <h5><b>Pasos a seguir para configurar la aplicacion en su primer uso para el debate:</b>
                        <ul>
                            <li>Registrar la Información del Evento
                                <?php $i = 0;?>
                                @isset($eventos)
                                    @foreach($eventos as $evento)
                                        @if($evento->status == 1)
                                            <?php $i++ ?>
                                        @endif
                                    @endforeach
                                    @if($i == 0)
                                    <label class="text text-danger"><b>&nbsp;Falta.</b></label>&nbsp;<a class="btn btn-link" href="{{ url('evento') }}">Eventos</a>
                                    @else
                                        <label class="text text-success"><b>&nbsp;Listo [{{$evento->evento}}]</b>&nbsp;Evento Activo!</label>
                                    @endif
                                @else
                                <label class="text text-danger"><b>&nbsp;Falta.</b></label>&nbsp;<a class="btn btn-link" href="{{ url('evento') }}">Eventos</a>
                                @endisset
                            </li>
                            <li>Registrar los equipos participantes
                                @if($equipos[0]->equipo > 0)
                                    <label class="text text-success"><b>&nbsp;Listo [{{$equipos[0]->equipo}}]</b></label>
                                @else
                                    <label class="text text-danger"><b>&nbsp;Falta.</b></label>&nbsp;<a class="btn btn-link" href="{{ url('equipo') }}">Equipos</a>
                                @endif
                            </li>
                            <li>Registrar los niveles de Dificultad para las preguntas
                                @if($dificultades[0]->dificultad > 0)
                                    <label class="text text-success"><b>&nbsp;Listo [{{$dificultades[0]->dificultad}}]</b></label>
                                @else
                                    <label class="text text-danger"><b>&nbsp;Falta.</b></label>&nbsp;<a class="btn btn-link" href="{{ url('tipo') }}">Dificultad</a>
                                @endif
                            </li>
                            <li>Registrar los Tipos de preguntas
                                @if($tipos[0]->nombre > 0)
                                    <label class="text text-success"><b>&nbsp;Listo [{{$tipos[0]->nombre}}]</b></label>
                                @else
                                    <label class="text text-danger"><b>&nbsp;Falta.</b></label>&nbsp;<a class="btn btn-link" href="{{ url('tipo') }}">Tipos</a>
                                @endif
                            </li>
                            <li>Registrar las preguntas
                                @if($preguntas[0]->pregunta > 0)
                                    <label class="text text-success"><b>&nbsp;Listo [{{$preguntas[0]->pregunta}}]</b></label>
                                @else
                                    <label class="text text-danger"><b>&nbsp;Falta.</b></label>&nbsp;<a class="btn btn-link" href="{{ url('pregunta') }}">Preguntas</a>
                                @endif
                            </li>
                            <li>Registrar las preguntas de demostración
                                @if($demo[0]->demo > 0)
                                    <label class="text text-success"><b>&nbsp;Listo [{{$demo[0]->demo}}]</b></label>
                                @else
                                    <label class="text text-danger"><b>&nbsp;Falta.</b></label>&nbsp;<a class="btn btn-link" href="{{ url('pregunta') }}">Preguntas</a>
                                @endif
                            </li>
                            <li>Iniciar el Juego
                                @if($juegos[0]->juego > 0)
                                    <label class="text text-success"><b>&nbsp;Listo [{{$juegos[0]->juego}}]</b></label>
                                @else
                                    <label class="text text-danger"><b>&nbsp;No iniciado.</b></label>&nbsp;<b>NOTA:&nbsp;Deben cumplirse los pasos anteriores para inicar el juego</b>
                                @endif
                            </li>
                            <li>Ver informacion del Juego</li>
                        </ul>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
