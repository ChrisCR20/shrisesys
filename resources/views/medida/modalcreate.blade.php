<div class="modal fade" id="modalnuevamedida" tabindex="-1" role="dialog" aria-labelledby="modalSedeCentral" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:  #00738C">
          <h4 style="color: white">Nueva Medida</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="medida_form">

        <div  class="modal-body " >
            <div class="form-group row">
              <div class="col-lg-12">
                <label class="form-label" for="sigla">Nombre de la medida </label>
                <input type="text" class="form-control" id="nombremedida" name="nombremedida" placeholder="Nombre" required>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" name="action" id="#" value="add" class="btn btn-primary">Guardar</button>
            </div>
          </form>
      </div>
      </div>
      <!-- /.modal-content -->
    </div>
</div>
