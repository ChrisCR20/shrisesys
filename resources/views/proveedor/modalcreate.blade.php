<div class="modal fade" id="modalnuevoproveedor" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header" style="background-color:  #5F9EA0 ">
          <h4 style="color: white">Nuevo Proveedor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="proveedor_form">
        <div  class="modal-body " >
             
             
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Nit </label>
                  <input type="text" class="form-control" id="nit" name="nit" placeholder="Nit" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Nombre del proveedor </label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Direccion</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" required>
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
