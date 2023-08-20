@extends('adminlte::page')
@section('plugins.Select2', true)

@section('content')
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

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Nuevo Cliente</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Cliente</a></li>
          <li class="breadcrumb-item active">Crear cliente</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->

  {!! Form::open(array('route' => 'clientes.store','method'=>'POST')) !!}

    <div class="card card-info">
      <div class="card-header">
          <h3 class="card-title">Datos generales</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label>Nit</label>
                {!! Form::text('nitcliente', null, array('placeholder' => 'Nit','class' => 'form-control','required')) !!}
              </div>
            </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Nombre completo</label>
              {!! Form::text('nombrecliente', null, array('placeholder' => 'nombre completo','class' => 'form-control','required')) !!}
            </div>
          </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Correo</label>
                {!! Form::email('emailcliente', null, array('placeholder' => 'email','class' => 'form-control','required')) !!}
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label>Telefono</label>
                  {!! Form::text('telefonocliente', null, array('placeholder' => 'telefono','class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Direccion</label>
                  {!! Form::text('direccioncliente', null, array('placeholder' => 'direccion ','class' => 'form-control','required')) !!}
                </div>
              </div>

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success float-right">Guardar</button>
      </div>
    </div>

    {!! Form::close() !!}

@endsection
@section('js')
<script>
$(function () {
    //Initialize Select2 Elements   
    $('.select2').select2();
});
  </script>
  @endsection