@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<div class="container">
  <div class="justify-content-center">
      @if (\Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ \Session::get('success') }}</p>
          </div>
      @endif
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Clientes</a></li>
                <li class="breadcrumb-item active">Listado</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      @include('cliente/modalcreate')
      @include('cliente/modaledit')
      <div class="card">
        <div class="card-header" style="background-color: #4682B4">
          <h3 style="color: white">Clientes</h3>
            <span class="float-right">
              <a class="btn btn-sm btn-light"  title="Agregar" id="btnnuevocliente"><div><i  style="color: gray" class="fa fa-plus"></i></div></a>
            </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablacliente">
                  <thead class="thead-light">
                    <tr>
                      <th>Nit</th>
                      <th>Nombre</th>
                      <th>Telefono</th>
                      <th>Direccion</th>
                      <th width=""></th>
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
<script src="{{ asset('js/Cliente/cliente_v.js') }}"></script>
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