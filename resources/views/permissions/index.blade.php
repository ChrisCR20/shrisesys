@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
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
                    <li class="breadcrumb-item"><a href="#">Permisos</a></li>
                    <li class="breadcrumb-item active">Listado</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
        <div class="card">
            <div class="card-header" style="background-color: #4682B4">
                <h3 style="color: white">Permisos</h3>
                @can('role-create')
                <span class="float-right" >
                    <a class="btn btn-sm btn-light"  title="Agregar" href="{{ route('permissions.create') }}"><div><i  style="color: gray" class="fa fa-plus"></i></div></a>
                </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover" id="tablapermisos">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th width="280px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a class="btn btn-md" style="color:#123D6C" title="Ver detalles" href="{{ route('permissions.show',$permission->id) }}"><div><i class="fa fa-eye "></i></div></a>
                                    @can('role-edit')
                                    <a class="btn  btn-md" style="color:#C8A60A" title="Editar"  href="{{ route('permissions.edit',$permission->id) }}"><div><i class="fa fa-edit "></i></div></a>
                                    @endcan
                                    @can('role-delete')
                                    <a  onClick="eliminar({{$permission->id}});" class="edit btn  btn-md" style="color:#C8401E"  title="Dar de baja" >
                                        <div>
                                            <i class="fas fa-retweet ">
                                            </i>
                                        </div>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
        {{-- {{ $data->render() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function () {

   var t=   $("#tablapermisos").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function eliminar($id)
    {
        window.location.href='permissions/delete/'+$id;
    }
  </script>
  @endsection