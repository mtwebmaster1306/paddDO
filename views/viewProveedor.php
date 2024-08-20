<?php
// Iniciar la sesión
session_start();
// Definir variables de configuración
//$ruta = 'localhost/paddv4/';
// Función para hacer peticiones cURL
include '../querys/qproveedor.php';
// Obtener el ID del cliente de la URL
$idProveedor = isset($_GET['id_proveedor']) ? $_GET['id_proveedor'] : null;

if (!$idProveedor) {
    die("No se proporcionó un ID de cliente válido.");
}
$contactosFiltrados = array_filter($contactos, function($contacto) use ($idProveedor) {
  return $contacto['id_proveedor'] == $idProveedor;
});

// Obtener datos del cliente específico
$url = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores?id_proveedor=eq.$idProveedor&select=*";
$proveedor = makeRequest($url);

// Verificar si se obtuvo el medio
if (empty($proveedor) || !isset($proveedor[0])) {
    die("No se encontró el cliente con el ID proporcionado.");
}

$datosProveedor = $proveedor[0];

// Obtener clasificaciones asociadas al medio
$themedio = makeRequest("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/ClasificacionMedios?select=*");

// Crear un mapa de clasificaciones para fácil acceso
$clasificacionesMap = array_column($themedio, null, 'id_clasificacion_medios');

include '../componentes/header.php';
include '../componentes/sidebar.php';

?>
      <!-- Main Content -->
      <div class="main-content">
      
      <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>ListProveedores.php">Ver Proveedores</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $datosProveedor['nombreProveedor'] ; ?></li>
                      </ol>
                    </nav>
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      
                      <div class="clearfix"></div>
                      <div class="nombrex author-box-name">
                        <?php echo $datosProveedor['nombreProveedor'] ; ?>
                      </div>
                      <div class="author-box-job">
                      <?php echo 'RUT: ' .$datosProveedor['rutProveedor'] ; ?>
                      
                    
                    </div>
                    </div>
                    <div class="text-center">
                      <div class="author-box-job">
               
                        <?php
    // Convertir la cadena de fecha y hora a un objeto DateTime
    $fecha = new DateTime($datosProveedor['created_at']);
    
    // Formatear la fecha como deseas (en este caso, solo la fecha)
    echo 'Registrado el: '.$fecha->format('d-m-Y'); // Esto mostrará la fecha en formato AAAA-MM-DD
    ?>
                   
                      </div>
                      <div class="w-100 d-sm-none"></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Detalles del Proveedor</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-start">
                        Nombre Proveedor
                        </span>
                        <span class="float-right text-muted">
                          <?php echo $datosProveedor['nombreProveedor'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Nombre de Fantasía
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosProveedor['nombreFantasia'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Razón Social
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosProveedor['razonSocial'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Giro Proveedor
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosProveedor['giroProveedor'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Dirección
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosProveedor['direccionFacturacion'] ; ?>
                        </span>
                      </p>
                      
                   
                    </div>
                  </div>
                </div>
               
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-bs-toggle="tab" href="#generales" role="tab"
                          aria-selected="true">Datos Generales</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-bs-toggle="tab" href="#facturacion" role="tab"
                          aria-selected="false">Datos de Facturación</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-bs-toggle="tab" href="#contactos" role="tab"
                          aria-selected="false">Contactos</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab4" data-bs-toggle="tab" href="#soportes" role="tab"
                          aria-selected="false">Soportes</a>
                      </li>

             
                    

                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="generales" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                          <div class="col-md-4 col-6 b-r">
                            <strong>Razón Social</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['razonSocial'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Nombre de Fantasía</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['nombreFantasia'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Nombre Identificador</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['nombreIdentificador'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6">
                            <strong>Giro Proveedor</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['giroProveedor']; ?></p>
                          </div>
                          <div class="col-md-4 col-6">
                            <strong>Representante Legal</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['nombreRepresentante'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6">
                            <strong>RUT Representante</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['rutRepresentante'] ; ?></p>
                          </div>
                           <div class="col-md-4 col-6">
                            <strong>N° de Soportes</strong>
                            <br>
                            <p class="text-muted">
                             <?php
                                                 
                            $contador = 0;
                            foreach ($soportes as $soporte) {
                                if ($datosProveedor['id_proveedor'] == $soporte['id_proveedor']) {
                                    $contador++;
                                }
                            }
                            echo $contador;
                          ?>
                            </p>
                          </div>

                           <div class="col-md-4 col-6">
                            <strong>N° de Medios</strong>
                            <br>
                            <p class="text-muted">Acá data</p>
                          </div>

                          <div class="col-md-4 col-6">
                            <strong>Clientes</strong>
                            <br>
                            <p class="text-muted">Acá data</p>
                          </div>

                        </div>
                      
                      </div>


                      
                      <div class="tab-pane fade" id="facturacion" role="tabpanel" aria-labelledby="profile-tab2">
                      <div class="row">
                      <div class="col-md-4 col-6 b-r">
                            <strong>Región</strong>
                            <br>
                            <p class="text-muted"><?php echo $regionesMap[$datosProveedor['id_region']] ?? ''; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Comuna</strong>
                            <br>
                            <p class="text-muted"><?php echo $comunasMap[$datosProveedor['id_comuna']] ?? ''; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Dirección</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['direccionFacturacion'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Teléfono Fijo</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['telFijo'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Teléfono Celular</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['telCelular'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Email</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['email'] ; ?></p>
                          </div>
                      </div>
                      </div>

                      <div class="tab-pane fade" id="contactos" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="card-header milinea">
                                        <div class="titulox am">Listado de Contactos</div>
                                        <div class="agregar">
                                            <a href="#" class="btn btn-primary open-modal" data-bs-toggle="modal"
                                                data-bs-target="#contactoProveedor">
                                                <i class="fas fa-plus-circle"></i> Agregar Comisión
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($contactosFiltrados) && isset($contactosFiltrados[0])): ?>
        <?php foreach ($contactosFiltrados as $contacto): ?>
        <tr>
            <td><?php echo htmlspecialchars($contacto['id_contacto'] ?? 'No disponible'); ?></td>
            <td><?php echo htmlspecialchars($contacto['nombres'] ?? 'No disponible'); ?></td>
            <td><?php echo htmlspecialchars($contacto['apellidos'] ?? 'No disponible'); ?></td>
            <td><?php echo htmlspecialchars($contacto['telefono'] ?? 'No disponible'); ?></td>
            <td><?php echo htmlspecialchars($contacto['email'] ?? 'No disponible'); ?></td>
            <td>
              <input type="hidden" data-idproveedor="<?php echo $idProveedor ?>" value="<?php echo $idProveedor ?>">
                <input type="hidden" class="id_contacto" value="<?php echo htmlspecialchars($contacto['id_contacto'] ?? 'No disponible'); ?>">
                <button type="button" class="btn btn-success micono" 
        data-bs-toggle="modal" 
        data-bs-target="#actualizarContactoModal"
        data-idcontacto="<?php echo htmlspecialchars($contacto['id_contacto']); ?>" 
        data-nombre="<?php echo htmlspecialchars($contacto['nombres']); ?>"
        data-apellido="<?php echo htmlspecialchars($contacto['apellidos']); ?>"
        data-telefono="<?php echo htmlspecialchars($contacto['telefono']); ?>"
        data-email="<?php echo htmlspecialchars($contacto['email']); ?>"
        data-toggle="tooltip" 
        title="Editar">
    <i class="fas fa-pencil-alt"></i>
</button>
                <button type="button" class="btn btn-danger micono eliminar-contacto"
                        data-idcontacto="<?php echo htmlspecialchars($contacto['id_contacto'] ?? ''); ?>"
                        data-toggle="tooltip" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="6">No hay datos disponibles</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
                      </div>

                      <div class="tab-pane fade" id="soportes" role="tabpanel" aria-labelledby="profile-tab4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre Producto</th>
                <th>N° Campañas</th>
                <th>N° Contratos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>

                <tr>
                    <td><?php echo htmlspecialchars($producto['NombreDelProducto']); ?></td>
                    <td>
    <?php
    // Obtener el ID del producto actual
    $nombreDelProducto = urlencode($producto['id']); // O usa el ID directamente si es un número

    // Construir la URL de solicitud
    $url = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Campania?id_Producto=eq.$nombreDelProducto&select=*";

    // Realizar la solicitud y obtener la respuesta
    $campaign = makeRequest($url);

    // Contar ocurrencias de 'id_Producto'
    $campaniaCounts = [];

    foreach ($campaign as $entry) {
        $idProducto = $entry['id_Producto'];
        if (isset($campaniaCounts[$idProducto])) {
            $campaniaCounts[$idProducto]++;
        } else {
            $campaniaCounts[$idProducto] = 1;
        }
    }

    // Obtener el contador para el producto actual
    $conteo = isset($campaniaCounts[$nombreDelProducto]) ? $campaniaCounts[$nombreDelProducto] : 0;

    // Mostrar el contador de campañas en un elemento <p>
    ?>
    <p><?php echo htmlspecialchars($conteo); ?></p>
</td>
                    <td><?php echo htmlspecialchars($datosCliente['telCelular']); ?></td>
                    <td><?php echo htmlspecialchars($datosCliente['telFijo']); ?></td>
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
          </div>
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal fade" id="contactoProveedor" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">AGREGAR CONTACTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Alerta para mostrar el resultado de la actualización -->
                <div id="updateAlert" class="alert" style="display:none;" role="alert"></div>


                <form id="contactoagregar">
                    <input type="hidden" name="id_proveedor" value="<?php echo $idProveedor; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nombre" name="nombre">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="apellido" name="apellido">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="telefono" name="telefono">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="email" name="email">

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Contacto</button>
                </form>
            </div>
        </div>
    </div>
</div>
      <div class="modal fade" id="actualizarContactoModal" tabindex="-1" role="dialog" aria-labelledby="actualizarContactoModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarContactoModal">ACTUALIZAR CONTACTO</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="actualizarcontactop">
                    <input type="hidden" name="id_proveedor" value="<?php echo $idProveedor; ?>">
                    <input type="hidden" id="id_contacto" name="id_contacto">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="apellido" name="apellido">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Contacto</button>
                </form>
            </div>
        </div>
    </div>
</div>






<script>document.addEventListener('DOMContentLoaded', function () {
    var actualizarContactoModal = document.getElementById('actualizarContactoModal');

    actualizarContactoModal.addEventListener('show.bs.modal', function (event) {
        // Extrae el botón que activó el modal
        var button = event.relatedTarget;
        
        // Extrae los datos del contacto del atributo data-* del botón
        var idContacto = button.getAttribute('data-idcontacto');
        var nombre = button.getAttribute('data-nombre');
        var apellido = button.getAttribute('data-apellido');
        var telefono = button.getAttribute('data-telefono');
        var email = button.getAttribute('data-email');
        
        // Llena el formulario del modal con los datos del contacto
        var modal = document.querySelector('#actualizarcontactop');
        modal.querySelector('#id_contacto').value = idContacto;
        modal.querySelector('#nombre').value = nombre;
        modal.querySelector('#apellido').value = apellido;
        modal.querySelector('#telefono').value = telefono;
        modal.querySelector('#email').value = email;
    });
});</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('ID del cliente:', <?php echo json_encode($idProveedor); ?>);

    const form = document.getElementById('contactoagregar');
    const submitButton = form.querySelector('button[type="submit"]');
    let isSubmitting = false;

    // Asegúrate de reemplazar esto con tu clave API real de Supabase
    const SUPABASE_API_KEY =
        'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc';

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        if (isSubmitting) {
            console.log('Envío ya en progreso, ignorando este envío.');
            return;
        }

        isSubmitting = true;
        submitButton.disabled = true;

        const formData = new FormData(this);
        const data = {
            id_proveedor: parseInt(formData.get('id_proveedor')),
            nombres: formData.get('nombre'),
            apellidos: formData.get('apellido'),
            telefono: formData.get('telefono'),
            email: formData.get('email')
        };

        console.log('Datos del formulario:', data);

        try {
            document.body.classList.add('loaded');

            const response = await fetch(
                'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/contactos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'apikey': SUPABASE_API_KEY,
                        'Authorization': `Bearer ${SUPABASE_API_KEY}`,
                        'Prefer': 'return=minimal'
                    },
                    body: JSON.stringify(data)
                });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`HTTP error! status: ${response.status}, message: ${errorText}`);
            }

            $('#contactoProveedor').modal('hide');
            await Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Comisión guardada exitosamente',
                showConfirmButton: false,
                timer: 1500
            });
            location.reload();
            
        } catch (error) {
            console.error('Error en la solicitud:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al guardar la comisión: ' + error.message
            });
        } finally {
            document.body.classList.remove('loaded');
            isSubmitting = false;
            submitButton.disabled = false;
        }
    });

    
async function actualizarContacto(event) {
    event.preventDefault(); // Evita que el formulario se envíe de la manera tradicional

    const formData = new FormData(event.target); // Obtiene los datos del formulario
    const id = formData.get('id_contacto'); // Obtiene el ID del contacto desde el formulario

    // Prepara los datos que se enviarán a la API
    const data = {
        id_proveedor: parseInt(formData.get('id_proveedor')), // Asegúrate de que el nombre de campo coincida con el del formulario
        nombres: formData.get('nombre'), // Asegúrate de que el nombre del campo coincida con el del formulario
        apellidos: formData.get('apellido'), // Asegúrate de que el nombre del campo coincida con el del formulario
        telefono: formData.get('telefono'), // Asegúrate de que el nombre del campo coincida con el del formulario
        email: formData.get('email') // Asegúrate de que el nombre del campo coincida con el del formulario
    };
console.log(data,"acutalizarrr");
    try {
        const response = await fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/contactos?id_contacto=eq.${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'apikey': SUPABASE_API_KEY,
                'Authorization': `Bearer ${SUPABASE_API_KEY}`,
                'Prefer': 'return=minimal'
            },
            body: JSON.stringify(data) // Convierte los datos a formato JSON
        });

        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        // Funciones para mostrar éxito y ocultar el modal
        
       
        mostrarExito('Contacto actualizado correctamente');
        location.reload(); // Reemplaza esto con tu función para actualizar la tabla de contactos

    } catch (error) {
        console.error('Error al actualizar el contacto:', error);
        mostrarError('No se pudo actualizar el contacto: ' + error.message);
    }
}
async function eliminarContacto(id) {
    if (!await confirmarEliminar()) return; // Confirmar la eliminación con el usuario

    try {
        // Realiza la solicitud DELETE a la API de contactos
        const response = await fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/contactos?id_contacto=eq.${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json', // Asegúrate de incluir el tipo de contenido JSON
                'apikey': SUPABASE_API_KEY,
                'Authorization': `Bearer ${SUPABASE_API_KEY}`
            }
        });

        // Verifica si la respuesta fue exitosa
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        // Mostrar mensaje de éxito y actualizar la lista de contactos
        mostrarExito('El contacto ha sido eliminado.');
        await cargarYMostrarContactos(); // Asegúrate de tener esta función para actualizar la vista

    } catch (error) {
        console.error('Error al eliminar el contacto:', error);
        mostrarError('No se pudo eliminar el contacto: ' + error.message);
    }
}

async function confirmarEliminar() {
        const result = await Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        });
        return result.isConfirmed;
    }


function mostrarExito(mensaje) {
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: mensaje,
        showConfirmButton: false,
        timer: 1500
    });
}

document.querySelectorAll('.eliminar-contacto').forEach(button => {
        button.addEventListener('click', async function() {
            // Obtiene el ID del contacto del atributo data-idcontacto
            const idContacto = this.getAttribute('data-idcontacto');

            // Llama a la función de eliminar contacto con el ID obtenido
            await eliminarContacto(idContacto);
        });
    });



    document.getElementById('actualizarcontactop').addEventListener('submit', actualizarContacto);
  
});






</script>
<?php include '../componentes/settings.php'; ?>
<?php include '../componentes/footer.php'; ?>