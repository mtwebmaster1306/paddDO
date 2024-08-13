<?php
// Iniciar sesión
session_start();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://baserow-production-9ab6.up.railway.app/api/database/rows/table/549/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Token nHPciD53K9SI883sLftNOUPQuaSWKNB0'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// Decodificar la respuesta JSON
$data = json_decode($response, true);   
include 'componentes/header.php';
include 'componentes/sidebar.php';
?>
<!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Listado de Contratos</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              ID
                            </th>
                            <th>Nombre Contrato</th>
                            <th>Nombre Cliente</th>
                            <th>Producto</th>
                            <th>Proveedor</th>
                            <th>Medio</th>
                            <th>Forma de Pago</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php include 'querys/qcontratos.php'; ?>
         
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
      <?php include 'componentes/settings.php'; ?>
      <?php include 'componentes/footer.php'; ?>
      