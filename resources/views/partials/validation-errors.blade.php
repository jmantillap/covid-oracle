@if (session()->has('flash'))
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('flash')}}
    </div>
@endif
@if (session()->has('flash-error'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('flash-error')}}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Por favor corrige los siguentes errores:</strong>
            <ul>
                @foreach ($errors->all() as $item)
                <li>
            <strong class="text-danger">{{$item}}</strong>
                    </li>
                    
                @endforeach
                
            </ul>
    </div>   
@endif