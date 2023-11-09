<label>Tipo de pregunta:&nbsp;
    <select name="tipo_id" id="tipo_id" class="form-select">
        <option value="">Seleccione</option>
        @if(isset($tipos))
            @foreach ($tipos as $tipo)
                @if(isset($pregunta))
                    @if (($pregunta->tipo_id == $tipo->id) or ($pregunta->tipo_id == old('tipo_id')))
                        <option value="{{$tipo->id}}" data-opt="{{$tipo->opciones}}" selected>{{$tipo->nombre}}</option>
                    @else
                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                    @endif
                @else
                    @if ($tipo->id == old('tipo_id'))
                        <option value="{{$tipo->id}}" data-opt="{{$tipo->opciones}}" selected>{{$tipo->nombre}}</option>
                    @else
                        <option value="{{$tipo->id}}" data-opt="{{$tipo->opciones}}">{{$tipo->nombre}}</option>
                    @endif
                @endif
            @endforeach
        @else
            <option value="#" disabled>No hay información de tipo registrados</option>
        @endif
    </select>
</label>
@error('tipo_id')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
<br>
<label>Dificultad de la pregunta:&nbsp;
    <select name="dificultade_id" id="dificultade_id" class="form-select">
        <option value="">Seleccione</option>
        @if(isset($dificultades))
            @foreach ($dificultades as $dificultad)
                @if(isset($pregunta))
                    @if (($pregunta->dificultade_id == $dificultad->id) or ($pregunta->dificultade_id == old('dificultade_id')))
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
<br>
<label>Descripción de la Pregunta:&nbsp;
    <textarea name="pregunta" id="pregunta" class="form-control" rows="2" cols="50">{{$pregunta->pregunta ?? old('pregunta')}}</textarea>
</label>
@error('pregunta')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror

<br>
<label>¿Pregunta Demo?:&nbsp;
    <div class="form-check">
        <input type="radio" class="form-check-input" id="demo1" name="demo" value="1" {{((isset($pregunta->demo)) and $pregunta->demo == "1") ? 'checked' : (old("demo")  == "1" ? 'checked' : '')}}>Sí
        <label class="form-check-label" for="demo1"></label>
      </div>
      <div class="form-check">
        <input type="radio" class="form-check-input" id="demo2" name="demo" value="0" checked {{((isset($pregunta->demo)) and $pregunta->demo == "0") ? 'checked' : (old("demo")  == "0" ? 'checked' : '')}}>Nó
        <label class="form-check-label" for="demo2"></label>
      </div>
</label>
@error('demo')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror

<br>
<label>Estatus de la pregunta:&nbsp;
    <div class="form-check">
        <input type="radio" class="form-check-input" id="status1" name="status" value="1" checked {{((isset($pregunta->status)) and $pregunta->status == "1") ? 'checked' : (old("status")  == "1" ? 'checked' : '')}}>Activa
        <label class="form-check-label" for="status1"></label>
      </div>
      <div class="form-check">
        <input type="radio" class="form-check-input" id="status2" name="status" value="0" {{((isset($pregunta->status)) and $pregunta->status == "0") ? 'checked' : (old("status")  == "0" ? 'checked' : '')}}>Inactiva
        <label class="form-check-label" for="status2"></label>
      </div>
</label>
@error('status')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
<br><hr>
<!-- aqui iban los tres div -->
<div id="R">

</div>
