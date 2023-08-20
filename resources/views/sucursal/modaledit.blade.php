<div class="modal fade" id="modaleditarsucursal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f3bb53">
        <h4>Editar Sucursal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="sucursal_form_edit">
      <div  class="modal-body " >
           
           
            <div class="form-group row">
              <div class="col-lg-12">
                <label class="form-label" for="sigla">Nombre de la empresa </label>
                <input type="text" class="form-control" id="nombre_sucursaledit" name="nombre_sucursaledit" placeholder="Nombre" required>
                <input type="hidden" class="form-control" id="id_sucursal" name="id_sucursal" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-12">
                <label class="form-label" for="sigla">Dirección </label>
                <textarea type="text" class="form-control" id="direccionedit" name="direccionedit"class="form-control"></textarea>
              </div>
            </div>              
            <div class="form-group">
              <label for="exampleInputPassword1">Empresa</label>
              <select class="form-control select2" id="id_empresa" name="id_empresa" style="width: 100%;">
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
