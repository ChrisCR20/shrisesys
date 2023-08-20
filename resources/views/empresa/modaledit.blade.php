<div class="modal fade" id="modaleditarempresa" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #f3bb53">
          <h4>Editar Empresa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="empresa_form_edit">
        <div  class="modal-body " >
             
             
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Nombre de la empresa </label>
                  <input type="text" class="form-control" id="nombreedit" name="nombreedit" placeholder="Nombre" required>
                  <input type="hidden" class="form-control" id="id_empresa" name="id_empresa" placeholder="Nombre" >
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Descripción </label>
                  <textarea type="text" class="form-control" id="descripedit" name="descripedit"class="form-control"></textarea>
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
