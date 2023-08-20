@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<div class="container">
  @include('compra/modalcreate')
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
                <li class="breadcrumb-item"><a href="#">Compras</a></li>
                <li class="breadcrumb-item active">Listado</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        

        <div class="card-header" style="background-color: #4682B4">
          <h3 style="color: white">Compras</h3>
          <span class="float-right">
            <a class="btn btn-sm btn-light"  title="Agregar" id="btnnuevacompra"><div><i  style="color: gray" class="fa fa-plus"></i></div></a>
          </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablacompras">
                  <thead class="thead-light">
                    <tr>
                      <th>Factura</th>
                      <th>Fecha Factura</th>
                      <th>Proveedor</th>
                      <th>Total</th>
                      <th width=""></th>
                  </tr>
                  </thead>
              </table>
            </div>
              {{-- {{ $etapas->render() }} --}}
          </div>
      </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/Compra/compra_c.js') }}"></script>
<script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#btnadditem').click(function() {
                agregarest();
            });
            $("#tpmodalidad").change(event => {
                var valormodalidad = $("#tpmodalidad").val();
                var textomodalidad = $("#tpmodalidad option:selected").text();
                if( textomodalidad == "Residencial")
                {
                    $("#divoculto").show();
                }
                else{
                    $("#divoculto").hide();
                }
            });
        });
  </script>
    <script>
      $(":input").inputmask();

  </script>
  @endsection