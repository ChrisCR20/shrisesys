<div class="modal fade" id="modaleditaritem"  role="dialog"  aria-hidden="true">
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
                  <input type="hidden" class="form-control" id="iditem" name="iditem" placeholder="Nombre" >
                    <label for="exampleInputPassword1">Producto</label>
                    <select class="form-control select2" id="id_producto" name="id_producto"  style="width: 100%;">
                      @foreach( $producto as $key => $value )
                        <option selected="selected" value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
        
              <div class="form-group row">
                <div class="col-lg-12">
                  <label class="form-label" for="sigla">Cantidad </label>
                  <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Nombre" required>
                  {{-- cantidadvact= cantidad que actualmente esta registrada en la venta --}}
                  <input type="hidden" class="form-control" id="cantidadvact" name="cantidadvact" placeholder="Nombre" required>  
                  <input type="hidden" class="form-control" id="iddetallec" name="iddetallec" placeholder="Nombre" >
                  <input type="hidden" class="form-control" id="idencabe" name="idencabe" placeholder="Nombre" >
                  <input type="hidden" class="form-control" id="id_clienteselect" name="id_clienteselect" placeholder="Nombre" >
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
