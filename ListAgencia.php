<?php
// Iniciar la sesión
session_start();

// Función para hacer peticiones cURL
include 'querys/qagencia.php';

include 'componentes/header.php';
include 'componentes/sidebar.php';
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-header milinea">
                        <div class="titulox"><h4>Listado Agencias</h4></div>
                        <div class="agregar"><a class="btn btn-primary" href="addAgencia.php"><i class="fas fa-plus-circle"></i> Agregar Agencia</a></div>
                        </div>
                            
                       </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped text-center" id="tableExportadora">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre de Agencia</th>
                                            <th>Representante</th>
                                            <th>Razón Social</th>
                                            <th>Rut</th>
                                            <th>N° de Campañas</th>
                                            <th>N° de Contratos</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($agencias as $agencia): ?>
                                        <tr>
                                            <td><?php echo $agencia['id']; ?></td>
                                            <td><?php echo $agencia['NombreDeFantasia']; ?></td>
                                            <td><?php echo $agencia['NombreRepresentanteLegal']; ?></td>
                                            <td><?php echo $agencia['RazonSocial']; ?></td>
                                            <td><?php echo $agencia['RutAgencia']; ?></td>
                                            <td>
                                                <?php
                                                 
                                                 $contador = 0;
                                                 foreach ($campaigns as $campaign) {
                                                     if ($agencia['id'] == $campaign['Id_Agencia']) {
                                                         $contador++;
                                                     }
                                                 }
                                                 echo $contador;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                 
                                                 $contador = 0;
                                                 foreach ($contratos as $contrato) {
                                                     if ($agencia['id'] == $contrato['IdAgencias']) {
                                                         $contador++;
                                                     }
                                                 }
                                                 echo $contador;
                                                ?>
                                            </td>
                                          <td>
    <div class="alineado">
       <label class="custom-switch sino" data-toggle="tooltip" 
       title="<?php echo $agencia['estado'] ? 'Desactivar agencia' : 'Activar agencia'; ?>">
    <input type="checkbox" 
           class="custom-switch-input estado-switch"
           data-id="<?php echo $agencia['id']; ?>"
           <?php echo $agencia['estado'] ? 'checked' : ''; ?>>
    <span class="custom-switch-indicator"></span>
</label>
    </div>
</td>
                                            <td><a href="views/viewAgencia.php?id=<?php echo $agencia['id']; ?>" data-toggle="tooltip" title="Ver Agencia"><i class="fas fa-eye btn btn-primary miconoz"></i></a>   <button type="button" class="btn btn-success micono" data-bs-toggle="modal" data-bs-target="#actualizaragencia" data-idagencia    ="<?php echo $agencia['id']; ?>" onclick="loadAgenciaData(this)">
                            <i class="fas fa-pencil-alt"></i>
                        </button> <a href="#" data-toggle="tooltip" title="Eliminar Agencia" onclick="eliminarAgencia(<?php echo $agencia['id']; ?>)"><i class="fas fa-trash-alt btn btn-danger micono"></i></a></td>
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

<div class="modal fade" id="actualizaragencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Agencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí va el contenido del formulario del modal -->
                <form id="formularioactualizar" >
                    <!-- Campos del formulario -->
                    <div>
                        <h3 class="titulo-registro mb-3">Actualizar Agencia:</h3>
                        <div class="row">
                            <div class="col-6">
                            <input type="hidden" name="id_agencia" >             
                                <p><input class="form-control" placeholder="Razón Social" name="razonSocial" required></p>
                                <p><input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasia" required></p>
                                <p><input class="form-control" placeholder="Nombre Identificador" name="nombreIdentificador" required></p>
                                <p><input class="form-control" placeholder="Rut" name="rut" required></p>
                            </div>
                            <div class="col-6">
                                <p><input class="form-control" placeholder="Giro" name="giro" required></p>
                                <p><input class="form-control" placeholder="Nombre Representante legal" name="nombreRepresentanteLegal" required></p>
                                <p><input class="form-control" placeholder="Rut Representante" name="rutRepresentante" required></p>
                            </div>
                        </div>
                    </div>
                    <div >
                        <h3 class="titulo-registro mb-3">Datos de facturación</h3>
                        <div class="row">
                            <div class="col-6">
                                <p><input class="form-control" placeholder="Dirección" name="direccionagencia" required></p>
                                <select class="form-select mb-3" name="id_region" id="region" required>
    <?php foreach ($regiones as $regione) : ?>
        <option value="<?php echo $regione['id']; ?>"><?php echo $regione['nombreRegion']; ?></option>
    <?php endforeach; ?>
</select>
<select class="form-select mb-3" name="id_comuna" id="comuna" required>
    <?php foreach ($comunas as $comuna) : ?>
        <option value="<?php echo $comuna['id_comuna']; ?>" data-region="<?php echo $comuna['id_region']; ?>">
            <?php echo $comuna['nombreComuna']; ?>
        </option>
    <?php endforeach; ?>
</select>
                                
                            </div>
                            <div class="col-6">
                            <p><input class="form-control" placeholder="Teléfono celular" name="telCelular" required></p>
                                <p><input class="form-control" placeholder="Teléfono fijo" name="telFijo" required></p>
                                <p><input class="form-control" placeholder="Email" name="email" required></p>
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
<script src="<?php echo $ruta; ?>assets/js/actualizaragenciaup.js"></script>
<script>
    function loadAgenciaData(button) {
        // Obtener el ID de la agencia del atributo data-idagencia del botón
        var idAgencia = button.getAttribute('data-idagencia');

        // Obtener los datos de la agencia correspondiente usando el ID
        var agencia = getAgenciaData(idAgencia);

        if (agencia) {
            // Asignar los valores obtenidos a los campos del formulario en el modal
            document.querySelector('input[name="id_agencia"]').value = agencia.id;
            document.querySelector('input[name="razonSocial"]').value = agencia.RazonSocial;
            document.querySelector('input[name="nombreFantasia"]').value = agencia.NombreDeFantasia;
            document.querySelector('input[name="nombreIdentificador"]').value = agencia.NombreIdentificador;
            document.querySelector('input[name="rut"]').value = agencia.RutAgencia;
            document.querySelector('input[name="giro"]').value = agencia.Giro;
            document.querySelector('input[name="nombreRepresentanteLegal"]').value = agencia.NombreRepresentanteLegal;
            document.querySelector('input[name="rutRepresentante"]').value = agencia.rutRepresentante;
            document.querySelector('input[name="direccionagencia"]').value = agencia.DireccionAgencia;
            document.querySelector('input[name="telCelular"]').value = agencia.telCelular;
            document.querySelector('input[name="telFijo"]').value = agencia.telFijo;
            document.querySelector('input[name="email"]').value = agencia.Email;

            // Asignar las regiones y comunas usando los IDs y los mapas
            document.querySelector('select[name="id_region"]').value = agencia.Region;
            document.querySelector('select[name="id_comuna"]').value = agencia.Comuna;


        } else {
            console.log("No se encontró la agencia con ID:", idAgencia);
        }
    }

    function getAgenciaData(idAgencia) {
        var agenciasMap = <?php echo json_encode($agenciasMap); ?>;
        return agenciasMap[idAgencia] || null;
    }
     // Filtrar comunas por región seleccionada
     document.getElementById('region').addEventListener('change', function () {
        var regionId = this.value;
        var comunaSelect = document.getElementById('comuna');
        var opcionesComunas = comunaSelect.querySelectorAll('option');

        // Mostrar solo las comunas que pertenecen a la región seleccionada
        opcionesComunas.forEach(function (opcion) {
            if (opcion.getAttribute('data-region') === regionId) {
                opcion.style.display = 'block';
            } else {
                opcion.style.display = 'none';
            }
        });

        // Seleccionar la primera opción visible
        var firstVisibleOption = comunaSelect.querySelector('option[data-region="' + regionId + '"]');
        if (firstVisibleOption) {
            firstVisibleOption.selected = true;
        }
    });

    // Disparar el evento change al cargar la página para establecer el estado inicial
    document.getElementById('region').dispatchEvent(new Event('change'));
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="assets/js/eliminaragencia.js"></script>
<script src="assets/js/toggleAgenciaEstado.js"></script>
<?php include 'componentes/settings.php'; ?>
<?php include 'componentes/footer.php'; ?>