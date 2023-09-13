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
                    <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
                    <li class="breadcrumb-item active">Listado</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

        <div class="card">
            <div class="card-header" style="background-color: #4682B4">
                <h3 style="color: white">Usuarios</h3>
                <span class="float-right" >
                    <a class="btn btn-sm btn-light"  title="Agregar" href="{{ route('users.create') }}"><div><i  style="color: gray" class="fa fa-plus"></i></div></a>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table" id="tablausuarios">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Roles</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $val)
                                            <label class="badge badge-dark">{{ $val }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a class="btn  btn-md" style="color:#123D6C" title="Ver detalles"  href="{{ route('users.show',$user->id) }}"><div><i class="fa fa-eye "></i></div></a>
                                    @can('user-edit')
                                        <a class="btn  btn-md" style="color:#C8A60A" title="Editar"  href="{{ route('users.edit',$user->id) }}"><div><i class="fa fa-edit "></i></div></a>
                                    @endcan
                                    @can('user-delete')
                                    <a  onClick="eliminar({{$user->id}});" class="edit btn  btn-md" style="color:#C8401E"  title="Dar de baja" >
                                        <div>
                                            <i class="fas fa-retweet ">
                                            </i>
                                        </div>
                                    </a>
                                        {{-- {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!} --}}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
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

        var t=   $("#tablausuarios").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function eliminar($id)
    {
        window.location.href='users/delete/'+$id;
    }
  </script>
  @endsection