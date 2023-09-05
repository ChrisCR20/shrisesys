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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Empleados</a></li>
                <li class="breadcrumb-item active">Listado</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header" style="background-color: #4682B4">
          <h3 style="color: white">Empleados</h3>
              <span class="float-right">
                  <a class="btn btn-sm btn-light"  title="Agregar" href="{{ route('empleado.create') }}"><div><i  style="color: gray" class="fa fa-plus"></i></div></a>
              </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablasucursal">
                  <thead class="thead-light">
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Sucursal</th>
                      <th width="10%"></th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($etapas as $key => $empleado)
                    <tr>
                        <td>{{ $empleado['id_persona'] }}</td>
                        <td>{{ $empleado['nombre'] }}</td>
                        <td>{{ $empleado['codunicoid'] }}</td>
                        <td>{{ $empleado['nombresucursal'] }}</td>
                      
                        <td>
                            @can('user-edit')
                            <a class="btn btn-md" style="color:#C8A60A" href="{{ route('empleado.edit',$empleado['id_persona']) }}">
                              <div><i class="fa fa-edit "></i></div>
                          </a>
                                {{-- <a class="btn btn-primary" href="{{ route('empleado.edit',$empleado['id_persona']) }}"><div><i class="fa fa-edit "></i></div></a> --}}
                            @endcan
                            {{-- @can('user-delete')
                            <a class="btn btn-warning btn-sm" onClick="eliminar({{$empleado['id_persona']}});">
                              <i class="fas fa-trash">
                              </i>
                          </a>
                            @endcan --}}
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