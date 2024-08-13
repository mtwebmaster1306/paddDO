<?php
// Iniciar la sesión
session_start();
// Definir variables de configuración
//$ruta = 'localhost/paddv4/';
// Función para hacer peticiones cURL
include '../querys/qclientes.php';

// Obtener el ID del cliente de la URL
$idCliente = isset($_GET['id_soporte']) ? $_GET['id_soporte'] : null;

if (!$idCliente) {
    die("No se proporcionó un ID de cliente válido.");
}





// Obtener datos del cliente específico
// Obtener datos del cliente específico
$soportes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes?select=*');
$proveedor_medios = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/proveedor_medios?select=*');
$url = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes?id_soporte=eq.$idCliente&select=*";
$cliente = makeRequest($url);
$soporte_medios = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/soporte_medios?select=*');
$medios = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Medios?select=*');
$proveedorS = makeRequest("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores?id_proveedor=eq.$idCliente&select=*");
// Verificar si se obtuvo el cliente
if (empty($cliente) || !isset($cliente[0])) {
    die("No se encontró el cliente con el ID proporcionado.");
}

$datosCliente = $cliente[0];

// Obtener productos asociados al cliente

if ($idCliente) {
  // Hacer la petición a la API Supabase para obtener las filas que coincidan con el id_soporte
  $url = 'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/proveedor_soporte?id_soporte=eq.' . $idCliente . '&select=*';

  // Configuración de cURL
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  // Agregar la clave API en el encabezado
  $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc'; // Reemplaza con tu clave API de Supabase
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "apikey: $apiKey",
      "Authorization: Bearer $apiKey"
  ));

  // Ejecutar la petición
  $response = curl_exec($ch);

  // Verificar errores de cURL
  if (curl_errno($ch)) {
    echo 'Error de cURL: ' . curl_error($ch);
}


$soporte_medios_data = json_decode($response, true);

// Cerrar cURL
curl_close($ch);



// Contar el número de filas devueltas
$countProveedores = count($soporte_medios_data);


// Extraer los id_proveedor únicos
$id_provedoresxx = array_unique(array_column($soporte_medios_data, 'id_proveedor'));

if (!empty($id_provedoresxx)) {
  // Convertir los ID a una cadena separada por comas para usarlos en la consulta
  $id_provedoresxx_str = implode(',', $id_provedoresxx);

  // No necesitas codificar la cadena aquí si ya está en formato adecuado para la consulta
  $proveedores_url = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores?id_proveedor=in.(1)";
  $proveedores4 = makeRequest($proveedores_url);
  $proveedores_data = $proveedores4; 
  // Depuración: var_dump en backend para $proveedores_data
  var_dump($proveedores_data);

  // Depuración: console.log en frontend para $proveedores_data
  echo "<script>console.log(" . json_encode($proveedores_data) . ");</script>";
} else {
  $proveedores_data = [];
}

  // Aquí puedes seguir con la lógica para mostrar los proveedores en la tabla
  // utilizando la variable $proveedores_data
} else {
  echo "El id_soporte no fue proporcionado.";
}



include '../componentes/header.php';
include '../componentes/sidebar.php';
?>
      <!-- Main Content -->
      <div class="main-content">
      
      <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>ListClientes.php">Ver Clientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $datosCliente['nombreIdentficiador'] ; ?></li>
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
                        <?php echo $datosCliente['nombreIdentficiador'] ; ?>
                      </div>
                      <div class="author-box-job">
                      <?php
    // Convertir la cadena de fecha y hora a un objeto DateTime
    $fecha = new DateTime($datosCliente['created_at']);
    
    // Formatear la fecha como deseas (en este caso, solo la fecha)
    echo 'Registrado el: '.$fecha->format('d-m-Y'); // Esto mostrará la fecha en formato AAAA-MM-DD
    ?>
                    
                    </div>
                    </div>
              
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Detalles del Soporte</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-start">
                        Razón Social
                        </span>
                        <span class="float-right text-muted">
                          <?php echo $datosCliente['razonSocial'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Nombre de Fantasía
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['nombreFantasia'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Nombre Identificador
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['nombreIdentficiador'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Rut
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['rut_soporte'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Giro 
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['giro'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                        Representante Legal
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['nombreRepresentanteLegal'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Dirección
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['direccion'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Región
                        </span>
                        <span class="float-right text-muted">
                         <?php echo $regionesMap[$datosCliente['id_region']] ?? ''; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Comuna
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $comunasMap[$datosCliente['id_comuna']] ?? ''; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Email
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['email'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Teléfono Celular
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['telCelular'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Teléfono Fijo
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosCliente['telFijo'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Medios 
                        </span>
                        <span class="float-right text-muted">
                        <?php
                                                            // Paso 1: Obtener todos los id_medios para un id_proveedor específico
                                                            $id_soporte = $datosCliente['id_soporte'];

                                                            // Realiza la solicitud para obtener los datos de la tabla proveedor_medios

                                                            $id_medios_array = [];
                                                            foreach ($soporte_medios as $fila) {
                                                                if ($fila['id_soporte'] == $id_soporte) {
                                                                    $id_medios_array[] = $fila['id_medio'];
                                                                }
                                                            }                 

                                                            $medios_nombres = [];
                                                            foreach ($medios as $medio) {
                                                                if (in_array($medio['id'], $id_medios_array)) {
                                                                    $medios_nombres[] = $medio['NombredelMedio'];
                                                                }
                                                            }

                                                            if (!empty($medios_nombres)) {
                                                                $medios_list = implode(" , ", $medios_nombres);
                                                                $tooltip_content = "<span class='float-right text-muted'>" . $medios_list . "</span>";
                                                            } else {
                                                                $tooltip_content = ""; // Puedes dejarlo vacío o agregar un mensaje como "No hay medios disponibles"
                                                            }
                                                            
                                                            // Paso 3: Mostrar los nombres en una lista tipo tooltip
                                                            ?>     
                        <?php echo $tooltip_content; ?>
                        </span>
                      </p>
                    </div>
                  </div>
                </div>
               
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                <table class="table table-striped" id="tableExportadora">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Medio</th>
            <th>Nombre Proveedores</th>
            <th>Razón Social</th>
            <th>Rut</th>
            <th>N° de Soportes</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($proveedores_data as $proveedorll): ?>
        <tr class="proveedor-row" data-proveedor-id="<?php echo $proveedorll['id_proveedor']; ?>">
            <td><i class="expand-icon fas fa-angle-right"></i></td>
            <td><?php echo $proveedorll['id_proveedor']; ?></td>
            <td>
                                                                                                        <?php
                                                            // Paso 1: Obtener todos los id_medios para un id_proveedor específico
                                                            $id_proveedorc = $proveedorll['id_proveedor'];

                                                            // Realiza la solicitud para obtener los datos de la tabla proveedor_medios

                                                            $id_medios_array = [];
                                                            foreach ($proveedor_medios as $fila) {
                                                                if ($fila['id_proveedor'] == $id_proveedorc) {
                                                                    $id_medios_array[] = $fila['id_medio'];
                                                                }
                                                            }                 

                                                            $medios_nombres = [];
                                                            foreach ($medios as $medio) {
                                                                if (in_array($medio['id'], $id_medios_array)) {
                                                                    $medios_nombres[] = $medio['NombredelMedio'];
                                                                }
                                                            }

                                                            if (!empty($medios_nombres)) {
                                                                $medios_list = implode("</li><li>", $medios_nombres);
                                                                $tooltip_content = "<ul><li>" . $medios_list . "</li></ul>";
                                                            } else {
                                                                $tooltip_content = ""; // Puedes dejarlo vacío o agregar un mensaje como "No hay medios disponibles"
                                                            }
                                                            
                                                            // Paso 3: Mostrar los nombres en una lista tipo tooltip
                                                            ?>   




                                                            <svg width="24" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo $tooltip_content; ?>" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="dist_marketing-btn-icon__AWP8I"><path fill-rule="evenodd" clip-rule="evenodd" d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24C18.6274 24 24 18.6274 24 12ZM13.0033 22.3936C12.574 22.8778 12.2326 23 12 23C11.7674 23 11.426 22.8778 10.9967 22.3936C10.5683 21.9105 10.1369 21.1543 9.75435 20.1342C9.3566 19.0735 9.03245 17.7835 8.81337 16.3341C9.8819 16.1055 10.9934 15.9922 12.1138 16.0004C13.1578 16.0081 14.1912 16.1211 15.1866 16.3341C14.9675 17.7835 14.6434 19.0735 14.2457 20.1342C13.8631 21.1543 13.4317 21.9105 13.0033 22.3936ZM15.3174 15.3396C14.2782 15.1229 13.2039 15.0084 12.1211 15.0004C10.9572 14.9919 9.7999 15.1066 8.68263 15.3396C8.58137 14.4389 8.51961 13.4874 8.50396 12.5H15.496C15.4804 13.4875 15.4186 14.4389 15.3174 15.3396ZM16.1609 16.5779C15.736 19.3214 14.9407 21.5529 13.9411 22.8293C16.6214 22.3521 18.9658 20.9042 20.5978 18.862C19.6345 18.0597 18.4693 17.3939 17.1586 16.9062C16.8326 16.7849 16.4997 16.6754 16.1609 16.5779ZM21.1871 18.0517C20.1389 17.1891 18.8906 16.4837 17.5074 15.969C17.1122 15.822 16.708 15.6912 16.2967 15.5771C16.411 14.5992 16.4798 13.5676 16.4962 12.5H22.9888C22.8973 14.5456 22.2471 16.4458 21.1871 18.0517ZM7.70333 15.5771C7.58896 14.5992 7.52024 13.5676 7.50384 12.5H1.01116C1.10267 14.5456 1.75288 16.4458 2.81287 18.0517C3.91698 17.1431 5.24216 16.4096 6.71159 15.8895C7.0368 15.7744 7.3677 15.6702 7.70333 15.5771ZM3.40224 18.862C5.03424 20.9042 7.37862 22.3521 10.0589 22.8293C9.05934 21.5529 8.26398 19.3214 7.83906 16.5779C7.57069 16.6552 7.3059 16.74 7.04526 16.8322C5.65305 17.325 4.41634 18.0173 3.40224 18.862ZM15.496 11.5H8.50396C8.51961 10.5126 8.58136 9.56113 8.68263 8.66039C9.84251 8.90232 11.0448 9.01653 12.2521 8.99807C13.2906 8.9822 14.3202 8.86837 15.3174 8.66039C15.4186 9.56113 15.4804 10.5126 15.496 11.5ZM9.75435 3.86584C9.3566 4.9265 9.03245 6.21653 8.81337 7.66594C9.92191 7.90306 11.0758 8.01594 12.2369 7.99819C13.2391 7.98287 14.2304 7.87047 15.1866 7.66594C14.9675 6.21653 14.6434 4.9265 14.2457 3.86584C13.8631 2.84566 13.4317 2.08954 13.0033 1.60643C12.574 1.12215 12.2326 1 12 1C11.7674 1 11.426 1.12215 10.9967 1.60643C10.5683 2.08954 10.1369 2.84566 9.75435 3.86584ZM16.4962 11.5C16.4798 10.4324 16.411 9.40077 16.2967 8.42286C16.6839 8.31543 17.0648 8.19328 17.4378 8.05666C18.848 7.54016 20.1208 6.82586 21.1871 5.94826C22.2471 7.55418 22.8973 9.4544 22.9888 11.5H16.4962ZM17.0939 7.11766C18.4298 6.62836 19.6178 5.95419 20.5978 5.13796C18.9658 3.09584 16.6214 1.64793 13.9411 1.17072C14.9407 2.44711 15.736 4.67864 16.1609 7.42207C16.4773 7.33102 16.7886 7.22949 17.0939 7.11766ZM7.33412 7.26641C7.50092 7.32131 7.66929 7.37321 7.83905 7.42207C8.26398 4.67864 9.05934 2.44711 10.0589 1.17072C7.37862 1.64793 5.03423 3.09584 3.40224 5.13796C4.48835 6.04266 5.82734 6.77048 7.33412 7.26641ZM7.02148 8.21629C5.4308 7.69274 3.99599 6.92195 2.81287 5.94826C1.75288 7.55418 1.10267 9.4544 1.01116 11.5H7.50384C7.52024 10.4324 7.58896 9.40077 7.70333 8.42286C7.47376 8.35918 7.24638 8.29031 7.02148 8.21629Z" fill="currentColor"></path></svg>


                                                        </td>
            <td><?php echo $proveedorll['nombreProveedor']; ?></td>
            <td><?php echo $proveedorll['razonSocial']; ?></td>
            <td><?php echo $proveedorll['rutProveedor']; ?></td>
            <td>
                <?php
                    $contador = 0;
                    foreach ($soportes as $soporte) {
                        if ($proveedorll['id_proveedor'] == $soporte['id_proveedor']) {
                            $contador++;
                        }
                    }
                    echo $contador;
                ?>
            </td>
            <td>
                <!-- Acciones -->
                <a class="btn btn-primary micono" href="views/viewProveedor.php?id_proveedor=<?php echo $proveedorll['id_proveedor']; ?>" data-toggle="tooltip" title="Ver Proveedor"><i class="fas fa-eye "></i></a>  
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#actualizarProveedor" data-idproveedor="<?php echo $proveedorll['id_proveedor']; ?>" onclick="loadProveedorData(this)"><i class="fas fa-pencil-alt"></i></button>
                <a class="btn btn-danger micono" href="#" onclick="confirmarEliminacion(<?php echo htmlspecialchars($proveedorll['id_proveedor']); ?>); return false;" data-toggle="tooltip" title="Eliminar Proveedor"><i class="fas fa-trash-alt "></i></a>
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