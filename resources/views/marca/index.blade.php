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
          <h1>Marcas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Marca</a></li>
            <li class="breadcrumb-item active">Inicio</li>
          </ol>
        </div>
      </div>
      <div class="card">
        @include('marca/modalcreate')
          <div class="card-header">
              <span class="float-left">
                  {{-- <a class="btn btn-primary" href="{{ route('categoria.create') }}"><div><i class="fa fa-plus-circle "></i></div></a> --}}
                  <button type="button" class="btn btn-info" id="btnnuevamarca"><div><i class="fa fa-plus-circle "></i></div></button>
              </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablamarca">
                  <thead class="thead-light">
                    <tr>
                      <th>Id</th>
                      <th>Nombre de Marca</th>
                      <th width="280px">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach ($etapas as $key => $marca)
                    <tr>
                        <td>{{ $marca['id_marca'] }}</td>
                        <td>{{ $marca['nombremarca'] }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('categoria.show',$marca['id_marca'] ) }}"><div><i class="fa fa-eye "></i></div></a>
                            @can('user-edit')
                                <a class="btn btn-primary" href="{{ route('categoria.edit',$marca['id_marca'] ) }}"><div><i class="fa fa-edit "></i></div></a>
                            @endcan
                        
                            <a class="btn btn-info" href="{{ route('categoria.show',$marca['id_marca'] ) }}"><div><i class="fa fa-list-alt "></i></div></a>
                        </td>
                    </tr>
                    @endforeach 
                  </tbody>
              </table>
            </div>
              {{-- {{ $etapas->render() }} --}}
          </div>
      </div>
  </div>
</div>
@endsection
@section('js')
<script>
    $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});
    $(function () {

   var t=   $("#tablamarca").DataTable({
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

    $(document).on("click","#btnnuevamarca",function(){
    // $('#modaltitle').html('Nuevo Registro');
    // $('#sede_form').get(0).reset();
    // $('#sede_id').val('0');
    $('#modalnuevamarca').modal('show');
 
     
    // $.ajax({url:'/sede/sedec/selectmuni'}).done(function(data){
    //     // data = JSON.parse(data);
    //     //  console.log(data.pais);
    //     //  $municipio = data.municipio;
        
    //     //$('#id_municipio').html(data.municipio);
    //      //$('#id_pais').html(data.$municipio);
    //     // $('#nombre').val(data[0].nombre);
    //     // $('#sede_id').val(data[0].id_cedecentral);
         
    //     // console.log(data);
    //  });


});
  </script>
  @endsection