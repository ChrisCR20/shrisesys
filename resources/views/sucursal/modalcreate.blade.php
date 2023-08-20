<div class="modal fade" id="modalnuevasucursal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:  #5F9EA0 ">
          <h4 style="color: white">Nueva Sucursal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="sucursal_form">
        <div  class="modal-body " >
             
             
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Nombre de la empresa </label>
                  <input type="text" class="form-control" id="nombre_sucursal" name="nombre_sucursal" placeholder="Nombre" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Dirección </label>
                  <textarea type="text" class="form-control" id="direccion" name="direccion"class="form-control"></textarea>
                </div>
              </div>              
              <div class="form-group">
                <label for="exampleInputPassword1">Empresa</label>
                <select class="form-control select2" id="id_empresac" name="id_empresac" style="width: 100%;">
                  @if (isset($empresa))
                  @foreach( $empresa as $emp )
                    <option selected="" value="{{ $emp->id_empresa}}">{{ $emp->nombre_empresa }}</option>
                  @endforeach
                  @endif
                </select>
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
