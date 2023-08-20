<div class="modal fade" id="modalnuevacategoria" tabindex="-1" role="dialog" aria-labelledby="modalSedeCentral" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:  #5F9EA0 ">
        <h4 style="color: white">Datos Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="cliente_form">
      <div  class="modal-body " >
           
           
            <div class="form-group row">
              <div class="col-lg-12">
                <label class="form-label" for="sigla">Nit </label>
              </div>
              <div class="input-group col-lg-12">
                <input type="text" class="form-control form-control-border" id="identificacion"  name="identificacion" placeholder="Buscar" required>
                <button type="button" class="btn btn-md" name="button" onclick="getpersona()"><i class="fas fa-search"></i></button>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-12">
                <label class="form-label" for="sigla">Nombre </label>
                <input type="text" class="form-control" id="nombrecliente" name="nombrecliente" placeholder="Nombre" required>
                <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" placeholder="Nombre" required>
              </div>
            </div> 
      
            
          <div class="modal-footer justify-content-between">
            <button type="submit" name="action" id="#"  class="btn btn-primary">Continuar</button>
          </div>
        </form>
    </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
