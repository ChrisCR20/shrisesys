@extends('adminlte::page')
@section('plugins.Select2', true)
@include('venta/modalventa')
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


    <div class="card card-default">

      <div class="card-header">
          <h2 class="">Nueva Venta</h2>
      </div>
      <!-- /.card-header -->

      {{-- {!! Form::open(array('route'=>'venta.ingreso','method'=>'POST','id'=>'venta_form')) !!}
  --}}
      <form enctype="multipart/form-data"  id="venta_form" tabindex="-1">
        {{ csrf_field() }}
     
      <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <label class="form-label" for="sigla">Nit</label>
                <input type="text" class="form-control" id="nitventa" name="nitventa" placeholder="Serie" disabled="disabled" required>
                <input type="hidden" class="form-control" id="id_cliente" name="id_cliente"  >
              </div>
              <div class="col-md-5">
                <label class="form-label" for="sigla">Cliente</label>
                <input type="text" class="form-control" id="nombreventa" name="nombreventa" placeholder="Serie" disabled="disabled" required>
              </div>

                <div class="col-md-2">
                  <label class="form-label" for="sigla">Fecha de factura </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input  data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask id="fechafactc" name="fechafactc" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-8">
                    <label class="form-label" for="sigla">Tipo de pago </label>
                    <select class="form-control select2" id="id_tpago" name="id_tpago" style="width: 100%;">
                      @if (isset($tipopago))
                      @foreach($tipopago as $tp)
                          <option value="{{$tp->id_tipopago}}" selected="">{{$tp->nombretipo}}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label class="form-label" for="sigla">Sucursal </label>
                    <input type="text" class="form-control" id="id_sucursal" name="id_sucursal" placeholder="id_sucursal" required>
                  </div>
                  <div class="col-md-2">
                    <label class="form-label" for="sigla">Vendedor </label>
                    <input type="text" class="form-control" id="numerodoctoc" name="numerodoctoc" placeholder="Numero documento" required>
                  </div>






        <!-- /.row -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<div class="card card-default">
  <div class="card-header">

  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-2">
        <label for="exampleInputPassword1">cantidad</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Nombre" >
      </div>
      <div class="col-lg-8">
        <label for="exampleInputPassword1">Producto</label>
        <select class="form-control select2" id="id_producto" name="id_producto" style="width: 100%;">
          @if (isset($producto))
          @foreach($producto as $per)
              <option value="{{$per->id_producto}}" selected="">{{$per->nombreproducto}}</option>
          @endforeach
          @endif
        </select>

      </div>
      <div class="col-lg-2">

          <a type="button" id="btnadditem" class="btn btn-primary">Agregar item</a>

      </div>

    </div>



    <div><h3> </h3></div>
    <div class="col-lg-12 col-md-12 col-sm-12">
      <table id="tblacademico" class="table table-striped table-bordered">
      <thead>
          <tr>
              <th scope="col">#</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Producto</th>
              <th scope="col">Subtotal</th>
          </tr>
      </thead>
      <tbody id="dattable" name="dattable">
      </tbody>
      </table>
  </div>
  </div>

  <div class="card-footer">
    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
    <button type="button" id="btnventa" class="btn btn-success">Registrar</button>
  </div>
</div>

</form>
{{-- {!! Form::close() !!} --}}


@endsection
@section('js')
<script src="{{ asset('js/Cliente/cliente_venta.js') }}"></script>
{{-- <script src="{{ asset('js/Venta/venta_v.js') }}"></script> --}}
<script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
<script>
   $('#btnadditem').click(function() {
      agregarest();
  });
  $(":input").inputmask();

  // function getpersona() {
  //   nit= $('#identificacion').val();
  //   $.ajax({url:'/venta/obtener/nit/'+nit}).done(function(data){
  //     console.log(data);
  //     $('#nombrecliente').val(data["nombrecliente"]);
  //     $('#id_cliente').val(data["id_cliente"]);

  //   });
  //     }



  </script>
  @endsection