@extends('layouts.app')
@section('title','Editar datos del la Pregunta')
@section('content')
@vite(['resources/js/dificultades.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
    <div class="container">
        <h1>Editar datos de la Dificultad</h1>
        <a href="{{route('dificultad.index')}}">Volver al listado de Preguntas</a>
        <hr>
        <form id="editar_dificultad" action="{{route('dificultad.update')}}" method="POST" class="form-horizontal">
            @csrf
            @method('put')
            @include('dificultad.form')
            <br>
            <input type="hidden" name="id" value="{{$dificultad->id}}">
            <button type="submit" class="btn btn-success">Actualizar datos</button>
        </form>
    </div>
@endsection
