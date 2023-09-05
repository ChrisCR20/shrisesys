@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<div class="container">
  <div class="justify-content-center">
      @if (\Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
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
                <li class="breadcrumb-item"><a href="#">Caja</a></li>
                <li class="breadcrumb-item active">Cierre</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  </div>
  <form method="post" id="form_cierrec">

    <div class="card">
      <div class="card-header" style="background-color:  #a06c5f ">
        <h3 style="color:white">Cierre de caja</h3>
        <span class="float-right">
          <a class="btn btn-light btn-sm" href="/"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
        </span>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                  <label>Usuario que Cierra</label>
                  <input type="text" class="form-control" id="nombreempleado" name="nombreempleado" value="{{$empleadologueado[0]->nombre}}" readonly required>
                  <input type="hidden" class="form-control" id="idempleado" name="idempleado" value="{{$empleadologueado[0]->id_empleado}}"  readonly required>
                  <input type="hidden" class="form-control" id="estado" name="estado" value="{{$estado[0]}}"  readonly required>
                  <input type="hidden" class="form-control" id="id_caja" name="id_caja" value="{{$caja[0]->id_caja}}"  readonly required>
                  
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha</label>
                  <input type="text" class="form-control" id="fechacierre" name="fechacierre"  value="{{date('Y-m-d')}}" readonly required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Monto de apertura</label>
                  <input type="text" class="form-control decimales" id="montoapertura" name="montoapertura" value="{{$caja[0]->montoinicial}}" readonly required>

                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Monto de Cierre</label>
                  <input type="text" class="form-control decimales" id="montocierre" name="montocierre" placeholder="Monto" required>

                </div>
              </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success float-right">Cerrar caja</button>
      </div>
    </div>
    <!-- /.card -->
</form>
  
</div>
@endsection
@section('js')
<script src="{{ asset('js/Caja/caja.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

  </script>
  @endsection