@extends('adminlte::page')
@section('plugins.Datatables', true)

@section('content')
<div class="container">
  <div class="justify-content-center">
      @if (\Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ \Session::get('success') }}</p>
          </div>
      @endif
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Categorias</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Categoria</a></li>
            <li class="breadcrumb-item active">Inicio</li>
          </ol>
        </div>
      </div>
      <div class="card">
        @include('categoria/modalcreate')
          <div class="card-header">
              <span class="float-left">
                  {{-- <a class="btn btn-primary" href="{{ route('categoria.create') }}"><div><i class="fa fa-plus-circle "></i></div></a> --}}
                  <button type="button" class="btn btn-info" id="btnnuevacategoria"><div><i class="fa fa-plus-circle "></i></div></button>
              </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablacategoria">
                  <thead class="thead-light">
                    <tr>
                      <th>Id</th>
                      <th>Nombre de categoria</th>
                      <th width="280px">Acciones</th>
                  </tr>
                  </thead>
              </table>
            </div>
              {{-- {{ $etapas->render() }} --}}
          </div>
      </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/Categoria/categoria_in.js') }}"></script>
<script>
    $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});
    $(function () {

   var t=   $("#tablasucursal").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": true, "pageLength": 5,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      

    });
    function eliminar($id)
    {
      
    }

//     $(document).on("click","#btnnuevacategoria",function(){
//     // $('#modaltitle').html('Nuevo Registro');
//     // $('#sede_form').get(0).reset();
//     // $('#sede_id').val('0');
//     $('#modalnuevacategoria').modal('show');
 
     
//     // $.ajax({url:'/sede/sedec/selectmuni'}).done(function(data){
//     //     // data = JSON.parse(data);
//     //     //  console.log(data.pais);
//     //     //  $municipio = data.municipio;
        
//     //     //$('#id_municipio').html(data.municipio);
//     //      //$('#id_pais').html(data.$municipio);
//     //     // $('#nombre').val(data[0].nombre);
//     //     // $('#sede_id').val(data[0].id_cedecentral);
         
//     //     // console.log(data);
//     //  });


// });
  </script>
  @endsection