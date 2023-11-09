@extends('layouts.app')
@section('title','Editando Tipos de pregunta')
@section('content')
@vite(['resources/js/tipos.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
    <div class="container">
        <h1>Editar datos del Puntaje</h1>
        <a href="{{route('tipo.index')}}">Volver al listado de Tipos de pregunta</a>
        <hr>
        <form id="editar_tipo" action="{{route('tipo.update')}}" method="POST" class="form-horizontal">
            @csrf
            @method('put')
            @include('tipo.form')
            <br>
            <input type="hidden" name="id" value="{{$tipo->id}}">
            <button type="submit" class="btn btn-success">Actualizar datos</button>
        </form>
    </div>
@endsection
