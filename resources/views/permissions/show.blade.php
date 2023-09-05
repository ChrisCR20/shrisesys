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
                    <li class="breadcrumb-item"><a href="#">Permiso</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header" style="background-color:#566e90">
                <h3 style="color:white">Detalles de  Permiso</h3>
                @can('role-create')
                <span class="float-right">
                    <a  class=" btn  btn-sm btn-light" title="Retornar"  href="{{ route('permissions.index') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
                </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong>Nombre:</strong>
                    {{ $permission->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection