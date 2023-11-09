@extends('layouts.app')

@section('title','Datos de Dificultad de preguntas')

@vite(['resources/js/dificultades.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
@section('content')
    <div class="container">
        <h1 class="alert alert-primary">Listado de dificultad de pregunta</h1>
        <hr>
        {{-- <a class="btn btn-dark" href="{{ url('/home') }}">Inicio</a>&nbsp;<a href="{{route('dificultad.create')}}" class="btn btn-primary">Registrar una dificultad para preguntas</a>
        <hr> --}}
        <table id="dificultades" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Dificultad</th>
                    <th>Puntaje</th>
                    <th>Tiempo</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dificultades as $dificultad)
                <tr>
                    <td>{{$dificultad->id}}</td>
                    <td>{{$dificultad->dificultad}}</td>
                    <td>{{$dificultad->puntaje}}</td>
                    <td>{{$dificultad->tiempo}}</td>
                    <td>{{$dificultad->status}}</td>
                    <td>
                        <form action="{{route('dificultad.destroy',$dificultad->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group">
                                <a href="{{route('dificultad.edit',$dificultad->id)}}" class="btn btn-sm btn-secondary">Editar</a>
                                <button type="submit" class="btn btn-sm btn-warning">Eliminar</button>&nbsp;
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Dificultad</th>
                    <th>Puntaje</th>
                    <th>Tiempo</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
