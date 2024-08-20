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
                      <table class="table table-striped" id="tableExportadora">
                        <thead>
                          <tr>
                            <th>
                              ID
                            </th>
                            <th>Nombre Contrato</th>
                            <th>Nombre Cliente</th>
                            <th>Producto</th>
                            <th>Proveedor</th>
                            <th>Medio</th>
                            <th>Forma de Pago</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr>
    <td>
    <?php echo "$id";?>
    </td>
    <td><?php echo "$nombreContrato";?></td>
    <td><?php echo "$nombreCliente";?></td>
    <td><?php echo "$nombreProducto";?></td>
    <td><?php echo "$nombreProveedor";?></td>
    <td><?php echo "$medios";?></td>
    <td><?php echo "$formaPago";?></td>
    <td><div class="alineado">
       <label class="custom-switch sino" data-toggle="tooltip" 
       title="<?php echo $contrato['estado'] ? 'Desactivar Contrato' : 'Activar Contrato'; ?>">
    <input type="checkbox" 
           class="custom-switch-input estado-switch3"
           data-id="<?php echo $contrato['id']; ?>" data-tipo="contrato" <?php echo $contrato['estado'] ? 'checked' : ''; ?>> <span class="custom-switch-indicator"></span>
</label>
    </div></td>
    <td>
                                                <a class="btn btn-primary micono" href="views/viewContrato.php?id=<?php echo $contrato['id']; ?>" data-toggle="tooltip" title="Ver Contrato"><i class="fas fa-eye "></i></a>
                                                <button type="button" class="btn btn-success micono" data-bs-toggle="modal" data-bs-target="#actualizarcontrato" data-idcontrato="<?php echo $contrato['id']; ?>"><i class="fas fa-pencil-alt"></i></button>


                                            

                                        
    </td>
</tr>
         
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
      