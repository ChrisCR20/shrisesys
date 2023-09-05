@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
@include('compra/modaledit')
<div class="container">

  <div class="justify-content-center">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Compras</a></li>
              <li class="breadcrumb-item active">Editar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="card">
  <div class="card-header" style="background-color: #f3bb53">
    <h3 >Factura: {{$etapas['0']['serie'].'-'.$etapas['0']['numerodoctoc']}} </h3>
    <span class="float-right">
      <a class="btn btn-light btn-sm" href="{{ route('indexcompras') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
  </span>
</div>
  <div class="card-body">
{{-- <form method="post" id="compra_form"> --}}
              <div class="form-group row">
                <div class="col-lg-4">
                  <label class="form-label" for="sigla">Fecha de factura </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input  data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask id="fechafactc" value="{{ date('Y-m-d H:i:s') }}" name="fechafactc" class="form-control" required>
                  </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="sigla">Serie </label>
                    <input type="text" class="form-control" id="serie" name="serie"  value="{{$etapas['0']['serie']}}" required>
                  </div>
                  <div class="col-lg-4">
                    <label class="form-label" for="sigla">Numero </label>
                    <input type="text" class="form-control" id="numerodoctoc" name="numerodoctoc" value="{{$etapas['0']['numerodoctoc']}}" required>
                  </div>
                  <input type="hidden" class="form-control" id="id_tipopagos" name="id_tipopagos" value="{{$etapas['0']['id_tipopago']}}"  readonly required>
                  <input type="hidden" class="form-control" id="id_proveedors" name="id_proveedors" value="{{$etapas['0']['id_proveedor']}}"  readonly required>
                  <input type="hidden" class="form-control" id="idencabezado" name="idencabezado" value="{{$etapas['0']['id_encabezadofacturac']}}"  readonly required>
              </div>
              <div class="form-group row post">
                <div class="col-lg-4">
                  <label for="exampleInputPassword1">Proveedor</label>
                  <select class="form-control select2" id="id_proveedor" name="id_proveedor" style="width: 100%;">
                    @if (isset($proveedor))
                    @foreach($proveedor as $per)
                        <option value="{{$per->id_proveedor}}" selected="">{{$per->nombreproveedor}}</option>
                    @endforeach
                    @endif
            
                  </select>

                </div>
                <div class="col-lg-4">
                  <label for="exampleInputPassword1">Tipo de pago</label>
                  <select class="form-control select2" id="id_tipopago" name="id_tipopago" style="width: 100%;">
                    @if (isset($tipopago))
                    @foreach($tipopago as $per)
                        <option value="{{$per->id_tipopago}}" selected="">{{$per->nombretipo}}</option>
                    @endforeach
                    @endif
                  </select>

                </div>
                <div class="col-lg-4">
                  <label class="form-label" for="sigla">Total </label>
                    <input type="text" class="form-control" id="total" name="total"  value="{{$etapas['0']['totalcompra']}}" required>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                <table id="tablacompaedit" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th >Cantidad</th>
                        <th >Producto</th>
                        <th >Subtotal</th>
                        <th ></th>
                    </tr>
                </thead>

                </table>
            </div>
{{--         
    </form> --}}
  </div>
  <div class="card-footer">  <button type="button" id="guardaredit" class="btn btn-success float-left">Guardar</button></div>
</div>
</div>
</div>
@endsection
@section('js')
{{-- <script src="{{ asset('js/Compra/compra_c.js') }}"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
        $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});

document.getElementById("guardaredit")
    .addEventListener("click", function(event) {

        event.preventDefault();

       

        var fecha = $('#fechafactc').val();
       var serie = $('#serie').val();
       var numero = $('#numerodoctoc').val();
       var proveedor = $('#id_proveedor').val();
       var tippago =$('#id_tipopago').val();
       var total  =$('#total').val();
       var encabezado  =$('#idencabezado').val();

       Swal.fire({
            title: 'Actualizar datos',
            text: "Esta seguro de actualizar los datos de compra?",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
          }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Actualizada',
                    'El registro fue actualizado',
                    'success'
                  ).then((result) => {
                    if (result.value) {
                      $.ajax({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
       url:"edicioncabezac",
       type:"POST",
       data: {fecha:fecha, serie:serie,numero:numero,proveedor:proveedor,tippago:tippago,total:total,encabezado:encabezado},
       success: function(e){
        location.href = "../indexcompras";
       }
      
     
     });
                    }
                  })
                  
            }
          });


    });

if ($('#id_tipopago').find("option[value='" + $('#id_tipopagos').val() + "']").length)
            {$('#id_tipopago').select2().val($('#id_tipopagos').val()).trigger('change'); }

if ($('#id_proveedor').find("option[value='" + $('#id_proveedors').val() + "']").length)
            {$('#id_proveedor').select2().val($('#id_proveedors').val()).trigger('change'); }

  function editarc(id_detallefc){ 
     
  var idetallefc = id_detallefc;
  $.ajax({url:'compra/obteneritem/'+idetallefc}).done(function(data){
      console.log(data);
      $('#producto').val(data[0].nombreproducto);
      $('#cantidad').val(data[0].cantidad);
      $('#subtotal').val(data[0].subtotal);
      $('#iditem').val(data[0].id_producto);
      $('#iddetallec').val(data[0].id_detallefacturac);
      $('#idencabe').val(data[0].id_encabezadofacturaC);

     // console.log(data);
  });

  $('#modaleditaritem').modal('show');

  }
  // function init(){
  //   $("#compra_item_edit").on("submit",function(e)
  // {
  //   edicion(e);
  // });}
  


  $(document).ready(function(){
    $('#tablacompaedit').DataTable({
            "responsive": false,
            "autoWidth": false,
           "searching": true,
           "lengthChange": true,
            "ajax":{
                url:'',
                type: "get",
                dataType: "json",
            },
            columns :[
                {
                    data:'cantidad',
                    name:'cantidad'
                },
                {
                  data:'nombreproducto',
                  name:'nombreproducto'
              },
                {
                  data:'subtotal',
                  name:'subtotal'
              },
                {
                    data:'action',
                    name:'action'
                },
                
            ],           "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
                });


  })

  document.getElementById("dog")
    .addEventListener("click", function(event) {

        event.preventDefault();
    
       var dog=0

       var cantidad = $('#cantidad').val();
       var iditem = $('#iditem').val();
       var subtotal = $('#subtotal').val();
       var iddetallec = $('#iddetallec').val();
       var idencabe =$('#idencabe').val();
        
        $.ajax({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
       url:"edicion",
       type:"POST",
       data: {subtotal:subtotal, cantidad:cantidad,iditem:iditem,dog:dog,iddetallec:iddetallec,idencabe:idencabe},
       success: function(e){
        console.log(e[0].totalcompra)
        $('#total').val(e[0].totalcompra);
        toastr.success('Item editado exitosamente', 'Buen Trabajo',{timeOut: 2000});
       // console.log(data);
        // alert('nada');
       // $('#compra_item_edit')[0].reset();
        $('#tablacompaedit').DataTable().ajax.reload()
       //   $('#tick_titulo').val('');
         $('#modaleditaritem').modal('hide')

 

       }
      
     
     });

    });

        
  </script>
    <script>

  </script>
  @endsection