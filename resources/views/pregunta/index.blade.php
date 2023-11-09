@extends('layouts.app')
@section('title','Datos de la Pregunta')
@vite(['resources/js/preguntas.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
@section('content')
    <div class="container">
        <h1 class="alert alert-primary">Listado de Preguntas</h1>
        <hr>
        <a class="btn btn-dark" href="{{ url('/home') }}">Inicio</a>&nbsp;<a href="{{route('pregunta.create')}}" class="btn btn-primary">Registrar una Pregunta</a>
        <hr>
        <table id="pregunta" class="table table-bordered table-striped table-responsive" width="100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>N°</th>
                    <th>Pregunta</th>
                    <th>Dificultad</th>
                    <th>Tipo</th>
                    <th>Tiempo</th>
                    <th>Puntaje</th>
                    <th>Respuestas</th>
                    <th>Demo</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($preguntas as $pregunta)
                <tr>
                    <td>{{$pregunta->id}}</td>
                    <td>{{$pregunta->numero}}</td>
                    <td>{{$pregunta->pregunta}}</td>
                    <td>{{$pregunta->dificultad->dificultad}}</td>
                    <td>{{$pregunta->tipo->nombre}}</td>
                    <td>{{$pregunta->dificultad->tiempo}}</td>
                    <td>{{$pregunta->dificultad->puntaje}}</td>
                    <td>
                        <ul class="list-group">
                        @foreach ($pregunta->respuestas as $respuesta)
                            @if($respuesta->validez == 1)
                                <li class="list-group-item list-group-item-action active">{{$respuesta->respuesta}}</li>
                            @else
                                <li class="list-group-item list-group-item-action">{{$respuesta->respuesta}}</li>
                            @endif
                        @endforeach
                        </ul>
                    </td>
                    <td>
                        @if ($pregunta->demo)
                            <label class="p-3 mb-2 bg-warning text-white rounded"><strong>Sí</strong></label>
                        @else
                            <label class="p-3 mb-2 bg-primary text-white rounded"><strong>Nó</strong></label>
                        @endif
                    </td>
                    <td>
                        @if ($pregunta->status)
                            <label class="p-3 mb-2 bg-success text-white rounded"><strong>Activo</strong></label>
                        @else
                            <label class="p-3 mb-2 bg-danger text-white rounded"><strong>Inactivo</strong></label>
                        @endif
                    </td>
                    <td>
                        <form action="{{route('pregunta.destroy',$pregunta->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group">
                                <a href="{{route('pregunta.edit',$pregunta->id)}}" class="btn btn-secondary">Editar</a>
                                <button type="submit" class="btn btn-warning">Eliminar</button>
                            </div>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>N°</th>
                    <th>Pregunta</th>
                    <th>Dificultad</th>
                    <th>Tipo</th>
                    <th>Tiempo</th>
                    <th>Puntaje</th>
                    <th>Respuestas</th>
                    <th>Demo</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
