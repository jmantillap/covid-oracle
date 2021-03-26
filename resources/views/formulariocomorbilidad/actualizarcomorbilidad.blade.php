@extends('layout')
@section('title','Actualizar Encuesta de Estado de Salud')
@section('titulopag','Administración')
@section('elcontrolador','Menu Principal')
@section('laaccion','ACTUALIZAR SEMAFORO ENCUESTA DE ESTADO DE SALUD.')
@section('content')
@csrf    
<div class="row">
    <div class="col-4"><label id="ld_ultimocontacto">Búsqueda documento del Usuario o pidm (Con ceros)</label></div>    
</div>
<div class="row">
    <div class="col-4">
        <input required size=40 class="form-control col-md-50" id="parametro" name="parametro">
    </div>    
    <div class="col-4">        
        <button id="btnConsultar" name="btnConsultar" class="btn btn-info" type="button">Consultar</button>    
    </div>    
</div>    
{{-- <div class="col-4"> <label id="ld_ultimocontacto">Búsqueda documento del Usuario o pidm </label><input required size=40 class="form-control col-md-50" id="documento" name="documento"></div>
<div class="col-sm"><button id="btnConsultar" name="btnConsultar" class="btn btn-info" type="button">Consultar</button></div> --}}
<br/>
<div class="row">    
    <div class="table-responsive">
        <table id="tblComorbilidadActualizar" class="table table-bordered table-striped tbl">
            <thead><tr><th>Formulario</th><th>Nombre</th><th>Documento</th><th>Pidm</th>
                <th>Tipo</th><th>Consentimiento</th><th>Fecha</th><th>Semaforo</th><th class="text-center">Actualizar</th></tr></thead>
            <tbody></tbody>
            <tfoot>
                {{-- <tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Actualización</th><th>Estado</th><th class="text-center">Seleccionar</th></tr> --}}
            </tfoot>
        </table>
    </div>    
</div>
<br/>
<div class="row"> 
    <div class="table-responsive" >
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-archive"></i>Información Acta</h3>
            </div>   
            <div class="card-body">
                <table id="tblActa" class="table table-bordered table-striped tbl">
                    <thead><tr><th>Formulario</th><th>Nombre</th><th>Documento</th><th>Pidm</th>
                        <th>Consentimiento</th><th>Fecha</th><th>Semaforo</th></thead>
                    <tbody></tbody>
                    <tfoot>                
                    </tfoot>
                </table>    
            </div>             
        </div>
    </div>
</div>
<div class="row"> 
    <div class="table-responsive" >
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-archive"></i>Encuesta Diaria {{ date('d/m/Y') }}</h3>
            </div>   
            <div class="card-body">
                <table id="tblDiariaHoy" class="table table-bordered table-striped tbl">
                    <thead><tr><th>Formulario</th><th>Nombre</th><th>Documento</th><th>Pidm</th><th>Tipo</th>
                        <th>Consentimiento</th><th>Fecha</th><th>Semaforo</th></thead>
                    <tbody></tbody>
                    <tfoot>                
                    </tfoot>
                </table>    
            </div>             
        </div>
    </div>
</div>


@endsection
@include('partials.validation-errors')
@include('partials.session-status')
@section('script-custom')
<link rel="stylesheet" href="/plugins/jAlert-master/dist/jAlert.css">
<script src="/plugins/jAlert-master/dist/jAlert.min.js"></script>
<script src="/plugins/jAlert-master/dist/jAlert-functions.min.js"></script>
<script>         
    $(function () {
        $("#menuActualizarComorbilidad").addClass("active" );

        var oEncuestas = $("#tblComorbilidadActualizar" ).DataTable({
            'paging' : true,    'ordering': false,     "searching": true,   "processing": true, "serverSide": true, "pageLength": 50,"info": true,
            "language": {"url": "/plugins/datatables/locale/Spanish.json",},
            "ajax": { url: '{{ route('encuesta.comorbilidad.actualizar.consultar.ajax') }}'
                      , data: function (d) {d.parametro = $("#parametro").val(); }                      
                    },
            "columns":[{data:'id',className: "text-center","width": "5%"}                       
                       ,{data:'nombre',"width": "30%"}
                       ,{data:'documento',"width": "10%"}
                       ,{data:'pidm',"width": "10%"}
                       ,{data:'tipo',"width": "10%"}
                       ,{data:'consentimiento',"width": "10%"}
                       ,{data:'fecha'}
                       ,{data:'semaforo'}
                       ,{data:'accion',className: "text-center"}
                      ],            
        });

        var oActas = $("#tblActa" ).DataTable({
            'ordering': false, "processing": true, "serverSide": true, "info": false, "searching": false, 'paging' : false,
            "language": {"url": "/plugins/datatables/locale/Spanish.json",},
            "ajax": { url: '{{ route('acta.covid19.consultar.ajax') }}'
                      , data: function (d) {d.parametro = $("#parametro").val(); }                      
                    },
            "columns":[{data:'id',className: "text-center","width": "5%"}                       
                       ,{data:'nombre',"width": "30%"}
                       ,{data:'documento',"width": "10%"}
                       ,{data:'pidm',"width": "10%"}                       
                       ,{data:'consentimiento',"width": "10%"}
                       ,{data:'fecha'}
                       ,{data:'semaforo'}                       
                      ],            
        });

        var oDiaria = $("#tblDiariaHoy" ).DataTable({
            'paging' : false,    'ordering': false,     "searching": false,   "processing": true, "serverSide": true, "pageLength": 50,"info": false,
            "language": {"url": "/plugins/datatables/locale/Spanish.json",},
            "ajax": { url: '{{ route('encuesta.comorbilidad.consultar.diaria.ajax') }}'
                      , data: function (d) {d.parametro = $("#parametro").val(); }                      
                    },
            "columns":[{data:'id',className: "text-center","width": "5%"}                       
                       ,{data:'nombre',"width": "30%"}
                       ,{data:'documento',"width": "10%"}
                       ,{data:'pidm',"width": "10%"}
                       ,{data:'tipo',"width": "10%"}
                       ,{data:'consentimiento',"width": "10%"}
                       ,{data:'fecha'}
                       ,{data:'semaforo'}                       
                      ],            
        });

        $("#btnConsultar").on("click", function () {                                    
            if($('#parametro').val()==""){ warningAlert('Parametro','Debe digitar el documento de usuario o Pidm'); return; }
            oEncuestas.draw(); 
            oActas.draw(); 
            oDiaria.draw(); 
        });

        oEncuestas.on('click','button.btn-actualizar', function () {
           if (typeof $(this).attr("data-id") != 'undefined') {
               var id=$(this).attr('data-id');
               $.fn.jAlert.defaults.confirmBtnText = 'Si, Actualizar';
               $.fn.jAlert.defaults.confirmQuestion = 'Esta seguro de Actualizar a Semaforo en "VERDE" el formulario ? <br/> * '
               + $(this).attr('data-nombre')+'<br/>*'
               + $(this).attr('data-documento')+'<br/>*'
               + $(this).attr('data-pidm')
               + '<br><span class="badge badge-danger">No se podrá revertir la acción. Esta seguro? </span><br/> ';
               $.fn.jAlert.defaults.title = 'Actualizar Encuesta Comorbilidad';
               $.fn.jAlert.defaults.confirmAutofocus = '.denyBtn';
               confirm(function(e,btn){ //event + button clicked
                    e.preventDefault();
                    $.ajax({
                        type: "POST", url: "{{ route('encuesta.comorbilidad.actualizar.ajax') }}",
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