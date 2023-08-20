@extends('adminlte::page')
<!-- implementa la vista de adminlte -->

@section('title', 'Home')
<!--agregamos un titulo -->

@section('content_header')
   <!-- <h1>Colocacion</h1> -->
@stop
<!--Agregamos un header a nuestra pagina -->
  <!-- JQVMap -->
  {{-- <link rel="stylesheet" href="../../vendor/plugins/jqvmap/jqvmap.min.css"> --}}
@section('content')
   <!-- <p>Informe de colocacion por etapa</p>-->


<div class="row">

  <div class="col-lg-8">
    <div class="col-lg-12 col-12">
      <div class="small-box">
        <div class="inner">
   <canvas id="myChart" width="400" height="150" ></canvas>
        </div>
      </div>
    </div>
    <div height="150"><h1></h1></div>
    <div class="col-lg-12 col-12">
      <div class="small-box">
        <div class="inner">
      <canvas id="myChart2" width="400" height="150"></canvas>
        </div>
      </div>
       </div>
  </div>
  <div class="col-lg-4">
    <!-- ./col -->
    <div class="col-lg-12 col-12">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $ventas[0]->ventas }}</h3>

          <p>Ventas</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-12 col-12">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $compras[0]->compras }}</h3>

          <p>Compras</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="/indexcompras" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-12 col-12">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $productos[0]->productos }}</h3>

          <p>Productos</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="/producto" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-12 col-12">
      <!-- small box -->
      <div class="small-box bg-secondary">
        <div class="inner">
          <h3>{{ $clientes[0]->clientes }}</h3>

          <p>Clientes</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="/indexcliente" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  
</div>
@stop

<!--Contenido de nuestra pagina-->

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

<!--agregamos css-->

@section('js')
    <script> console.log('Hi!'); </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


{{-- 
<script src="{{asset('plugins/flot/jquery.flot.js')}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{asset('plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{asset('plugins/flot/plugins/jquery.flot.pie.js')}}"></script> --}}

{{-- <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../vendor/jszip/jszip.min.js"></script>
<script src="../../vendor/pdfmake/pdfmake.min.js"></script>
<script src="../../vendor/pdfmake/vfs_fonts.js"></script>
<script src="../../vendor/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../vendor/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../vendor/datatables-buttons/js/buttons.colVis.min.js"></script> --}}


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
  document.addEventListener("keydown", function(event) {
    if ( event.code === "KeyV")
    {
        window.location.href='ventacrear'
        event.preventDefault();
    }
    if ( event.code === "KeyC")
    {
        window.location.href='/indexcompras'
        event.preventDefault();
    }
    if ( event.code === "KeyP")
    {
        window.location.href='/producto'
        event.preventDefault();
    }
  
});
</script>
<script>
var meses;
$(document).ready(function(){

    $.ajax({url:'/home/obtenertoppr'}).done(function(data){
        res=Object.entries(data).length

       console.log(data);
       const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
           // labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            labels: data.map(function(data1){return data1.nombreproducto}),
            datasets: [{
                label: 'Ventas por producto',
                data:data.map(function(data1){return data1.cantidad}),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    });

    
    $.ajax({url:'/home/obtenerventa'}).done(function(data){
        res=Object.entries(data).length

        var tamaño = data.map(data2 => {
  if (data2.mes == 1){
    return "Enero";
  }
  if (data2.mes == 2){
    return "Febrero";
  }
  if (data2.mes == 3){
    return "Marzo";
  }
  if (data2.mes == 4){
    return "Abril";
  }
  if (data2.mes == 5){
    return "Mayo";
  }
  if (data2.mes == 6){
    return "Junio";
  }
  if (data2.mes == 7){
    return "Julio";
  }
  if (data2.mes == 8){
    return "Agosto";
  }
  if (data2.mes == 9){
    return "Septiembre";
  }
  if (data2.mes == 10){
    return "Octubre";
  }
  if (data2.mes == 11){
    return "Noviembre";
  }
  if (data2.mes == 12){
    return "Diciembre";
  }
   
   
  })

console.log(tamaño);

       console.log(data);
       const ctx = document.getElementById('myChart2').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
           // labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            labels: tamaño,
            datasets: [{
                label: 'Comportamiento de ventas',
                data:data.map(function(data1){return data1.venta}),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    });
      
    });

 // var meses=['Enero','Diciembre']


    // const ctx2 = document.getElementById('myChart2').getContext('2d');
    // const myChart2 = new Chart(ctx2, {
    //     type: 'line',
    //     data: {
    //         labels: ['Leche', 'Agua Gaseosa', 'Pañales', 'Gas', 'Fibra', 'Galleta'],
    //         datasets: [{
    //             label: 'Leche',
    //             data: [12, 19, 3, 5, 2, 3],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 8, 0.2)',
    //                 'rgba(75, 192, 0, 0.2)',
    //                 'rgba(153, 11, 255, 0.2)',
    //                 'rgba(255, 01, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });
  
    </script>
@stop

<!--agregamos Java Script -->
