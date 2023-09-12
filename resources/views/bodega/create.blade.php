@extends('adminlte::page')
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
</br>
<div class="container-fluid">
    <div class="row">

      <!-- /.col -->
      <div class="col-md-12">
        <div class="card card-outline  " >
          <div class="card-header" style="background-color:  #5F9EA0">
            <h3 style="color: white" class="card-title">Egreso de bodega</h3>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <label for="exampleInputPassword1">Cliente</label>
                    <select class="form-control select2" id="id_cliente" name="id_cliente" style="width: 100%;">
                        @if (isset($Cliente))
                        @foreach($Cliente as $cliente)
                            <option value={{$cliente->id_cliente}} selected="">{{$cliente->nombrecliente}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
          <div class="col-md-3">
              <label class="form-label" for="sigla">Fecha de factura </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text"name="fechafactv" id="fechafactv" class="form-control"  value="{{ \Carbon\Carbon::parse(now()->toDateTime())->setTimezone('America/Guatemala')->format('Y-m-d') }}" disabled>
                  <input type="hidden" class="form-control" id="id_tipopago" value="1">
              </div>
          </div>
        </div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="card card-default card-outline">
          <div class="card-header">
            <h3 class="card-title">Buscar producto</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div  clas="row">
                <div >
                <form>
                <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Serie"  oninput="load_home()">
            </form>
                </div>

            </div>
            <br>
            <div class="row" id="contento">



             


          </div>
          <!-- /.card-body -->
          <div class="card-footer">

          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>

    <div class="col-md-5">
      <form method="post" id="venta_form">
      <div class="card card-default card-outline">
        <div class="card-header">
            <h3 class="card-title">Detalle</h3>
        </div>
        <div class="card-body ">
          <div class="row">
            <div class="row" >
              <div class="col-md-12" >
                  <label class="form-label" for="sigla">Total de productos</label>
                  {{-- <textarea type="text" class="form-control" id="nitventa" name="nitventa" placeholder="Serie" disabled="disabled" required></textarea> --}}
                  <h1  id="sumasub">0</h1>
                  
              </div>
            </div>
            <div class="card-body table-responsive" style="height:260px;">
              <table id="tblacademico" class="table table-head-fixed text-nowrap responsive">
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="30%">Cantidad</th>
                        <th scope="col" width="60%">Producto</th>
                    </tr>
                </thead>
                <tbody id="dattable" name="dattable">
                </tbody>
              </table>
            </div>
        </div>
        </div>
        <div class="card-footer">
          {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
          <button type="submit" id="btnventa" class="btn btn-success">Finalizar pedido</button>
          <button type="button" id="btncancelar" class="btn btn-danger">Cancelar</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <!-- /.card -->
    </form>
    </div>

    <!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection
  @section('js')
  <script src="{{ asset('js/Bodega/notas.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
     $('.select2').select2()
      
  $('#btncancelar').click(function() {

Swal.fire({
            title: 'Cancelar Pedido',
            text: "Esta seguro de cancelar el pedido",
            type: 'question',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
          }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Cancelado',
                    'El pedido cancelado',
                    'error'
                  ).then((result) => {
                    if (result.value) {
                        $('#busqueda').val("");
                         window.location.reload();
                    }
                  })
                  
            }
          })
});

$('#buscar').click(function() {
    load_home();
  });
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    function load_home() {
        console.log('contar');
        dato= $('#busqueda').val();
        if(dato==""||dato==" ")
        {
            dato='null'
        }
    $.ajax({url:'/bodega/card/'+dato}).done(function(data){
        res=Object.entries(data).length

      if(res==0)
      {toastr.info('Complete informacion y click en "Continuar"', 'Nit no registrado',{timeOut: 5000})}
      else{   

      $('#contento').html(data);
    
    }
      


    });
    
}

  </script>
  @endsection