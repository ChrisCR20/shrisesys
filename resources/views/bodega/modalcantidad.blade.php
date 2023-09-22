<div class="modal fade" id="modalcantidad" tabindex="-1" role="dialog" aria-labelledby="modalSedeCentral" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:  #00738C">
          <h4 style="color: white">Cantidad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="cantidadform">

        <div  class="modal-body " >
            <div class="form-group row">
              <div class="col-lg-12">
                <label class="form-label" for="sigla">Ingrese cantidad de producto</label>
                <input type="text" class="form-control" id="cantidadm" name="cantidadm" placeholder="Cantidad" required>
                <input type="hidden" class="form-control" id="idproducto" name="idproducto" placeholder="Cantidad" required>
                <input type="hidden" class="form-control" id="nombreproducto" name="nombreproducto" placeholder="Cantidad" required>
                
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" name="action" onClick="agregarest()" id="#" value="add" class="btn btn-primary">Agregar</button>
            </div>
          </form>
      </div>
      </div>
      <!-- /.modal-content -->
    </div>
</div>
