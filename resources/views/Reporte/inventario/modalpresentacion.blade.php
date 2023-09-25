<div class="modal fade" id="modalpresentacion" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #4682B4">
          <h4 style="color: white">Seleccione presentacion</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="reporte_ventas_form">
        <div  class="modal-body " >
             
          <div class="form-group">
            <select class="form-control select2" id="idmedida" name="idmedida" style="width: 100%;">
                @foreach( $presentacion as $key => $value )
                  <option selected="selected" value="{{ $key }}">{{ $value }}</option>
                @endforeach
              </select>
          </div>  
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" name="action" id="btnexistencia" value="add" class="btn btn-primary">Generar</button>
            </div>
          </form>
      </div>
      </div>
      <!-- /.modal-content -->
    </div>
</div>
