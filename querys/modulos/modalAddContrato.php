<!-- Modal para agregar un nuevo contrato -->
<div class="modal fade" id="modalAddContrato" tabindex="-1" aria-labelledby="modalAddContratoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddContratoLabel">Agregar Contrato</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-add-contrato">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nombreContrato">Nombre del Contrato</label>
                <input type="text" class="form-control" id="nombreContrato" name="nombreContrato" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="idCliente">Seleccione un Cliente</label>
                <select class="form-control" id="idCliente" name="idCliente" required>
                  <?php foreach ($clientesMap as $cliente): ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombreCliente']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="idProducto">Seleccione un Producto</label>
                <select class="form-control" id="idProducto" name="idProducto" required>
                  <?php foreach ($productosMap as $producto): ?>
                    <option value="<?php echo $producto[0]['Id_Producto']; ?>"><?php echo $producto[0]['NombreDelProducto']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="idProveedor">Seleccione un Proveedor</label>
                <select class="form-control" id="idProveedor" name="idProveedor" required>
                  <?php foreach ($proveedorMap as $proveedor): ?>
                    <option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['nombreProveedor']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="idMedio">Seleccione un Medio</label>
                <select class="form-control" id="idMedio" name="idMedio" required>
                  <?php foreach ($mediosMap as $medio): ?>
                    <option value="<?php echo $medio['id']; ?>"><?php echo $medio['NombredelMedio']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="idFormaDePago">Seleccione una Forma de Pago</label>
                <select class="form-control" id="idFormaDePago" name="idFormaDePago" required>
                  <?php foreach ($pagosMap as $pago): ?>
                    <option value="<?php echo $pago['id']; ?>"><?php echo $pago['NombreFormadePago']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="estado">Estado del Contrato</label>
                <select class="form-control" id="estado" name="estado" required>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-add-contrato">Agregar Contrato</button>
      </div>
    </div>
  </div>
</div>