@extends('adminlte::page')
@section('plugins.Datatables', true)
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
                <li class="breadcrumb-item"><a href="#">Productos</a></li>
                <li class="breadcrumb-item active">Listado</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card">
        <div class="card-header" style="background-color: #4682B4">
          <h3 style="color: white">Productos</h3>
              <span class="float-right" >
                <a class="btn btn-sm btn-light"  title="Agregar" href="{{ route('producto.create') }}"><div><i  style="color: gray" class="fa fa-plus"></i></div></a>
              </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tablaproducto">
                  <thead class="thead-light">
                    <tr>
                      <th>Codigo interno</th>
                      <th>Nombre de producto</th>
                      <th>Cantidad</th>
                      <th>Categoria</th>
                      <th>Marca </th>
                      <th>Medida</th>
                      <th width=""></th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach ($etapas as $key => $producto)
                    <tr>
                        <td>{{ $producto['codigoproducto'] }}</td>
                        <td>{{ $producto['nombreproducto'] }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>{{ $producto['nombrecategoria'] }}</td>
                        <td>{{ $producto['nombremarca'] }}</td>
                        <td>{{ $producto['nombremedida'] }}</td>
                        <td>
                             @can('user-edit')
                              {{-- <a class="btn  btn-md" style="color:#" title="Editar" href="{{ route('producto.edit',$producto['codigoproducto'] ) }}"><div><i class="fa fa-edit "></i></div></a>
                                --}}
                            <a class="btn  btn-md" style="color:#C8A60A" title="Editar"  href="{{ route('producto.edit',$producto['id_producto']) }}"><div><i class="fa fa-edit "></i></div></a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach 
                  </tbody>
              </table>
            </div>
              {{-- {{ $etapas->render() }} --}}
          </div>
      </div>
  </div>
</div>
@endsection
@section('js')
<script>
    $.ajaxSetup({
    headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
});
    $(function () {

   var t=   $("#tablaproducto").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, "paging": true, "pageLength": 5,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
          }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function eliminar($id)
    {
      
    }

  </script>
  @endsection