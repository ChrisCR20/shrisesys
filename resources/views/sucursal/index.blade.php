@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
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
                <li class="breadcrumb-item"><a href="#">Sucursal</a></li>
                <li class="breadcrumb-item active">Listado</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      @include('sucursal/modalcreate')
      @include('sucursal/modaledit')
      <div class="card">
        <div class="card-header" style="background-color: #4682B4">
          <h3 style="color: white">Sucursales</h3>
              <span class="float-right">
                <a class="btn btn-sm btn-light"  title="Agregar" id="btnnuevasucursal"><div><i  style="color: gray" class="fa fa-plus"></i></div></a>
              </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablasucursal">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Empresa Central</th>
                    <th width="10%"></th>
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
<script src="{{ asset('js/Sucursal/sucursal.js') }}"></script>
<script>


    function eliminar($id)
    {
      
    }
  </script>
  @endsection