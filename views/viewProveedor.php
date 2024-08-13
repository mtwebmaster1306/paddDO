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
                      <div class="row">
                      <div class="col-md-4 col-6 b-r">
                            <strong>Nombre de Contacto</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['nombreContacto'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Correo de Contacto</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['emailContacto'] ; ?></p>
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
<?php include '../componentes/settings.php'; ?>
<?php include '../componentes/footer.php'; ?>