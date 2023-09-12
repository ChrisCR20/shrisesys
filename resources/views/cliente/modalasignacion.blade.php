<div class="modal fade" id="modalasignacion" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header" style="background-color:  #5F9EA0 ">
          <h4 style="color: white">Nueva asignacion de precio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="asignap_form">
        <div  class="modal-body " >
             
             
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Cliente </label>
                  <select class="form-control select2" id="id_cliente" name="id_cliente" style="width: 100%;">
                    @if (isset($cliente))
                    @foreach( $cliente as $emp )
                      <option selected="" value="{{ $emp->id_cliente}}">{{ $emp->nombrecliente }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Presentacion </label>
                  <select class="form-control select2" id="id_medida" name="id_medida" style="width: 100%;">
                    @if (isset($medida))
                    @foreach( $medida as $emp )
                      <option selected="" value="{{ $emp->id_medida}}">{{ $emp->nombremedida }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Precio </label>
                  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio" required>
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
