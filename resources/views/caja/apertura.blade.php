@extends('adminlte::page')
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
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
          <li class="breadcrumb-item"><a href="#">Caja</a></li>
          <li class="breadcrumb-item active">Apertura</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<form method="post" id="form_aperturac">

    <div class="card">
      <div class="card-header" style="background-color:  #5F9EA0 ">
        <h3 style="color:white">Apertura de caja</h3>
        <span class="float-right">
          <a class="btn btn-light btn-sm" href="/"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
        </span>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                  <label>Usuario que apertura</label>
                  <input type="text" class="form-control" id="nombreempleado" name="nombreempleado" value="{{$empleadologueado[0]->nombre}}" readonly required>
                  <input type="hidden" class="form-control" id="idempleado" name="idempleado" value="{{$empleadologueado[0]->id_empleado}}"  readonly required>
                  <input type="hidden" class="form-control" id="estado" name="estado" value="{{$estado[0]}}"  readonly required>
                  <input type="hidden" class="form-control" id="id_sucursal" name="id_sucursal" value="{{$sucursalemp[0]->id_sucursal}}"  readonly required>
                  
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha</label>
                  <input type="text" class="form-control" id="fecha" name="fecha" placeholder="Fecha" value="{{date('Y-m-d')}}" readonly required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Monto de apertura</label>
                  <input type="text" class="form-control decimales" id="monto" name="monto" placeholder="Monto" required>

                </div>
              </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success float-right">Aperturar caja</button>
      </div>
    </div>
    <!-- /.card -->
</form>
@endsection
@section('js')
<script src="{{ asset('js/Caja/caja.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$('.decimales').on('input', function () {
  this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
});
  </script>
  @endsection