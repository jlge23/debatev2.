<label>Descripción:&nbsp;
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{$tipo->nombre ?? old('nombre')}}">
</label>
@error('nombre')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
<br>
<label>Opciones para respuesta:&nbsp;
    <select name="opciones" id="opciones" class="form-select">
        <option value="">Seleccione</option>
        @if(isset($tipo))
            @for ($i=1;$i<=4;$i++)
                @if (($i == $tipo->opciones))
                    <option value="{{$tipo->opciones}}" selected>{{$tipo->opciones}}</option>
                @else
                    <option value="{{$i}}">{{$i}}</option>
                @endif
            @endfor
        @else
            @for ($i=1;$i<=4;$i++)
                @if ($i == 1)
                    <option value="{{$i}}" selected>{{$i}}</option>
                @else
                    <option value="{{$i}}">{{$i}}</option>
                @endif
            @endfor
        @endif
    </select>
</label>
@error('opciones')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
<br>
<label>Estatus:&nbsp;
    <div class="form-check">
        <input type="radio" class="form-check-input" id="status1" name="status" value="1" {{((isset($tipo->status)) and $tipo->status == "1") ? 'checked' : (old("status")  == "1" ? 'checked' : '')}}>Activo
        <label class="form-check-label" for="status1"></label>
      </div>
      <div class="form-check">
        <input type="radio" class="form-check-input" id="status2" name="status" value="0" {{((isset($tipo->status)) and $tipo->status == "0") ? 'checked' : (old("status")  == "0" ? 'checked' : '')}}>Inactivo
        <label class="form-check-label" for="status2"></label>
      </div>
</label>
@error('status')
    <br><small class="text text-danger">*&nbsp;{{$message}}</small><br>
@enderror
