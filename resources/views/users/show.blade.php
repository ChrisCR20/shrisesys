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
                  <h1></h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

        <div class="card">

            <div class="card-header" style="background-color:#566e90">
                <h3 style="color:white">Detalles de  usuario</h3>
                @can('role-create')
                <span class="float-right">
                    <a  class=" btn  btn-sm btn-light" title="Retornar"  href="{{ route('users.index') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
                </span>
              </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong>Nombre:</strong>
                    {{ $user->name }}
                </div>
                <div class="lead">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
                <div class="lead">
                    <strong>Contraseña:</strong>
                    ********
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function () {
        window.location.hash="#";
window.location.hash="#";//esta linea es necesaria para chrome
window.onhashchange=function(){window.location.hash="#";}
    })
</script>
@endsection