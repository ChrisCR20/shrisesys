<div class="modal fade" id="modaleditaritem" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #43758c">
          <h4 style="color:white">Editar item</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div  class="modal-body " >
             
            <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Producto </label>
                  <input type="text" class="form-control" id="producto" name="nombreedit" placeholder="Nombre" disabled>
                </div>
              </div>
        
              <div class="form-group row">
                <div class="col-lg-6">
                  <label class="form-label" for="sigla">Cantidad </label>
                  <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Nombre" required>
                  <input type="hidden" class="form-control" id="iditem" name="iditem" placeholder="Nombre" >
                  <input type="hidden" class="form-control" id="iddetallec" name="iddetallec" placeholder="Nombre" >
                  <input type="hidden" class="form-control" id="idencabe" name="idencabe" placeholder="Nombre" >
                </div>
                <div class="col-lg-6">
                  <label class="form-label" for="sigla">Subtotal </label>
                  <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="Nombre" required>
                </div>
              </div>
        
              
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" name="action"  id="dog" class="btn btn-primary">Guardar</button>
            </div>
        
      </div>
      </div>
      <!-- /.modal-content -->
    </div>
</div>
