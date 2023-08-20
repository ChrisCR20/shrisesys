@extends('adminlte::page')
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
@include('venta/modalventa')
<form method="post" id="venta_form">
<div class="row">
    <h1></h1>
</div>
<div class="row">
<div class="col-md-10">
    <div class="card">
        <div class="card-header" style="background-color:  #5F9EA0 ">
        </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="sigla">Nit</label>
                        <input type="text" class="form-control" id="nitventa" name="nitventa" placeholder="Serie" disabled="disabled" required>
                        <input type="hidden" class="form-control" id="id_cliente" name="id_cliente">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="sigla">Cliente</label>
                        <input type="text" class="form-control" id="nombreventa" name="nombreventa" placeholder="Serie" disabled="disabled" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="sigla">Fecha de factura </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text"name="fechafactv" id="fechafactv" class="form-control"  value="{{ date('Y-m-d') }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="exampleInputPassword1">Tipo de pago</label>
                        <select class="form-control select2" id="id_tipopago" name="id_tipopago" style="width: 100%;">
                            @if (isset($tipopago))
                            @foreach($tipopago as $per)
                                <option value="{{$per->id_tipopago}}" selected="">{{$per->nombretipo}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="col-md-2">
    <div class="card">
        <div class="card-header" style="background-color:  #5F9EA0 ">
        </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" style="height: 140px;">
                        <label class="form-label" for="sigla">Subtotal</label>
                        {{-- <textarea type="text" class="form-control" id="nitventa" name="nitventa" placeholder="Serie" disabled="disabled" required></textarea> --}}
                        <h1  id="sumasub">Q 0.00</h1>
                        
                    </div>
                </div>
            </div>
    </div>
</div>
</div>
{{-- inicio de la tabla dinamica --}}
<div class="card card-default">
    <div class="card-header">
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="exampleInputPassword1">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Nombre" >
                </div>
                <div class="col-md-6">
                    <label for="exampleInputPassword1">Producto</label>
                    <select class="form-control select2" id="id_producto" name="id_producto" style="width: 100%;">
                        @if (isset($producto))
                        @foreach($producto as $per)
                            <option value="{{$per->id_producto}}" selected="">{{$per->nombreproducto}}</option>
                        @endforeach
                        @endif
                    </select>

                </div>
                <div class="col-md-2">
                    <label for="exampleInputPassword1"></label>
                    <div class="form-group">
                    
                        <a class="btn btn-lg btn-block  btn-primary"  title="Agregar" id="btnadditem"><div><i   class="fa fa-plus"></i></div></a>
                        {{-- <button type="button" id="btnadditem" class="btn btn-primary">Agregar</button> --}}
                 </div> 

                </div>
            </div>
                <div class="col-md-12">
                    <h1>   </h1>
                </div>
                    <div class="col-md-12">
                      <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height:180px;">
                          <table id="tblacademico" class="table table-head-fixed text-nowrap responsive">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col" width="25%">Cantidad</th>
                                    <th scope="col" width="60%">Producto</th>
                                    <th scope="col" width="10%">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="dattable" name="dattable">
                            </tbody>
                          </table>
                        </div>
                {{-- <div class="card-body table-responsive p-0">
                    <table id="tblacademico" class="table table-head-fixed text-nowrap" >
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
                </div> --}}
            </div>
            <div class="card-footer">
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                <button type="submit" id="btnventa" class="btn btn-success">Finalizar Venta</button>
                <button type="button" id="btncancelar" class="btn btn-danger">Cancelar Venta</button>
              </div>
        </div>
</form>

@endsection
@section('js')
{{-- <script src="{{ asset('js/Cliente/cliente_venta.js') }}"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('js/Venta/venta2.js') }}"></script>
<script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
<script>
   $('#btnadditem').click(function() {
      agregarest();
  });

  $('#btncancelar').click(function() {

    Swal.fire({
                title: 'Cancelar Venta',
                text: "Esta seguro de cancelar la venta",
                type: 'question',
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
              }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Cancelada',
                        'La venta fue cancelada',
                        'error'
                      ).then((result) => {
                        if (result.value) {

                            $('#venta_form')[0].reset();
                            $('#cliente_form')[0].reset();
                             window.location.reload();
                        }
                      })
                      
                }
              })
  });
  $(":input").inputmask();

  function getpersona() {
    nit= $('#identificacion').val();
    $.ajax({url:'/venta/obtener/nit/'+nit}).done(function(data){
        res=Object.entries(data).length

      if(res==0)
      {toastr.info('Complete informacion y click en "Continuar"', 'Nit no registrado',{timeOut: 5000})}
      else{      $('#nombrecliente').val(data["nombrecliente"]);
      $('#id_cliente').val(data["id_cliente"]);
    
    }
      


    });
    $('#nitventa').val("");
    $('#nombreventa').val("");
    $('#id_cliente').val("");
      }




  </script>
  @endsection