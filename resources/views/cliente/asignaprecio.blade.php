@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
@include('cliente/modaleditaritem')
<div class="container">

  <div class="justify-content-center">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cliente</a></li>
              <li class="breadcrumb-item active">Asignar precio</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @include('cliente/modalasignacion')
    <div class="card">
  <div class="card-header" style="background-color: #f3bb53">
    <h3 >Cliente: {{$etapas1['0']['nombrecliente']}} </h3>
    <span class="float-right">
        <a class="btn btn-sm btn-light"  title="Agregar" id="btnnasigna"><div><i  style="color: rgb(177, 63, 32)" class="fa fa-plus"></i></div></a>
      <a class="btn btn-light btn-sm" href="{{ route('indexcliente') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
  </span>
</div>
  <div class="card-body">
{{-- <form method="post" id="compra_form"> --}}
            <div class="table-responsive">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <table id="tablasigna" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th >Presentacion</th>
                        <th >Precio</th>
                        <th ></th>
                    </tr>
                </thead>

                </table>
            </div>
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
    function init(){


  $("#asignap_form").on("submit",function(e)
  {
     asignarp(e);
  });
}

        $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});

  $(document).ready(function(){
    $('#tablasigna').DataTable({
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
                    data:'nombremedida',
                    name:'nombremedida'
                },
                {
                  data:'precio',
                  name:'precio'
              },
                {
                    data:'action',
                    name:'action'
                },
                
            ],           "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
                });


  });

  $(document).on("click","#btnnasigna",function(){

$('#modalasignacion').modal('show');

});

function asignarp(e) {
    e.preventDefault();

    var formData = new FormData($("#asignap_form")[0]);
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url:"asignapreciostore",
      type:"POST",
      data: formData,
      contentType:false,
      processData:false,
      success: function(e){
      // console.log(data);
       // alert('nada');
       $('#asignap_form')[0].reset();
       $('#tablasigna').DataTable().ajax.reload();
      //   $('#tick_titulo').val('');
        $('#modalasignacion').modal('hide');


        toastr.success('Precio agregado exitosamente', 'Buen Trabajo',{timeOut: 5000});
      }
     
    
    });
    
  }

  function editar(id_presentacionprecio){ 
     
     var idetallepp = id_presentacionprecio;
     $.ajax({url:'cliente/obteneritem/'+idetallepp}).done(function(data){
         console.log(data);
         $('#presentacion').val(data[0].nombremedida);
         $('#precio').val(data[0].precio);
         $('#iditem').val(data[0].id_prcl);

   
         console.log(data);
     });
   
     $('#modaleditaritem').modal('show');
   
     }

     document.getElementById("dog")
    .addEventListener("click", function(event) {

        event.preventDefault();
    
    

       var precio = $('#precio').val();
       var iditem = $('#iditem').val();

        
        $.ajax({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
       url:"edicion",
       type:"POST",
       data: {precio:precio,iditem:iditem},
       success: function(e){
       // console.log(e[0].totalcompra)
       // $('#total').val(e[0].totalcompra);
        toastr.success('Item editado exitosamente', 'Buen Trabajo',{timeOut: 2000});
       // console.log(data);
        // alert('nada');
       // $('#compra_item_edit')[0].reset();
        $('#tablasigna').DataTable().ajax.reload()
       //   $('#tick_titulo').val('');
         $('#modaleditaritem').modal('hide')

 

       }
      
     
     });

    });
  init();

        
  </script>
  @endsection