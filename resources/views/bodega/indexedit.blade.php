@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
@include('bodega/modaledititem')
<div class="container">

  <div class="justify-content-center">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Egresos</a></li>
              <li class="breadcrumb-item active">Detalle</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="card">
  <div class="card-header" style="background-color: #EC684C">
    <h3 >Edición de pedido # {{$etapas['0']['id_encabezadof']}} </h3>
    <span class="float-right">
      <a class="btn btn-light btn-sm" href="{{ route('indexbodega') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
  </span>
</div>
  <div class="card-body">
{{-- <form method="post" id="compra_form"> --}}
              <div class="form-group row">
                <div class="col-lg-4">
                  <label class="form-label" for="sigla">Fecha de pedido </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask id="fechafactc" value="{{ $etapas['0']['fecha'] }}" name="fechafactc" class="form-control" required>
                    <input type="hidden" class="form-control" id="idencab" name="idencab" placeholder="Nombre" value="{{$etapas['0']['id_encabezadof']}}" >
                </div>
                </div>
                <div class="col-lg-8">
                    <label for="exampleInputPassword1">Cliente</label>
                    <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="{{$etapas['0']['id_cliente']}}">
                    <select class="form-control select2" id="id_cliente" name="id_cliente"  style="width: 100%;">
                        @foreach( $cliente as $key => $value )
                          <option selected="selected" value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                      </select>
                    
                  </div>
              </div>
              <div class="form-group row post">
  
                {{-- <div class="col-lg-4">
                  <label class="form-label" for="sigla">Total </label>
                    <input type="text" class="form-control" id="total" name="total"  value="{{$etapas['0']['totalcompra']}}" required>
                </div> --}}
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                <table id="tabladetalleegreso" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th >Cantidad</th>
                        <th >Producto</th>
                        <th></th>
                    </tr>
                </thead>

                </table>
            </div>
{{--         
    </form> --}}
  </div>
  <div class="card-footer">  <button type="button" id="saveedit" class="btn btn-success">Guardar</button>
    <button type="button" id="deletep" class="btn btn-warning">Eliminar pedido</button>
</div>
</div>
</div>
</div>
@endsection
@section('js')
{{-- <script src="{{ asset('js/Compra/compra_c.js') }}"></script> --}}
<script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
        $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});
$('.select2').select2();

$(":input").inputmask();

if ($('#id_cliente').find("option[value='" + $('#id_clientes').val() + "']").length)
            {$('#id_cliente').select2().val($('#id_clientes').val()).trigger('change'); }

  $(document).ready(function(){
    $('#tabladetalleegreso').DataTable({
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
                  data:'action',
                  name:'action'
              }
                
            ],           "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
                });


  })

  document.getElementById("dog")
    .addEventListener("click", function(event) {

        event.preventDefault();
    
       var dog=0
        var cantidadreal=0;
       var cantidad = $('#cantidad').val();
       var cantidadvact = parseFloat($('#cantidadvact').val());
       var idpract=$('#iditem').val();
       var iditem = $('#id_producto').val();
       var iddetallec = $('#iddetallec').val();
       var idencabe =$('#idencabe').val();
       var idcl =$('#id_clienteselect').val();
        
       $.ajax({url:'/bodega/obtener/p_unitario/'+iditem+'/'+idcl}).done(function(data) 
            {
                cantidadmodal=parseFloat(cantidad);

                if(idpract==iditem){
                            if(cantidadmodal<cantidadvact){
                            cantidadreal=cantidadvact-cantidadmodal;
                            console.log(cantidadreal)
                        }
                        else
                        {
                            cantidadreal=cantidadmodal-cantidadvact;
                            console.log(cantidadreal);
                        }
                }else{

                    cantidadreal=cantidadmodal;
                    console.log(cantidadreal);
                }

          
                    if(data["cantidad"]<cantidadreal)
                        {
                            
                            Swal.fire(
                                'Pocas Existencias',
                                'Tiene '+data["cantidad"]+' unidades disponibles en bodega',
                                'warning'
                                )
            
                        }
                     else
                     {
                        $.ajax({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
       url:"edicion",
       type:"POST",
       data: {cantidad:cantidad,iditem:iditem,dog:dog,iddetallec:iddetallec,idencabe:idencabe,idcl:idcl},
       success: function(e){

        toastr.success('Item editado exitosamente', 'Buen Trabajo',{timeOut: 2000});
        $('#tabladetalleegreso').DataTable().ajax.reload()
       //   $('#tick_titulo').val('');
         $('#modaleditaritem').modal('hide')

        }
      
     
    });
                    
                     }
            });




       // console.log(data);
        // alert('nada');
       // $('#compra_item_edit')[0].reset();


 


    });

    function editarb(id_detallef){
      $.ajax({url:'obteneritem/'+id_detallef}).done(function(data){
      console.log(data);
      id_cl=$('#id_cliente').val();
      $('#producto').val(data[0].nombreproducto);
      $('#cantidad').val(data[0].cantidad);
      $('#cantidadvact').val(data[0].cantidad);
      $('#iditem').val(data[0].id_producto);
      $('#iddetallec').val(data[0].id_detallef);
      $('#idencabe').val(data[0].id_encabezadof);
      $('#id_clienteselect').val(id_cl);

     // console.log(data);
     if ($('#id_producto').find("option[value='" + $('#iditem').val() + "']").length)
            {$('#id_producto').select2().val($('#iditem').val()).trigger('change'); }
    });


      $('#modaleditaritem').modal('show');
     }

     document.getElementById("saveedit")
    .addEventListener("click", function(event) {

        event.preventDefault();

       

        var fecha = $('#fechafactc').val();
       var cliente = $('#id_cliente').val();
       var encabezado  =$('#idencab').val();

       Swal.fire({
            title: 'Actualizar datos',
            text: "Esta seguro de actualizar los datos del pedido?",
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
       url:"edicioncabezav",
       type:"POST",
       data: {fecha:fecha, cliente:cliente,encabezado:encabezado},
       success: function(e){
        location.href = "../indexbodega";
       }
      
     
     });
                    }
                  })
                  
            }
          });


    });

    document.getElementById("deletep")
    .addEventListener("click", function(event) {

        event.preventDefault();

        var encabezado  =$('#idencab').val();

       Swal.fire({
            title: 'Eliminar pedido?',
            text: "Una vez eliminado el pedido ya no podra recuperarse",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
          }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Eliminado',
                    'El pedido fue eliminado',
                    'success'
                  ).then((result) => {
                    if (result.value) {
                      $.ajax({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
       url:"deletepedido",
       type:"POST",
       data: {encabezado:encabezado},
       success: function(e){
        location.href = "../indexbodega";
       }
      
     
     });
                    }
                  })
                  
            }
          });


    });

        
  </script>
    <script>

  </script>
  @endsection