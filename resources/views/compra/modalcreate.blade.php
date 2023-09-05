<div class="modal fade" id="modalnuevacompra"  role="dialog" aria-labelledby="modalnuevacompra" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header" style="background-color:  #5F9EA0 ">
          <h4 style="color: white">Registrar Compra</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="compra_form">
        <div  class="modal-body " >
             
             
              <div class="form-group row">
                <div class="col-lg-4">
                  <label class="form-label" for="sigla">Fecha de factura </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input  data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask id="fechafactc" name="fechafactc" class="form-control" required>
                  </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="sigla">Serie </label>
                    <input type="text" class="form-control" id="serie" name="serie" placeholder="Serie" required>
                  </div>
                  <div class="col-lg-4">
                    <label class="form-label" for="sigla">Numero </label>
                    <input type="text" class="form-control" id="numerodoctoc" name="numerodoctoc" placeholder="Numero documento" required>
                  </div>

              </div>
              <div class="form-group row post">
                <div class="col-lg-6">
                  <label for="exampleInputPassword1">Proveedor</label>
                  <select class="form-control select2" id="id_proveedor" name="id_proveedor" style="width: 100%;">
                    @if (isset($proveedor))
                    @foreach($proveedor as $per)
                        <option value="{{$per->id_proveedor}}" selected="">{{$per->nombreproveedor}}</option>
                    @endforeach
                    @endif
            
                  </select>

                </div>
                <div class="col-lg-6">
                  <label for="exampleInputPassword1">Tipo de pago</label>
                  <select class="form-control select2" id="id_tipopago" name="id_tipopago" style="width: 100%;">
                    @if (isset($tipopago))
                    @foreach($tipopago as $per)
                        <option value="{{$per->id_tipopago}}" selected="">{{$per->nombretipo}}</option>
                    @endforeach
                    @endif
                  </select>

                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-2">
                  <label for="exampleInputPassword1">cantidad</label>
                  <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Nombre" >
                </div>
                <div class="col-lg-5">
                  <label for="exampleInputPassword1">Producto</label>
                  <select class="form-control select2" id="id_producto" name="id_producto" style="width: 100%;">
                    @if (isset($producto))
                    @foreach($producto as $per)
                        <option value="{{$per->id_producto}}" selected="">{{$per->nombreproducto}}</option>
                    @endforeach
                    @endif
                  </select>

                </div>
                <div class="col-lg-3">
                  <label for="exampleInputPassword1">Subtotal</label>
                  <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="Nombre" onkeypress="return validacionkeys(event)" >
                </div>
                <div class="col-lg-2">
                <label class="fw-bold"></label>
                <div class="form-group">
                    
                    <button type="button" id="btnadditem" class="btn btn-primary">Agregar item</button>
                </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                <table id="tblacademico" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="dattable" name="dattable">
                </tbody>
                </table>
            </div>
        
              
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" name="action" id="#" value="add" class="btn btn-primary">Guardar</button>
            </div>
      </div>
    </form>
      </div>
      <!-- /.modal-content -->
</div>
</div>
