<div class="modal fade" id="modalreporteventas" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #4682B4">
          <h4 style="color: white">Seleccionar Fechas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="reporte_ventas_form">
        <div  class="modal-body " >
             
          <div class="form-group">
            <label>Fecha inicial:</label>
              <div class="input-group date"  data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" id="f_iniciorep" name="f_iniciorep" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>  
          <div class="form-group">
            <label>Fecha final:</label>
              <div class="input-group date"  data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" id="f_finalrep" name="f_finalrep" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>  
        
              
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" name="action" id="btnrepventasdown" value="add" class="btn btn-primary">Generar</button>
            </div>
          </form>
      </div>
      </div>
      <!-- /.modal-content -->
    </div>
</div>
