@extends('adminlte::page')
@section('plugins.Select2', true)
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<div class="container">
  <div class="justify-content-center">
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
          <li class="breadcrumb-item"><a href="#">Producto</a></li>
          <li class="breadcrumb-item active">Nuevo</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
  @include('categoria/modalcreate')
  @include('marca/modalcreate')
  @include('medida/modalcreate')
  {!! Form::open(array('route' => 'producto.store','method'=>'POST')) !!}

    <div class="card">
        <div class="card-header" style="background-color:  #5F9EA0 ">
          <h2 style="color:white">Nuevo Producto</h2>
        <a class="btn btn-primary btn-sm" id="btnnuevacategoria"><i class="fa fa-plus" aria-hidden="true"></i> Categoria</a>
        <a class="btn btn-secondary btn-sm" id="btnnuevamarca"><i class="fa fa-plus" aria-hidden="true"></i> Marca</a>
        <a class="btn btn-warning btn-sm" id="btnnuevamedida"><i class="fa fa-plus" aria-hidden="true"></i> Medida</a>
        <span class="float-right">
          <a class="btn btn-light btn-sm" href="{{ route('producto.index') }}"><div><i style="color:gray" class="fa fa-arrow-left"></i></div></a>
        </span>
      </div>
      <!-- /.card-header -->
    
      <div class="card-body">
        <div class="row">
            {{-- <div class="col-md-4">
                <div class="form-group">
                  <label>Cantidad</label>
                  {!! Form::text('cantidad', null, array('placeholder' => 'Ingrese cantidad ','class' => 'form-control','required')) !!}
                </div>
            </div> --}}
          <div class="col-md-12">
              <div class="form-group">
                <label>Nombre del Producto</label>
                {!! Form::text('nombreproducto', null, array('placeholder' => 'nombre del producto','class' => 'form-control','required')) !!}
              </div>
            </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputPassword1">Categoria</label>
                <select class="form-control select2" id="id_categoria" name="id_categoria" style="width: 100%;">
                    {{-- <option value='0'>Seleccione una opcion</option> --}}
                </select>
              </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputPassword1">Marca</label>
                <select class="form-control select2" id="id_marca" name="id_marca" style="width: 100%;">
                </select>
              </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputPassword1">Unidad de medida</label>
                    <select class="form-control select2" id="id_medida" name="id_medida" style="width: 100%;">
                    </select>
                  </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Codigo Interno</label>
                {!! Form::text('codigoproducto', null, array('placeholder' => 'Codigo Interno','class' => 'form-control','required')) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Codigo de Barras</label>
                {!! Form::text('codigobarras', null, array('placeholder' => '','class' => 'form-control','required')) !!}
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label>Precio Costo</label>
                  {!! Form::text('precio_costo', null, array('placeholder' => 'Q. ','class' => 'form-control','required')) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Precio Venta</label>
                  {!! Form::text('precio_venta', null, array('placeholder' => 'Q.','class' => 'form-control','required')) !!}
                </div>
              </div>


          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success float-right">Guardar</button>
      </div>
    </div>
  </div>
</div>

  {!! Form::close() !!}


@endsection
@section('js')
<script src="{{ asset('js/Categoria/categoria_c.js') }}"></script>
<script src="{{ asset('js/Marca/marca_c.js') }}"></script>
<script src="{{ asset('js/Medida/medida_c.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  $(document).ready(function(){
      $('#id_categoria').select2({
          placeholder:'Seleccione',
          ajax:{
            url:"{{route('getcategoriass')}}",
            type:'post',
            dataType:'json',
            delay:100,
            data: function(params){
              return{
                _token:CSRF_TOKEN,
                search:params.term
              }
            },
          processResults:function(response){
            return{
              results: $.map(response,function(item){
                  return{
                    text: item.nombrecategoria,
                    id:item.id_categoria
                  }
              }) 
            }
          },
          cache:true
          }
      });


      $('#id_marca').select2({
          placeholder:'Seleccione',
          ajax:{
            url:"{{route('getmarcass')}}",
            type:'post',
            dataType:'json',
            delay:100,
            data: function(params){
              return{
                _token:CSRF_TOKEN,
                search:params.term
              }
            },
          processResults:function(response){
            return{
              results: $.map(response,function(item){
                  return{
                    text: item.nombremarca,
                    id:item.id_marca
                  }
              }) 
            }
          },
          cache:true
          }
      });


      $('#id_medida').select2({
          placeholder:'Seleccione',
          ajax:{
            url:"{{route('getmedidass')}}",
            type:'post',
            dataType:'json',
            delay:100,
            data: function(params){
              return{
                _token:CSRF_TOKEN,
                search:params.term
              }
            },
          processResults:function(response){
            return{
              results: $.map(response,function(item){
                  return{
                    text: item.nombremedida,
                    id:item.id_medida
                  }
              }) 
            }
          },
          cache:true
          }
      });
  });
 
</script>
@stop