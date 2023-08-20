@extends('adminlte::page')
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
        <h1>Crear empresa</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Empresa</a></li>
          <li class="breadcrumb-item active">Crear Empresa</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->



  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-info">
          <div class="card-header">
            
          </div>
          <!-- /.card-header -->
          <!-- form start -->
            <div class="card-body">
              {!! Form::open(array('route' => 'empresa.store','method'=>'POST')) !!}
              <div class="form-group">
                <label >Nombre</label>
                  {!! Form::text('nombre_empresa', null, array('placeholder' => 'Nombre de la empresa','class' => 'form-control','required')) !!}
              </div>
              <div class="form-group">
                <label >Descripcion</label>
                  {!! Form::textarea('descripcion', null, array('placeholder' => 'Escribir una descripcion de la empresa','class' => 'form-control')) !!}
              </div>

              <button type="submit" class="btn btn-success">Guardar</button>
          {!! Form::close() !!}
         



            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              {{-- <button type="submit" class="btn btn-success">Enviar</button> --}}
            </div>
          </form>
        </div>
        <!-- /.card -->
        </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">

      </div>
      
      
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection