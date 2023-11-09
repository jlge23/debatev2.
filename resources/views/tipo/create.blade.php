@extends('layouts.app')
@section('title','Agregar nueva Iglesia')
@section('content')
@vite(['resources/js/tipos.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
    <div class="container">
        <h1>Registrar datos de Puntaje</h1>
        <a href="{{route('tipo.index')}}">Volver al listado de tipos</a>
        <hr>
        <form id="nuevo_tipo" action="{{route('tipo.store')}}" method="POST" class="form-horizontal">
            @csrf
            @method('POST')
            @include('tipo.form')
            <br>
            <button type="submit" class="btn btn-success">Registrar Tipos de pregunta</button>
        </form>
    </div>
@endsection
