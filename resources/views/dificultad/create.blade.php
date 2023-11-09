@extends('layouts.app')
@section('title','Agregar información de Dificultad de pregunta')
@section('content')
@vite(['resources/js/dificultades.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
    <div class="container">
        <h1>Agregar información de Dificultad de pregunta</h1>
        <a href="{{route('dificultad.index')}}">Volver al listado de Dificultades</a>
        <hr>
        <form id="nueva_dificultad" action="{{route('dificultad.store')}}" method="POST" class="form-horizontal">
            @csrf
            @method('POST')
            @include('dificultad.form')
            <br>
            <button type="submit" class="btn btn-success">Registrar nueva Dificultad</button>
        </form>
        <hr>
    </div>
@endsection
