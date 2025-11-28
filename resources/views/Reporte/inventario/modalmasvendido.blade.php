<div class="modal fade" id="modalmasvendido" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #4682B4">
          <h4 style="color: white">Elija los parametros del reporte</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="reporte_masvendido_form">
        <div  class="modal-body " >
          <div class="form-group">
            <label>Presentación</label>
            <select class="form-control select2" id="idmedidatop" name="idmedidatop" style="width: 100%;">
                @foreach( $presentacion as $key => $value )
                  <option selected="selected" value="{{ $key }}">{{ $value }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label>Top</label>
            <input type="number" class="form-control" id="topmasv" name="topmasv" min="1" value="1"/>
            {{-- <select class="form-control select2" id="topmasv" name="topmasv" style="width: 100%;">
                  <option selected="selected" value=1>50</option>
                  <option selected="selected" value=2>30</option>
                  <option selected="selected" value=3>15</option>
              </select> --}}
          </div>
          <div class="form-group row">
            <div class="col-md-6">
            <label>Fecha inicial:</label>
              <div class="input-group date "  data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" id="f_iniciorepmas" name="f_iniciorepmas" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
              </div>
              <div class="col-md-6">
              <label>Fecha final:</label>
              <div class="input-group date"  data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" id="f_finalrepmas" name="f_finalrepmas" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
              </div>
          </div>  
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" name="action" id="btnmasvendido" value="add" class="btn btn-primary">Generar</button>
            </div>
        </div>
          </form>
      </div>
      </div>
      <!-- /.modal-content -->
    </div>
</div>
