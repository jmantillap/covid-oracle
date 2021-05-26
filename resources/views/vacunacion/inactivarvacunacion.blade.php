@extends('layout')
@section('title','Inactivar Vacunación')
@section('titulopag','Administración')
@section('elcontrolador','Menu Princial')
@section('laaccion','INACTIVAR REGISTRO VACUNACIÓN COVID 19.')
@section('content')
@csrf    
<div class="row">
    <div class="col-4"><label id="ld_ultimocontacto">Búsqueda documento del Usuario o pidm </label></div>    
</div>
<div class="row">
    <div class="col-4"><input required size=40 class="form-control col-md-50" id="parametro" name="parametro"></div>    
    <div class="col-4"><button id="btnConsultar" name="btnConsultar" class="btn btn-info" type="button">Consultar</button></div>    
</div>    
<br/>
<div class="row">    
    <div class="table-responsive">
        <table id="tblVacunacionInhabilitar" class="table table-bordered table-striped tbl">
            <thead><tr><th>Formulario</th><th>Nombre</th><th>Documento</th><th>Pidm</th>
                <th>Tipo</th><th>Vacunación</th><th>Fecha</th><th class="text-center">Inactivar</th></tr></thead>
            <tbody></tbody>
            <tfoot>
            {{-- <tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Actualización</th><th>Estado</th><th class="text-center">Seleccionar</th></tr> --}}
            </tfoot>
        </table>
    </div>    
</div>
{{-- </div> --}}
@endsection
@include('partials.validation-errors')
@include('partials.session-status')
@section('script-custom')
<link rel="stylesheet" href="/plugins/jAlert-master/dist/jAlert.css">
<script src="/plugins/jAlert-master/dist/jAlert.min.js"></script>
<script src="/plugins/jAlert-master/dist/jAlert-functions.min.js"></script>
<script>         
    $(function () {
        $("#menuInactivarVacunacion").addClass("active" );

        var oEncuestas = $("#tblVacunacionInhabilitar" ).DataTable({
            'paging' : true,    'ordering': false,     "searching": true,   "processing": true, "serverSide": true, "pageLength": 50,"info": true,
            "language": {"url": "/plugins/datatables/locale/Spanish.json",},
            "ajax": { url: '{{ route('encuesta.vacunacion.consultar.ajax') }}'
                      , data: function (d) {d.parametro = $("#parametro").val(); }                      
                    },
            "columns":[{data:'id',className: "text-center","width": "5%"}                       
                       ,{data:'nombre',"width": "30%"}
                       ,{data:'documento',"width": "10%"}
                       ,{data:'pidm',"width": "10%"}
                       ,{data:'tipo',"width": "10%"}
                       ,{data:'vacuna',"width": "10%"}
                       ,{data:'fecha'}
                       ,{data:'accion',className: "text-center"}
                      ],            
        });

        $("#btnConsultar").on("click", function () {                                    
            if($('#parametro').val()==""){ warningAlert('Parametro','Debe digitar el documento de usuario o Pidm'); return; }
            oEncuestas.draw();            
        });

        oEncuestas.on('click','button.btn-inactivar', function () {
           if (typeof $(this).attr("data-id") != 'undefined') {
               var id=$(this).attr('data-id');
               $.fn.jAlert.defaults.confirmBtnText = 'Si, Inactivar';
               $.fn.jAlert.defaults.confirmQuestion = 'Esta seguro de Inactivar Vacunación ? <br/> * '
               + $(this).attr('data-nombre')
               + '<br><span class="badge badge-danger">No se podrá revertir la acción. Esta seguro? </span><br/> ';
               $.fn.jAlert.defaults.title = 'Inactivar Registro de vacunación';
               $.fn.jAlert.defaults.confirmAutofocus = '.denyBtn';
               confirm(function(e,btn){ //event + button clicked
                    e.preventDefault();
                    $.ajax({
                        type: "POST", url: "{{ route('encuesta.vacunacion.inactivar.ajax') }}",
                        data: { '_token': $('input[name=_token]').val(), 'id_formulario':id, },
                        success: function(response){
                            if(response.status=="1"){
                                oEncuestas.draw(); successAlert('Inactivación',response.msg);
                            }else{
                                if(typeof response.msg != "undefined"){ errorAlert('Error',response.msg); }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) { 
                            console.log(JSON.stringify(jqXHR)); console.log("AJAX error: " + textStatus + ' : ' + errorThrown); 
                            errorAlert('Error',errorThrown);
                        }
                    });                
                }, function(e,btn){
                    e.preventDefault(); //errorAlert('Denied!');
                });
           }
       });
       $(document).on('keypress',function(e) {
            if(e.which == 13 && $('#parametro').val()!="" ) {                
                $("#btnConsultar").trigger( "click" );
            }
        });

    });
</script>
@endsection
