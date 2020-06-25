@csrf

<script> 
    $(document).ready(function(){
        $("#t_emailc").on('paste', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })
        $("#t_emailc").on('copy', function(e){
            e.preventDefault();
            alert('Esta acción está prohibida');
        })
    })
</script>
    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Datos de Contacto</h3>
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>     
                                @endforeach
                            </ul> 
                        @endif  
                    </div>
                    <input id="t_sigaa" name="t_sigaa" type="hidden" value="SI">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="hidden" id="t_activo" name="t_activo" value="SI">    
                            
                            <div class="form-group row">
                                <label for="c_codtipo" class="col-md-5 col-form-label text-md-right">{{ __('Tipo Documento *') }}</label>
                                <div class="col-md-6">
                                    <input readonly id="c_codtipodesc" type="text" name="c_codtipodesc"
                                    class="form-control @error('c_codtipo') is-invalid @enderror" value="{{ $usuario_tipo_documento->descripcion_tipo_documento}}" >
                                    <input type="hidden" id="c_codtipo" name="c_codtipo" value="{{ $usuario->tipo_documento}}"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="t_documento" class="col-md-5 col-form-label text-md-right">{{ __('Documento *') }}</label>
    
                                <div class="col-md-6">
                                    <input readonly placeholder="Solo numeros, no use puntos ni guiones" id="t_documento" type="number" class="form-control @error('t_documento') is-invalid @enderror" name="t_documento" value="{{ $usuario->documento }}" required autocomplete="documento" >
    
                                    @error('t_nombres')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="t_nombres" class="col-md-5 col-form-label text-md-right">{{ __('Nombres *') }}</label>
                                <div class="col-md-6">
                                    <input readonly id="t_nombres" type="text" class="form-control @error('t_nombres') is-invalid @enderror" name="t_nombres" value="{{ $usuario->primer_nombre }} {{ $usuario->segundo_nombre }}" required autocomplete="nombres" >
                                    @error('t_nombres')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="t_apellidos" class="col-md-5 col-form-label text-md-right">{{ __('Apellidos *') }}</label>
                                <div class="col-md-6">
                                    <input readonly id="t_apellidos" type="text" class="form-control @error('t_apellidos') is-invalid @enderror" name="t_apellidos" value="{{ $usuario->apellidos }}" required autocomplete="apellidos" autofocus>
                                    @error('t_apellidos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="t_idsigaa" class="col-md-5 col-form-label text-md-right">{{ __('ID SIGAA *') }}</label>
                                <div class="col-md-6">
                                    <input readonly id="t_idsigaa" type="text" class="form-control @error('t_idsigaa') is-invalid @enderror" name="t_idsigaa" value="{{ $usuario->id }}"  >
                                    @error('t_idsigaa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="t_email" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail *') }}</label>
    
                                <div class="col-md-6">
                                    <input  id="t_email" type="email" class="form-control @error('t_email') is-invalid @enderror" name="t_email" value="{{ $usuario->correo }}" required >
    
                                    @error('t_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="t_emailc" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail Confirmación *') }}</label>
                                <div class="col-md-6">
                                    <input  id="t_emailc" type="email" class="form-control @error('t_emailc') is-invalid @enderror" name="t_emailc" value="{{ $usuario->correo }}" required >
                                    @error('t_emailc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="t_telefono" class="col-md-5 col-form-label text-md-right">{{ __('Teléfono fijo o Celular *') }}</label>
                                <div class="col-md-6">
                                    <input  required id="t_telefono" type="text" class="form-control @error('t_telefono') is-invalid @enderror" name="t_telefono" value="{{ $usuario->celular }}"  >
                                    @error('t_telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="n_idciudad" class="col-md-5 col-form-label text-md-right">
                                    {{ __('Ciudad *') }}
                                </label>
                                <div class="col-md-6">
                                    <select name="n_idciudad" class="form-control" id="n_idciudad">
                                        <option value="" >--Seleccionar Ciudad--</option>
                                        @foreach($ciudades as $ciudad)
                                            <option value="{{$ciudad->n_id }}"
                                                @if ($ciudad->n_id == old('n_idciudad'))
                                                    selected="selected"
                                                @endif                
                                                >{{ $ciudad->t_nombre }}</option> 
                                        @endforeach
                                    </select>
                                    @error('n_idciudad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="n_idseden_idsede" class="col-md-5 col-form-label text-md-right">{{ __('Sede *') }}</label>
    
                                <div class="col-md-6">
                                    <select name="n_idsede" class="form-control" id="n_idsede">
                                        <option value="" >--Seleccionar Sede--</option>
                                    </select>
                                    @error('n_idsede')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="n_idseden_idsede" class="col-md-5 col-form-label text-md-right">{{ __('Vínculo con la Universidad *') }}</label>
    
                                <div class="col-md-6">
                                    <select name="n_idvinculou" class="form-control" id="n_idvinculou">
                                        <option value="" >--Seleccionar Vínculo--</option>
                                        @foreach($vinculous as $vinculou)
                                             <option value="{{$vinculou->n_idvinculou }}"
                                                @if ($vinculou->n_idvinculou == old('n_idvinculou',$users->n_idvinculou))
                                                selected="selected"
                                            @endif
                                                
                                                >{{ $vinculou->t_vinculo }}</option> 
                                        @endforeach
                                        </select>
    
                                    @error('n_idvinculou')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="t_jefeinmediatocontacto_d">
                                <label for="t_jefeinmediatocontacto" class="col-md-5 col-form-label text-md-right">{{ __('Jefe inmediato o Contacto en la UPB. *') }}</label>
    
                                <div class="col-md-6">
                                    <input  id="t_jefeinmediatocontacto" type="text" class="form-control @error('t_jefeinmediatocontacto') is-invalid @enderror" name="t_jefeinmediatocontacto" value="{{ old('t_jefeinmediatocontacto',$users->t_jefeinmediatocontacto) }}"  >
    
                                    @error('t_jefeinmediatocontacto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> 
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="t_facultadareaempresa_d">
                                <label for="t_facultadareaempresa"  class="col-md-5 col-form-label text-md-right">{{ __('Facultad, Área, Dependencia o Empresa. *') }}</label>
    
                                <div class="col-md-6">
                                    <input id="t_facultadareaempresa" type="text" class="form-control @error('t_facultadareaempresa') is-invalid @enderror" name="t_facultadareaempresa" value="{{ old('t_facultadareaempresa',$users->t_facultadareaempresa) }}"  >
    
                                    @error('t_facultadareaempresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Grabar Usuario') }}
                                    </button>
                                    <a href="{{ route('home') }}" class="btn btn-warning">Volver</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    