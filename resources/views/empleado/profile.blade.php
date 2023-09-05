@extends('adminlte::page')
@section('plugins.Select2', true)

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Perfil</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Perfil de usuario</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('images/userprf.png')}}"
                       alt="User profile picture">
                </div> 

                <h3 class="profile-username text-center">{{ $data[0]->primer_nombre }}</h3>

                {{-- <p class="text-muted text-center">{{ $data[0]->tel_corporativo}}</p> --}}
                 

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Sucursal</b> <a class="float-right">{{ $data[0]->nombresucursal}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Datos Generales</a></li>
             

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Identificacion</label>
                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" placeholder="Nombre" value="{{ $data[0]->codunicoid  }}" readonly>
                      </div>
                    </div>
                    <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" value="{{ $data[0]->primer_nombre .' '. $data[0]->segundo_nombre .' '.$data[0]->primer_apellido.' '.$data[0]->segundo_apellido   }}" readonly>
                    </div>
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" value="{{ $data[0]->tel_corporativo   }}" readonly>
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">

                  </div>
                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

  
@endsection
