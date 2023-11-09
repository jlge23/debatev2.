@extends('layouts.app')

@section('title','Datos de Puntajes')

@vite(['resources/js/tipos.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
@section('content')
    <div class="container">
        <h1 class="alert alert-primary">Listado de Tipos de preguntas</h1>
        <hr>
        {{-- <a class="btn btn-dark" href="{{ url('/home') }}">Inicio</a>&nbsp;<a href="{{route('tipo.create')}}" class="btn btn-primary">Registrar Tipos de pregunta</a>
        <hr> --}}
        <table id="tipo" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipos as $tipo)
                <tr>
                    <td>{{$tipo->id}}</td>
                    <td>{{$tipo->nombre}}</td>
                    <td>{{$tipo->opciones}}</td>
                    <td>{{$tipo->status}}</td>
                    <td>
                        <form action="{{route('tipo.destroy',$tipo->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group" role="group">
                                <a href="{{route('tipo.edit',$tipo->id)}}" class="btn btn-sm btn-secondary">Editar</a>
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
                    <th>Nombre</th>
                    <th>Opciones</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
