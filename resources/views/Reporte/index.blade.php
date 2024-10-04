@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
{{-- @section('plugins.DateRange', true) --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Reportes</a></li>
            <li class="breadcrumb-item active">opciones</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  @include('Reporte/inventario/modalventasrp')
  @include('Reporte/inventario/modalpresentacion')
  @include('Reporte/inventario/modalpresentacionconexis')
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
            <div class="card-header" style="background-color: #4682B4">
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3></br></h3>
        
                        <p>Existencia de productos</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                      <a id="btnrepproddown" class="btn small-box-footer">
                        Generar reporte <i class="fas fa-arrow-circle-right"></i>
                      </a>
                      {{-- <span class="small-box-footer" >
                        <a class="btn small-box-footer"  id="btnrepventas">Generar <i  class="fas fa-arrow-circle-right"></i></a>
                      </span> --}}
                        {{-- <span >
                          <a id="btnrepventas" >
                        <div>Ver <i class="fas fa-arrow-circle-right"></i></div>
                      </a>
                        </span> --}}
                   
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                  <!-- small card -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3></br></h3>
      
                      <p>Productos con baja existencia</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-chart-bar"></i>
                    </div>
                    <a id="btnrepbajaexis" class="btn small-box-footer">
                      Generar reporte <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    {{-- <span class="small-box-footer" >
                      <a class="btn small-box-footer"  id="btnrepventas">Generar <i  class="fas fa-arrow-circle-right"></i></a>
                    </span> --}}
                      {{-- <span >
                        <a id="btnrepventas" >
                      <div>Ver <i class="fas fa-arrow-circle-right"></i></div>
                    </a>
                      </span> --}}
                 
                  </div>
              </div>
              <div class="col-lg-4 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3></br></h3>
    
                    <p>Productos con existencia</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                  </div>
                  <a id="btnprconexis" class="btn small-box-footer">
                    Generar reporte <i class="fas fa-arrow-circle-right"></i>
                  </a>
                  {{-- <span class="small-box-footer" >
                    <a class="btn small-box-footer"  id="btnrepventas">Generar <i  class="fas fa-arrow-circle-right"></i></a>
                  </span> --}}
                    {{-- <span >
                      <a id="btnrepventas" >
                    <div>Ver <i class="fas fa-arrow-circle-right"></i></div>
                  </a>
                    </span> --}}
               
                </div>
            </div>
              @can('repventas')
                <div class="col-lg-4 col-6">
                    <!-- small card -->
                    <div class="small-box" style="background-color: #4682B4">
                      <div class="inner">
                        <h3></br></h3>
        
                        <p>Reporte de Ventas</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                      </div>
                      <a id="btnrepventas" class="btn small-box-footer">
                        Generar reporte  <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3></br></h3>
        
                        <p>Los 15 mas vendidos</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-credit-card"></i>
                      </div>
                      <a id="btnrepmasvendidos"  class="small-box-footer">
                        Generar reporte <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                  @endcan
        </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
@endsection
@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('js/Reporte/reporte.js') }}"></script>
<script>
$(function() {
//   $('input[name="reservationdate"]').daterangepicker({
//     singleDatePicker: true,
//     showDropdowns: true,
//     minYear: 1901,
//     maxYear: parseInt(moment().format('DD-MM-YYYY'),10),
//     locale: {
//         format: 'DD-MM-YYYY'
// }
//   }, function(start, end, label) {
    
//   }); 
jQuery.noConflict();
moment.locale('es');
$('input[name="f_iniciorep"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY') + 1,10) ,
    locale: {
        format: 'YYYY-MM-DD',
        daysOfWeek: [
        "Dom",
        "Lun",
        "Mar",
        "Mier",
        "Jue",
        "Vier",
        "Sáb"
    ],
    monthNames: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ]
    }
  }, function(start, end, label) {

  });



$('input[name="f_finalrep"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY') + 1,10),
    locale: {
        format: 'YYYY-MM-DD',
        daysOfWeek: [
        "Dom",
        "Lun",
        "Mar",
        "Mier",
        "Jue",
        "Vier",
        "Sáb"
    ],
    monthNames: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"]
  }}, function(start, end, label) {

  });

});
  </script>
@endsection
