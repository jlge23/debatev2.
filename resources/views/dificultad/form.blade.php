<label>Dificultad:&nbsp;
    <input type="text" name="dificultad" id="dificultad" class="form-control" value="{{$dificultad->dificultad ?? old('dificultad')}}">
</label>
@error('dificultad')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
<br>
<label>Puntaje:&nbsp;
    <input type="number" name="puntaje" id="puntaje" class="form-control" min="1" max="99" value="{{$dificultad->puntaje ?? old('dificultad')}}">
</label>
@error('puntaje')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
<br>
<label>Tiempo:&nbsp;
    <input type="number" name="tiempo" id="tiempo" class="form-control" min="1" max="99" value="{{$dificultad->tiempo ?? old('dificultad')}}">
</label>
@error('tiempo')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
<br>
<label>Estatus de la dificultad:&nbsp;
    <div class="form-check">
        <input type="radio" class="form-check-input" id="status1" name="status" value="1" {{((isset($dificultad->status)) and $dificultad->status == "1") ? 'checked' : (old("status")  == "1" ? 'checked' : '')}}>Activo
        <label class="form-check-label" for="status1"></label>
      </div>
      <div class="form-check">
        <input type="radio" class="form-check-input" id="status2" name="status" value="0" {{((isset($dificultad->status)) and $dificultad->status == "0") ? 'checked' : (old("status")  == "0" ? 'checked' : '')}}>Inactivo
        <label class="form-check-label" for="status2"></label>
      </div>
</label>
@error('status')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
