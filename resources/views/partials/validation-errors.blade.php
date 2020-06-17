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
<style>
    .form-control.has-warning {
        border-color: #d39e00; !important;
        padding-right: calc(1.5em + .75rem) !important;       
        background-repeat: no-repeat;
        background-position: center right calc(.375em + .1875rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }
</style>
{{-- .form-control.is-invalid, .was-validated .form-control:invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + .75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
    background-repeat: no-repeat;
    background-position: center right calc(.375em + .1875rem);
    background-size: calc(.75em + .375rem) calc(.75em + .375rem);
} --}}