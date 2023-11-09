@extends('layouts.app')
@section('title','Editar datos del la Pregunta')
@section('content')
@vite(['resources/js/preguntas.js','resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
    <div class="container">
        <h1>Editar datos de la pregunta</h1>
        <a href="{{route('pregunta.index')}}">Volver al listado de Preguntas</a>
        <hr>
        <form id="editar_pregunta" action="{{route('pregunta.update',['id'=>$pregunta[0]->id])}}" method="POST" class="form-horizontal">
            @csrf
            @method('put')

            @foreach ($pregunta as $preg)
                <input type="hidden" name="tipo_id" value="{{$preg->tipo_id}}">
                <input type="hidden" name="pregunta_id" value="{{$preg->id}}">
                <div class="row">
                    <div class="col-md-12">
                        <label><b>Pregunta N°</b> [{{$preg->numero}}]</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label><b>Tipo de pregunta:</b>&nbsp;
                            <input type="text" class="form-control" name="tipo" id="tipo" value="{{$preg->tipo->nombre ?? old('tipo')}}" readonly>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label><b>Dificultad de la pregunta:</b>&nbsp;
                            <select name="dificultade_id" id="dificultade_id" class="form-select">
                                <option value="">Seleccione</option>
                                @if(isset($dificultades))
                                    @foreach ($dificultades as $dificultad)
                                        @if(isset($pregunta))
                                            @if (($preg->dificultade_id == $dificultad->id) or ($preg->dificultade_id == old('dificultade_id')))
                                                <option value="{{$dificultad->id}}" selected>{{$dificultad->dificultad." Puntaje: [".$dificultad->puntaje."] Tiempo: [".$dificultad->tiempo."]"}}</option>
                                            @else
                                                <option value="{{$dificultad->id}}">{{$dificultad->dificultad." Puntaje: [".$dificultad->puntaje."] Tiempo: [".$dificultad->tiempo."]"}}</option>
                                            @endif
                                        @else
                                            @if ($dificultad->id == old('dificultade_id'))
                                                <option value="{{$dificultad->id}}" selected>{{$dificultad->dificultad." Puntaje: [".$dificultad->puntaje."] Tiempo: [".$dificultad->tiempo."]"}}</option>
                                            @else
                                                <option value="{{$dificultad->id}}">{{$dificultad->dificultad." Puntaje: [".$dificultad->puntaje."] Tiempo: [".$dificultad->tiempo."]"}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    <option value="#" disabled>No hay información de dificultades registrados</option>
                                @endif
                            </select>
                        </label>
                        @error('dificultade_id')
                            <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label><b>Descripción de la Pregunta:</b>&nbsp;
                            <textarea name="pregunta" id="pregunta" class="form-control" rows="2" cols="50">{{$preg->pregunta ?? old('pregunta')}}</textarea>
                        </label>
                        @error('pregunta')
                            <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label><b>Estatus de la pregunta:</b>&nbsp;
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="status1" name="status" value="1" {{((isset($preg->status)) and $preg->status == "1") ? 'checked' : (old("status")  == "1" ? 'checked' : '')}}>Activa
                                <label class="form-check-label" for="status1"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="status2" name="status" value="0" {{((isset($preg->status)) and $preg->status == "0") ? 'checked' : (old("status")  == "0" ? 'checked' : '')}}>Inactiva
                                <label class="form-check-label" for="status2"></label>
                            </div>
                        </label>
                        @error('status')
                            <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label><b>¿Pregunta Demo?:</b>&nbsp;
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="demo1" name="demo" value="1" {{((isset($preg->demo)) and $preg->demo == "1") ? 'checked' : (old("demo")  == "1" ? 'checked' : '')}}>Sí
                                <label class="form-check-label" for="demo1"></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="demo2" name="demo" value="0" {{((isset($preg->demo)) and $preg->demo == "0") ? 'checked' : (old("demo")  == "0" ? 'checked' : '')}}>Nó
                                <label class="form-check-label" for="demo2"></label>
                            </div>
                        </label>
                        @error('demo')
                            <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        @switch($preg->tipo_id)
                            @case(1)
                                @foreach ($preg->respuestas as $key=>$r)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Respuesta:</span>
                                                <textarea class="form-control" id="respuesta" name="respuesta[{{$key}}]" required="">{{$r->respuesta ?? old('respuesta[]')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Opción valida:&nbsp;
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="opcion1" name="opcion" value="1" {{((isset($r->validez)) and $r->validez == "1") ? 'checked' : (old("opcion")  == "1" ? 'checked' : '')}}>
                                                    <label class="form-check-label">[Verdadero]</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="opcion2" name="opcion" value="0" {{((isset($r->validez)) and $r->validez == "0") ? 'checked' : (old("opcion")  == "0" ? 'checked' : '')}}>
                                                    <label class="form-check-label">[Falso]</label>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="validez" id="validez" value="{{$r->validez ?? old('validez')}}">
                                    <input type="hidden" id="respuesta_id" name="respuesta_id" value="{{$r->id}}">
                                @endforeach
                            @break
                            @case(2)
                                @foreach ($preg->respuestas as $key=>$r)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Opción [{{$key+1}}]: </span>
                                                <input class="form-control" id="respuesta" name="respuesta[{{$key}}]" value="{{$r->respuesta ?? old('respuesta[]')}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="respuesta_id" name="respuesta_id[{{$key}}]" value="{{$r->id}}">
                                    <input type="hidden" id="validez" name="validez[{{$key}}]" value="{{$r->validez}}">
                                    @if($r->validez == 1)
                                        <input type="hidden" name="valida" id="valida" value="{{$r->id}}">
                                    @endif
                                @endforeach
                                <div class="row">
                                    <div class="col-md-2">
                                        <select class="form-control" name="opcion" id="opcion">
                                            <option value="" selected>SELECCIONE</option>
                                            <?php $i=1;?>
                                            @foreach ($preg->respuestas as $key=>$r)
                                                @if (($r->validez == 1) or ($r->id == old('opcion')))
                                                    <option value="{{$r->id}}" selected>Opción {{$key+$i}}</option>
                                                @else
                                                    <option value="{{$r->id}}">Opción {{$key+$i}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-10"></div>
                                </div>
                            @break
                            @case(3)
                                @foreach ($preg->respuestas as $key=>$r)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Respuesta Correcta</span>
                                            <textarea class="form-control" id="respuesta" name="respuesta[{{$key}}]" required>{{$r->respuesta ?? old('respuesta[]')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="validez" id="validez" value="{{$r->validez ?? old('validez')}}">
                                <input type="hidden" id="respuesta_id" name="respuesta_id" value="{{$r->id}}">
                                @endforeach
                            @break
                        @endswitch
                    </div>
                </div>
            @endforeach
            <br>
            <button type="submit" class="btn btn-success">Actualizar datos</button>
        </form>
        <hr>
    </div>
@endsection
