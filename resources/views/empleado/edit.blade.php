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

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
   
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Empleado</a></li>
          <li class="breadcrumb-item active">Editar</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

  {!! Form::model($data[0], ['route' => ['empleado.update', $data[0]->id_persona], 'method'=>'PATCH']) !!}

    <div class="card">
      <div class="card-header" style="background-color: #f3bb53">
          <h3 >Editar Empleado</h3>
          <span class="float-right">
            <a class="btn btn-light btn-sm" href="{{ route('empleado.index') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
        </span>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label>Identificacion</label>
                {!! Form::text('codunicoid', null, array('placeholder' => 'Identificacion','class' => 'form-control','required')) !!}
              </div>
              <input type="hidden" class="form-control" id="id_sucursale" name="id_sucursale" value="{{$data[0]->id_sucursal}}" >
            </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Primer Nombre</label>
              {!! Form::text('primer_nombre', null, array('placeholder' => 'primer nombre','class' => 'form-control','required')) !!}
            </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Segundo Nombre</label>
                {!! Form::text('segundo_nombre', null, array('placeholder' => 'Identificacion','class' => 'form-control')) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Tercer Nombre</label>
                {!! Form::text('tercer_nombre', null, array('placeholder' => 'Identificacion','class' => 'form-control')) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Primer Apellido</label>
                {!! Form::text('primer_apellido', null, array('placeholder' => 'Identificacion','class' => 'form-control','required')) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Segundo Apellido</label>
                {!! Form::text('segundo_apellido', null, array('placeholder' => 'Identificacion','class' => 'form-control')) !!}
              </div>
            </div>

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="card card-default">

      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>Telefono</label>
                {!! Form::text('tel_corporativo', null, array('placeholder' => 'Identificacion','class' => 'form-control','required')) !!}
              </div>
            </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputPassword1">Sucursal</label>
              <select class="form-control select2" id="id_sucursal" name="id_sucursal"  style="width: 100%;">
                @foreach( $sucursal as $key => $value )
                  <option selected="selected" value="{{ $key }}">{{ $value }}</option>
                @endforeach
              </select>
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

if ($('#id_sucursal').find("option[value='" + $('#id_sucursale').val() + "']").length)
            {$('#id_sucursal').select2().val($('#id_sucursale').val()).trigger('change'); }
  </script>
  @endsection