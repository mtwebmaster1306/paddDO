<?php
// Iniciar la sesión
session_start();

// Función para hacer peticiones cURL
include 'querys/qclientes.php';

include 'componentes/header.php';
include 'componentes/sidebar.php';
?>
<div class="main-content">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista de Clientes</li>
        </ol>
    </nav><br>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header milinea">
                            <div class="titulox"><h4>Listado de Clientes</h4></div>
                            <div class="agregar"><a class="btn btn-primary" href="addCliente.php"><i class="fas fa-plus-circle"></i> Agregar Cliente</a></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableExportadora">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Cliente</th>
                                            <th>Nombre de Fantasia</th>
                                            <th>Grupo</th>
                                            <th>Razón Social</th>
                                            <th>Tipo de Cliente</th>
                                            <th>Rut Empresa</th>
                                            <th>Región</th>
                                            <th>Comuna</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes as $cliente): ?>
                                        <tr>
                                            <td><?php echo $cliente['id_cliente']; ?></td>
                                            <td><?php echo $cliente['nombreCliente']; ?></td>
                                            <td><?php echo $cliente['nombreFantasia']; ?></td>
                                            <td><?php echo $cliente['grupo']; ?></td>
                                            <td><?php echo $cliente['razonSocial']; ?></td>
                                            <td><?php echo $tiposClienteMap[$cliente['id_tipoCliente']] ?? ''; ?></td>
                                            <td><?php echo $cliente['RUT']; ?></td>
                                            <td><?php echo $regionesMap[$cliente['id_region']] ?? ''; ?></td>
                                            <td><?php echo $comunasMap[$cliente['id_comuna']] ?? ''; ?></td>
                                            <td>
                                            <div class="alineado">
       <label class="custom-switch sino" data-toggle="tooltip" 
       title="<?php echo $cliente['estado'] ? 'Desactivar Cliente' : 'Activar Cliente'; ?>">
    <input type="checkbox" 
           class="custom-switch-input estado-switch"
           data-id="<?php echo $cliente['id_cliente']; ?>" data-tipo="cliente" <?php echo $cliente['estado'] ? 'checked' : ''; ?>> <span class="custom-switch-indicator"></span>
</label>
    </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary micono" href="views/viewCliente.php?id_cliente=<?php echo $cliente['id_cliente']; ?>" data-toggle="tooltip" title="Ver Cliente"><i class="fas fa-eye "></i></a>
                                                <button type="button" class="btn btn-success micono" data-bs-toggle="modal" data-bs-target="#actualizarcliente" data-idcliente="<?php echo $cliente['id_cliente']; ?>" onclick="loadClienteData(this)" ><i class="fas fa-pencil-alt"></i></button>


                                                <a href="#" class="btn btn-danger micono delete-client" data-id="<?php echo $cliente['id_cliente']; ?>" data-toggle="tooltip" title="Eliminar Cliente"><i class="fas fa-trash-alt"></i></a>

                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="actualizarcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí va el contenido del formulario del modal -->
                <form id="formularioactualizarcliente">
                    <!-- Campos del formulario -->
                    <div>
                        <h3 class="titulo-registro mb-3">Actualizar Cliente:</h3>
                        <div class="row">
                            <div class="col-6 miformulario">
                                <input type="hidden" name="id_cliente">
                                <div class="form-group">
        <label for="nombreCliente">Nombre del Cliente</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input class="form-control" placeholder="Nombre de cliente" name="nombreCliente">
        </div>
    </div>
    <div class="form-group">
        <label for="nombreCliente">Nombre de Fantasía</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-address-card"></i></span>
            </div>
            <input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasia">
        </div>
                                        </div>
                                        <div class="form-group">
        <label for="nombreCliente">Tipo de Cliente</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
            </div>
            <select class="form-select mb-3" name="id_tipoCliente" id="tipocliente">
                                    <?php foreach ($tipoclientesMap as $id => $tipocliente) : ?>
                                        <option value="<?php echo $id; ?>" <?php echo isset($cliente['id_tipoCliente']) && $id == $cliente['id_tipoCliente'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($tipocliente['nombreTipoCliente']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
        </div>
    </div>
    <div class="form-group arriba">
        <label for="nombreCliente">Razón Social</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-address-book"></i></span>
            </div>
           <input class="form-control" placeholder="Razón Social" name="razonSocial">
        </div>
    </div>
    <div class="form-group">
        <label for="nombreCliente">Grupo</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
            </div>
           <input class="form-control" placeholder="Grupo" name="grupo">
        </div>
    </div>
                            </div>
                            <div class="col-6 miformulario">
                            <div class="form-group">
        <label for="nombreCliente">Rut Empresa</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-id-badge"></i></span>
            </div>
           <input class="form-control" placeholder="Rut Empresa" name="RUT_info">
        </div>
    </div>
    <div class="form-group">
        <label for="nombreCliente">Giro</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
far fa-clipboard"></i></span>
            </div>
           <input class="form-control" placeholder="Giro" name="giro">
        </div>
    </div>
    <div class="form-group">
        <label for="nombreCliente">Nombre representante legal</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
fas fa-user-plus"></i></span>
            </div>
          <input class="form-control" placeholder="Nombre representante legal" name="nombreRepresentanteLegal">
        </div>
    </div>
    <div class="form-group">
        <label for="nombreCliente">RUT representante legal</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-table"></i></span>
            </div>
          <input class="form-control" placeholder="Rut Representante" name="Rut_representante">
        </div>
    </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="titulo-registro mb-3">Datos de facturación</h3>
                        <div class="row">
                            <div class="col-6">
                            <div class="form-group">
        <label for="nombreCliente">Dirección Empresa</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
fas fa-store"></i></span>
            </div>
          <input class="form-control" placeholder="Dirección" name="direccionEmpresa">
        </div>
    </div>
    <div class="form-group">
        <label for="nombreCliente">Región</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
far fa-map"></i></span>
            </div>
          <select class="form-select mb-3" name="id_region" id="region">
                                    <?php foreach ($regiones as $regione) : ?>
                                        <option value="<?php echo $regione['id']; ?>"><?php echo $regione['nombreRegion']; ?></option>
                                    <?php endforeach; ?>
                                </select>
        </div>
    </div>
    <div class="form-group arriba2">
        <label for="nombreCliente">Comuna</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="

far fa-object-group"></i></span>
            </div>
<select class="form-select mb-3" name="id_comuna" id="comuna">
                                    <?php foreach ($comunas as $comuna) : ?>
                                        <option value="<?php echo $comuna['id_comuna']; ?>" data-region="<?php echo $comuna['id_region']; ?>"><?php echo $comuna['nombreComuna']; ?></option>
                                    <?php endforeach; ?>
                                </select>
        </div>
    </div>
                                
                            </div>
                            <div class="col-6">
                            <div class="form-group">
        <label for="nombreCliente">Teléfono fijo</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg></span>
            </div>
<input class="form-control" placeholder="Teléfono fijo" name="telFijo">
        </div>
    </div>
    <div class="form-group">
        <label for="nombreCliente">Teléfono Celular</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
  <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
</svg></span>
            </div>
<input class="form-control" placeholder="Teléfono celular" name="telCelular">
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
<input class="form-control" placeholder="Email" name="email">
        </div>
    </div>
                            </div>
                        </div>
                        <h3 class="titulo-registro mb-3">Otros datos</h3>
                        <div class="row">
    <div class="col">
        <p>
            <select class="form-select mb-3" name="formato" id="formato">
                <option value="">Seleccionar Formato</option>
                <option value="Fee">Fee</option>
                <option value="% Comisión Offline">% Comisión Offline</option>
                <option value="% Comisión Online">% Comisión Online</option>
            </select>
        </p>
    </div>
    <div class="col" id="moneda-container">
        <p>
            <select class="form-select mb-3" name="nombreMoneda" id="nombreMoneda">
                <option value="UF">UF</option>
                <option value="Peso">Peso</option>
                <option value="Dólar">Dólar</option>
            </select>
        </p>
    </div>
    <div class="col">
        <p>
            <input class="form-control" placeholder="Valor" name="valor" id="valor">
        </p>
    </div>
</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveBtn" onclick="submitForm(event)">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>


<!-- Mueve el script aquí, justo antes del cierre de la etiqueta body -->
 
<script>
    function loadClienteData(button) {
        var idCliente = button.getAttribute('data-idcliente');
        var cliente = getClienteData(idCliente);

        if (cliente) {
            console.log('Datos del cliente:', cliente);
            document.querySelector('input[name="id_cliente"]').value = cliente.id_cliente;
            document.querySelector('input[name="nombreCliente"]').value = cliente.nombreCliente;
            document.querySelector('input[name="nombreFantasia"]').value = cliente.nombreFantasia;
            document.querySelector('select[name="id_tipoCliente"]').value = cliente.id_tipoCliente;
            document.querySelector('input[name="razonSocial"]').value = cliente.razonSocial;
            document.querySelector('input[name="grupo"]').value = cliente.grupo;
            document.querySelector('input[name="RUT_info"]').value = cliente.RUT;
            document.querySelector('input[name="giro"]').value = cliente.giro;
            document.querySelector('input[name="nombreRepresentanteLegal"]').value = cliente.nombreRepresentanteLegal;
            document.querySelector('input[name="Rut_representante"]').value = cliente.RUT_representante;
            document.querySelector('input[name="direccionEmpresa"]').value = cliente.direccionEmpresa;
            document.querySelector('select[name="id_region"]').value = cliente.id_region;
            document.querySelector('select[name="id_comuna"]').value = cliente.id_comuna;
            document.querySelector('input[name="telCelular"]').value = cliente.telCelular;
            document.querySelector('input[name="telFijo"]').value = cliente.telFijo;
            document.querySelector('input[name="email"]').value = cliente.email;
            document.querySelector('input[name="formato"]').value = cliente.formato;
            document.querySelector('input[name="nombreMoneda"]').value = cliente.nombreMoneda;
            document.querySelector('input[name="valor"]').value = cliente.valor;

        } else {
            console.log("No se encontró el cliente con ID:", idCliente);
        }
    }

    function getClienteData(idCliente) {
        var clientesMap = <?php echo json_encode($clientesMap); ?>;
        return clientesMap[idCliente] || null;
    }

    document.getElementById('region').addEventListener('change', function () {
        var regionId = this.value;
        var comunaSelect = document.getElementById('comuna');
        var opcionesComunas = comunaSelect.querySelectorAll('option');

        opcionesComunas.forEach(function (opcion) {
            if (opcion.getAttribute('data-region') === regionId) {
                opcion.style.display = 'block';
            } else {
                opcion.style.display = 'none';
            }
        });

        var firstVisibleOption = comunaSelect.querySelector('option[data-region="' + regionId + '"]');
        if (firstVisibleOption) {
            firstVisibleOption.selected = true;
        }
    });

    document.getElementById('region').dispatchEvent(new Event('change'));

</script>
<script src="<?php echo $ruta; ?>assets/js/actualizarcliente.js"></script>

<?php include 'componentes/settings.php'; ?>
<script src="assets/js/toggleClientes.js"></script>
<script src="assets/js/deleteCliente.js"></script>
<?php include 'componentes/footer.php'; ?>