@extends('adminlte::page')
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
                    <li class="breadcrumb-item"><a href="#">Rol</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
        <div class="card">
            <div class="card-header" style="background-color:#566e90">
                <h3 style="color:white">Detalles de  Rol</h3>
                @can('role-create')
                <span class="float-right">
                    <a  class=" btn  btn-sm btn-light" title="Retornar"  href="{{ route('roles.index') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
                </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong>Nombre:</strong>
                    {{ $role->name }}
                </div>
                <div class="lead">
                    <strong>Permisos:</strong>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $permission)
                            <label class="badge badge-success">{{ $permission->name }}</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection