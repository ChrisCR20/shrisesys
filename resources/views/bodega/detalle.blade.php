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
              <li class="breadcrumb-item"><a href="#">Egresos</a></li>
              <li class="breadcrumb-item active">Detalle</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="card">
  <div class="card-header" style="background-color: #f3bb53">
    <h3 >Pedido # {{$etapas['0']['id_encabezadof']}} </h3>
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
                    <input  data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask id="fechafactc" value="{{ $etapas['0']['fecha'] }}" name="fechafactc" class="form-control" required>

                </div>
                </div>
                <div class="col-lg-8">
                    <label for="exampleInputPassword1">Cliente</label>
                    <input type="text" class="form-control" id="id_clientes" name="id_clientes" value="{{$etapas['0']['nombrecliente']}}"  readonly >
  
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
                    </tr>
                </thead>

                </table>
            </div>
{{--         
    </form> --}}
  </div>

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