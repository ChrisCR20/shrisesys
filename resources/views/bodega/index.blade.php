@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<div class="container">
  <div class="justify-content-center">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Salidas de bodega</a></li>
                <li class="breadcrumb-item active">Listado</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header" style="background-color: #4682B4">
          <h3 style="color: white">Salidas</h3>
            <span class="float-right">
                <a class="btn btn-light btn-sm" href="{{ route('home') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
            </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablacliente">
                  <thead class="thead-light">
                    <tr>
                      <th>No. Pedido</th>
                      <th>Cliente</th>
                      <th>Fecha</th>
                      <th width=""></th>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('js/Bodega/notas.js') }}"></script>
<script>
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
  </script>
  @endsection