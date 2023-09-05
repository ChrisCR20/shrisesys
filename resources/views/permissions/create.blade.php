@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                    <li class="breadcrumb-item active">Nuevo</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section> 
        
          <div class="card">
            <div class="card-header" style="background-color:  #5F9EA0 ">
                <h3 style="color:white">Nuevo Permiso</h3>
                <span class="float-right">
                    <a class="btn btn-light btn-sm" href="{{ route('permissions.index') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
                    <div class="form-group">
                        <label>Nombre del permiso</label>
                        {!! Form::text('name', null, array('placeholder' => 'Nombre del permiso','class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection