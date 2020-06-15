@csrf
<label>
    Nombre de la Sede
    <input class="form-control" type="text" name="t_sede" placeholder="Digite el Nombre de la Sede" value="{{ old('t_sede',$sedes->t_sede) }}">
</label>
<br>

<label>
    Ciudad
    <select name="n_idciudad" class="form-control" id="n_idciudad">
        <option value="" >--Seleccionar Ciudad--</option>
        @foreach($ciudades as $ciudad)
             <option value="{{$ciudad->n_id }}"
                @if ($ciudad->n_id == old('n_idciudad', $sedes->n_idciudad))
                selected="selected"
            @endif
                
                >{{ $ciudad->t_nombre }} </option> 
        @endforeach
        </select>
</label><br>
<button class="btn btn-info" type="submit">{{ $btnText }}</button>