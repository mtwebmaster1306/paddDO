<?php
// Iniciar la sesión
session_start();

// Función para hacer peticiones cURL
include 'querys/qproveedor.php';

include 'componentes/header.php';
include 'componentes/sidebar.php';
?>
<style>
    .expand-icon {
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .expand-icon.open {
        transform: rotate(90deg);
    }
    .fade-in {
        animation: fadeIn 0.1s;
    }
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    .child-row {
        background-color: #f8f9fa;
        overflow: hidden;
       
    }
    .child-row.show {
        max-height: 1000px; /* Ajusta este valor según sea necesario */
    }
    .expand-icon.fas.fa-angle-down, .expand-icon.fas.fa-angle-right {
  font-size: 17px !important;
}
.sorting_1 {
  text-align: center !important;
}
.fas.fa-globe.mediow {
  color: #EF4D36;
  font-size: 20px;
}
.dist_marketing-btn-icon__AWP8I {
  color: red;
  width: 20px;
}
</style>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header milinea">
                            <div class="titulox"><h4>Listado de Proveedores</h4></div>
                            <div class="agregar"><button type="button" class="btn bn-padd micono" data-bs-toggle="modal" data-bs-target="#agregarProveedor"  ><i class="fas fa-plus-circle"></i> Agregar proveedor</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
        <?php foreach ($proveedores as $proveedor): ?>
        <tr class="proveedor-row" data-proveedor-id="<?php echo $proveedor['id_proveedor']; ?>">
            <td><i class="expand-icon fas fa-angle-right"></i></td>
            <td><?php echo $proveedor['id_proveedor']; ?></td>
            <td>
                                                                                                        <?php
                                                            // Paso 1: Obtener todos los id_medios para un id_proveedor específico
                                                            $id_proveedor = $proveedor['id_proveedor'];

                                                            // Realiza la solicitud para obtener los datos de la tabla proveedor_medios

                                                            $id_medios_array = [];
                                                            foreach ($proveedor_medios as $fila) {
                                                                if ($fila['id_proveedor'] == $id_proveedor) {
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
            <td><?php echo $proveedor['nombreProveedor']; ?></td>
            <td><?php echo $proveedor['razonSocial']; ?></td>
            <td><?php echo $proveedor['rutProveedor']; ?></td>
            <td>
                <?php
                    $contador = 0;
                    foreach ($soportes as $soporte) {
                        if ($proveedor['id_proveedor'] == $soporte['id_proveedor']) {
                            $contador++;
                        }
                    }
                    echo $contador;
                ?>
            </td>
            <td>
                <!-- Acciones -->
                <a class="btn btn-primary micono" href="views/viewProveedor.php?id_proveedor=<?php echo $proveedor['id_proveedor']; ?>" data-toggle="tooltip" title="Ver Proveedor"><i class="fas fa-eye "></i></a>  
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#actualizarProveedor" data-idproveedor="<?php echo $proveedor['id_proveedor']; ?>" onclick="loadProveedorData(this)"><i class="fas fa-pencil-alt"></i></button>
                <a class="btn btn-danger micono" href="#" onclick="confirmarEliminacion(<?php echo htmlspecialchars($proveedor['id_proveedor']); ?>); return false;" data-toggle="tooltip" title="Eliminar Proveedor"><i class="fas fa-trash-alt "></i></a>
            </td>
        </tr>
        <tr class="expandable-row" id="subtable-<?php echo $proveedor['id_proveedor']; ?>" style="display:none;">
            <td colspan="8">
                <!-- Subtabla --><div class="card-header milinea"><div class="titulox"><h4>Listado de Soportes</h4></div><div class="agregar"><button type="button" class="btn bn-padd micono" data-bs-toggle="modal" data-bs-target="#agregarSoportessss"  data-rso="<?php echo $proveedor['razonSocial']; ?>" data-nfo="<?php echo $proveedor['nombreFantasia']; ?>"              
                        data-rpo="<?php echo $proveedor['rutProveedor']; ?>"
                        data-gpo="<?php echo $proveedor['giroProveedor']; ?>"
                        data-nro="<?php echo $proveedor['nombreRepresentante']; ?>"            
                        data-rpoo="<?php echo $proveedor['rutRepresentante']; ?>"                     
                        data-dfo="<?php echo $proveedor['direccionFacturacion']; ?>"             
                        data-iro="<?php echo $proveedor['id_region']; ?>"   
                        data-ico="<?php echo $proveedor['id_comuna']; ?>"        
                        data-tco="<?php echo $proveedor['telCelular']; ?>" 
                        data-tfo="<?php echo $proveedor['telFijo']; ?>" 
                        data-elo="<?php echo $proveedor['email']; ?>" data-id="<?php echo $proveedor['id_proveedor']; ?>"><i class="fas fa-plus-circle"></i>  Crear Soporte</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarsoporteprov" data-id-proveedor="<?php echo $id_proveedor; ?>">
    <i class="fas fa-plus-circle"></i> <?php echo $id_proveedor; ?>  Agregar Soporte
</button>                    </div>
                       
                    </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Soporte</th>
                            <th>Nombre Identificador</th>
                            <th>Razón Social</th>
                            <th>Rut Soporte</th>
                            <th>Medios</th>
                            <th>Teléfono/Celular</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($soportes as $soporte): ?>
                            <?php if ($soporte['id_proveedor'] == $proveedor['id_proveedor']): ?>
                            <tr>
                                <td><?php echo $soporte['id_soporte']; ?></td>
                                <td><?php echo $soporte['nombreIdentficiador']; ?></td>
                                <td><?php echo $soporte['razonSocial']; ?></td>
                                <td><?php echo $soporte['rut_soporte']; ?></td>
                                <td>
                                                                                                        <?php
                                                            // Paso 1: Obtener todos los id_medios para un id_proveedor específico
                                                            $id_soporte = $soporte['id_soporte'];

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
                                                                $medios_list = implode("</li><li>", $medios_nombres);
                                                                $tooltip_content = "<ul><li>" . $medios_list . "</li></ul>";
                                                            } else {
                                                                $tooltip_content = ""; // Puedes dejarlo vacío o agregar un mensaje como "No hay medios disponibles"
                                                            }
                                                            
                                                            // Paso 3: Mostrar los nombres en una lista tipo tooltip
                                                            ?>   




                                                            <svg width="24" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo $tooltip_content; ?>" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="dist_marketing-btn-icon__AWP8I"><path fill-rule="evenodd" clip-rule="evenodd" d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24C18.6274 24 24 18.6274 24 12ZM13.0033 22.3936C12.574 22.8778 12.2326 23 12 23C11.7674 23 11.426 22.8778 10.9967 22.3936C10.5683 21.9105 10.1369 21.1543 9.75435 20.1342C9.3566 19.0735 9.03245 17.7835 8.81337 16.3341C9.8819 16.1055 10.9934 15.9922 12.1138 16.0004C13.1578 16.0081 14.1912 16.1211 15.1866 16.3341C14.9675 17.7835 14.6434 19.0735 14.2457 20.1342C13.8631 21.1543 13.4317 21.9105 13.0033 22.3936ZM15.3174 15.3396C14.2782 15.1229 13.2039 15.0084 12.1211 15.0004C10.9572 14.9919 9.7999 15.1066 8.68263 15.3396C8.58137 14.4389 8.51961 13.4874 8.50396 12.5H15.496C15.4804 13.4875 15.4186 14.4389 15.3174 15.3396ZM16.1609 16.5779C15.736 19.3214 14.9407 21.5529 13.9411 22.8293C16.6214 22.3521 18.9658 20.9042 20.5978 18.862C19.6345 18.0597 18.4693 17.3939 17.1586 16.9062C16.8326 16.7849 16.4997 16.6754 16.1609 16.5779ZM21.1871 18.0517C20.1389 17.1891 18.8906 16.4837 17.5074 15.969C17.1122 15.822 16.708 15.6912 16.2967 15.5771C16.411 14.5992 16.4798 13.5676 16.4962 12.5H22.9888C22.8973 14.5456 22.2471 16.4458 21.1871 18.0517ZM7.70333 15.5771C7.58896 14.5992 7.52024 13.5676 7.50384 12.5H1.01116C1.10267 14.5456 1.75288 16.4458 2.81287 18.0517C3.91698 17.1431 5.24216 16.4096 6.71159 15.8895C7.0368 15.7744 7.3677 15.6702 7.70333 15.5771ZM3.40224 18.862C5.03424 20.9042 7.37862 22.3521 10.0589 22.8293C9.05934 21.5529 8.26398 19.3214 7.83906 16.5779C7.57069 16.6552 7.3059 16.74 7.04526 16.8322C5.65305 17.325 4.41634 18.0173 3.40224 18.862ZM15.496 11.5H8.50396C8.51961 10.5126 8.58136 9.56113 8.68263 8.66039C9.84251 8.90232 11.0448 9.01653 12.2521 8.99807C13.2906 8.9822 14.3202 8.86837 15.3174 8.66039C15.4186 9.56113 15.4804 10.5126 15.496 11.5ZM9.75435 3.86584C9.3566 4.9265 9.03245 6.21653 8.81337 7.66594C9.92191 7.90306 11.0758 8.01594 12.2369 7.99819C13.2391 7.98287 14.2304 7.87047 15.1866 7.66594C14.9675 6.21653 14.6434 4.9265 14.2457 3.86584C13.8631 2.84566 13.4317 2.08954 13.0033 1.60643C12.574 1.12215 12.2326 1 12 1C11.7674 1 11.426 1.12215 10.9967 1.60643C10.5683 2.08954 10.1369 2.84566 9.75435 3.86584ZM16.4962 11.5C16.4798 10.4324 16.411 9.40077 16.2967 8.42286C16.6839 8.31543 17.0648 8.19328 17.4378 8.05666C18.848 7.54016 20.1208 6.82586 21.1871 5.94826C22.2471 7.55418 22.8973 9.4544 22.9888 11.5H16.4962ZM17.0939 7.11766C18.4298 6.62836 19.6178 5.95419 20.5978 5.13796C18.9658 3.09584 16.6214 1.64793 13.9411 1.17072C14.9407 2.44711 15.736 4.67864 16.1609 7.42207C16.4773 7.33102 16.7886 7.22949 17.0939 7.11766ZM7.33412 7.26641C7.50092 7.32131 7.66929 7.37321 7.83905 7.42207C8.26398 4.67864 9.05934 2.44711 10.0589 1.17072C7.37862 1.64793 5.03423 3.09584 3.40224 5.13796C4.48835 6.04266 5.82734 6.77048 7.33412 7.26641ZM7.02148 8.21629C5.4308 7.69274 3.99599 6.92195 2.81287 5.94826C1.75288 7.55418 1.10267 9.4544 1.01116 11.5H7.50384C7.52024 10.4324 7.58896 9.40077 7.70333 8.42286C7.47376 8.35918 7.24638 8.29031 7.02148 8.21629Z" fill="currentColor"></path></svg>


                                                        </td>
                                <td><?php echo $soporte['telCelular']; ?></td>
                                <td>
                <!-- Acciones -->
                <a class="btn btn-primary micono" href="views/viewSoporte.php?id_soporte=<?php echo $soporte['id_soporte']; ?>" data-toggle="tooltip" title="Ver Soporte"><i class="fas fa-eye "></i></a>  
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#actualizarSoporte" data-id-soporte="<?php echo htmlspecialchars($soporte['id_soporte']); ?>" data-idproveedor="<?php echo $proveedor['id_proveedor']; ?>" onclick="loadProveedorDataSoporte(this)"><i class="fas fa-pencil-alt"></i></button>
                <a class="btn btn-danger micono" href="#" onclick="confirmarEliminacionSoporte(<?php echo htmlspecialchars($soporte['id_soporte']); ?>); return false;" data-toggle="tooltip" title="Eliminar Proveedor"><i class="fas fa-trash-alt "></i></a>
            </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>document.addEventListener('DOMContentLoaded', function() {
    var expandIcons = document.querySelectorAll('.expand-icon');
    expandIcons.forEach(function(icon) {
        icon.addEventListener('click', function() {
            var parentRow = this.closest('tr');
            var proveedorId = parentRow.getAttribute('data-proveedor-id');
            var subtable = document.getElementById('subtable-' + proveedorId);

            if (subtable.style.display === 'none' || subtable.style.display === '') {
                subtable.style.display = 'table-row';
                this.classList.remove('fa-angle-right');
                this.classList.add('fa-angle-down');
            } else {
                subtable.style.display = 'none';
                this.classList.remove('fa-angle-down');
                this.classList.add('fa-angle-right');
            }
        });
    });
});</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var table;
    var medios = []; // Variable global para almacenar los medios

    // Obtén los medios de forma global al cargar la página
    $.ajax({
        url: 'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Medios?select=*',
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
        },
        success: function(response) {
            medios = response; // Guarda los datos de medios en la variable global
        },
        error: function(xhr, status, error) {
            console.error("Error al obtener medios:", error);
        }
    });

    // Inicializa la tabla DataTable si no está ya inicializada
    if ($.fn.DataTable.isDataTable('#tableExportadora')) {
        table = $('#tableExportadora').DataTable();
    } else {
        table = $('#tableExportadora').DataTable({
            // Aquí puedes añadir opciones de configuración si es necesario
        });
    }

    $('#tableExportadora').on('click', 'tr.proveedor-row .expand-icon', function(e) {
        e.stopPropagation(); // Previene la propagación del evento

        var icon = $(this);
        var tr = icon.closest('tr.proveedor-row');
        var row = table.row(tr);
        var proveedorId = tr.data('proveedor-id');

        if (row.child.isShown()) {
            // Cerrar esta fila
            icon.removeClass('fa-angle-down').addClass('fa-angle-right');
            row.child().find('.child-row').slideUp(300, function() {
                row.child.hide();
                tr.removeClass('shown');
            });
        } else {
            // Cerrar otras filas abiertas
            table.rows().every(function() {
                if (this.child.isShown()) {
                    var r = $(this.node());
                    r.find('.expand-icon').removeClass('fa-angle-down').addClass('fa-angle-right');
                    this.child().find('.child-row').slideUp(300, function() {
                        this.child.hide();
                        r.removeClass('shown');
                    }.bind(this));
                }
            });

            // Abrir esta fila
            icon.removeClass('fa-angle-right').addClass('fa-angle-down');
            if (row.child() && row.child().length) {
                // Si el contenido hijo ya existe, solo mostrarlo
                row.child.show();
                row.child().find('.child-row').slideDown(300, function() {
                    tr.addClass('shown');
                });
            } else {
                // Si el contenido hijo no existe, cargarlo
                $.ajax({
                    url: 'get_soportes.php',
                    method: 'GET',
                    data: { proveedor_id: proveedorId },
                    success: function(response) {
                        var soportes = JSON.parse(response);
                        var childContent = $('<div class="child-row" style="display: none;">');
                        formatSoportes(soportes, proveedorId).then(function(html) {
                            childContent.html(html);
                            row.child(childContent).show();
                            childContent.slideDown(300, function() {
                                tr.addClass('shown');
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al obtener soportes:", error);
                    }
                });
            }
        }
    });

    // Función para obtener los nombres de medios asociados a un soporte
    function getMediosNombres(soporteId) {
        return $.ajax({
            url: 'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/soporte_medios?select=*&id_soporte=eq.' + soporteId,
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
            }
        }).then(function(medios_response) {
            var medios_nombres = [];
            for (var j = 0; j < medios_response.length; j++) {
                var medio = medios.find(function(m) { return m.id === medios_response[j].id_medio; });
                if (medio) {
                    medios_nombres.push(medio.NombredelMedio);
                }
            }
            return medios_nombres;
        });
    }

    // Función para formatear los soportes y medios asociados
    
</script>

//Modal Edit Proveedor
<div class="modal fade" id="actualizarProveedor" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            
              <div class="modal-body">
                 <!-- Alerta para mostrar el resultado de la actualización -->
                 <div id="updateAlert" class="alert" style="display:none;" role="alert"></div>
                            
                 
                 <form id="formactualizarproveedor">
                 <!-- Campos del formulario -->
                    <div>
                        <h3 class="titulo-registro mb-3">Actualizar Proveedor</h3>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Nombre Identificador</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user-circle"></i></span>
                                        </div>
                                        <input type="hidden" name="idprooo">
                                        <input class="form-control" placeholder="Nombre Identificador" name="nombreIdentificadorp">
                                    </div>
                                    <label class="labelforms" for="codigo">Medios</label>
                                    <div class="input-group dropdown" id="dropdown1">
                                        <div class="sell input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <div class="selected-options" onclick="toggleDropdown()"></div>
                                        <button type="button" class="dropdown-button" style="display:none;">Select Medios</button>
                                        <div class="dropdown-content">
                                            <?php foreach ($medios as $medio) : ?>
                                                <label>
                                                    <input type="checkbox" name="id_medios[]" value="<?php echo $medio['id']; ?>">
                                                    <?php echo $medio['NombredelMedio']; ?>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <label class="labelforms" for="codigo">Nombre de Proveedor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre de Proveedor" name="nombreProveedorp">
                                    </div>
                                    <label class="labelforms" for="codigo">Nombre Representante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre Representante" name="nombreRepresentantep">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Rut Proveedor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Rut Proveedor" name="rutProveedorp">
                                    </div>
                                    <label class="labelforms" for="codigo">Giro Proveedor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-suitcase"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Giro Proveedor" name="giroProveedorp">
                                    </div>
                                    <label class="labelforms" for="codigo">Nombre de Fantasía</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hand-spock"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasiap">
                                    </div>
                                    <label class="labelforms" for="codigo">Rut Representante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Rut Representante" name="rutRepresentantep">
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
                                    <label for="codigo">Razón Social</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Razón Social" name="razonSocialp">
                                    </div>
                                    <label class="labelforms" for="codigo">Región</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <select class="sesel form-select" name="id_regionp" id="region" required>
                                            <?php foreach ($regiones as $regione) : ?>
                                                <option value="<?php echo $regione['id']; ?>"><?php echo $regione['nombreRegion']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="labelforms" for="codigo">Teléfono celular</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Teléfono celular" name="telCelularp">
                                    </div>
                                    <label class="labelforms" for="codigo">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" name="emailp">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Dirección Facturación</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-building"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Dirección Facturación" name="direccionFacturacionp">
                                    </div>
                                    <label class="labelforms" for="codigo">Comuna</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <select class="sesel form-select" name="id_comunap" id="comuna" required>
                                            <?php foreach ($comunas as $comuna) : ?>
                                                <option value="<?php echo $comuna['id_comuna']; ?>" data-region="<?php echo $comuna['id_region']; ?>">
                                                    <?php echo $comuna['nombreComuna']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="labelforms" for="codigo">Teléfono fijo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Teléfono fijo" name="telFijop">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="titulo-registro mb-3">Otros datos</h3>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="codigo">Bonifiación por año %</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Bonifiación por año %" name="bonificacion_anop">
                                    </div>
                                </div>
                            </div>
                            <div class="col" id="moneda-container">
                                <div class="form-group">
                                    <label for="codigo">Escala de rango</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chart-bar"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Escala de rango" name="escala_rangop">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary btn-lg rounded-pill" type="submit" id="actualizarProveedor">
                            <span class="btn-txt">Guardar Proveedor</span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                        </button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
// MODAL ACTUALIZAR SOPORTE
<div class="modal fade" id="actualizarSoporte" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Alerta para mostrar el resultado de la actualización -->
                <div id="updateAlert" class="alert" style="display:none;" role="alert"></div>

                <form id="formularioactualizarSoporte">
                    <!-- Campos del formulario -->
                    <div>
                        <h3 class="titulo-registro mb-3">Actualizar Soporte</h3>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Nombre Identificador</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user-circle"></i></span>
                                        </div>
                                        <input type="hidden" name="rutProveedorx">
                                        <input class="form-control" placeholder="Nombre Identificador" name="nombreIdentificadorx">
                                    </div>
                                   
                                    
                                    <label class="labelforms" for="codigo">Nombre Representante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre Representante" name="nombreRepresentantex">
                                    </div>
                                    <label class="labelforms" for="codigo">Medios</label>
                                    <div class="input-group dropdown" id="dropdown2">
                                        <div class="sell input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <div class="selected-options" onclick="toggleDropdown()"></div>
                                        <button type="button" class="dropdown-button" style="display:none;">Select Medios</button>
                                        <div class="dropdown-content">
                                            <?php foreach ($medios as $medio) : ?>
                                                <label>
                                                    <input type="checkbox" name="id_medios[]" value="<?php echo $medio['id']; ?>">
                                                    <?php echo $medio['NombredelMedio']; ?>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Rut Soporte</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Rut Soporte" name="rutSoporte">
                                    </div>
                                    <label class="labelforms" for="codigo">Giro Soporte</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-suitcase"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Giro Proveedor" name="giroProveedorx">
                                    </div>
                                    <label class="labelforms" for="codigo">Nombre de Fantasía</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hand-spock"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasiax">
                                    </div>
                                    <label class="labelforms" for="codigo">Rut Representante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Rut Representante" name="rutRepresentantex">
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
                                    <label for="codigo">Razón Social</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Razón Social" name="razonSocialx">
                                    </div>
                                    <label class="labelforms" for="codigo">Región</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <select class="sesel form-select" name="id_regionx" id="region" required>
                                            <?php foreach ($regiones as $regione) : ?>
                                                <option value="<?php echo $regione['id']; ?>"><?php echo $regione['nombreRegion']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="labelforms" for="codigo">Teléfono celular</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Teléfono celular" name="telCelularx">
                                    </div>
                                    <label class="labelforms" for="codigo">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" name="emailx">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Dirección Facturación</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-building"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Dirección Facturación" name="direccionx">
                                    </div>
                                    <label class="labelforms" for="codigo">Comuna</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <select class="sesel form-select" name="id_comunax" id="comuna" required>
                                            <?php foreach ($comunas as $comuna) : ?>
                                                <option value="<?php echo $comuna['id_comuna']; ?>" data-region="<?php echo $comuna['id_region']; ?>">
                                                    <?php echo $comuna['nombreComuna']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="labelforms" for="codigo">Teléfono fijo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Teléfono fijo" name="telFijox">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="titulo-registro mb-3">Otros datos</h3>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="codigo">Bonifiación por año %</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Bonifiación por año %" name="bonificacion_anox">
                                    </div>
                                </div>
                            </div>
                            <div class="col" id="moneda-container">
                                <div class="form-group">
                                    <label for="codigo">Escala de rango</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chart-bar"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Escala de rango" name="escala_rangox">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn bn-padd micono" type="submit" id="actualizarProveedor">
                            <span class="btn-txt">Guardar Soporte</span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

//fin editar modal



//fin editar modal



//Agregar Proveedor
<div class="modal fade" id="agregarProveedor" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Alerta para mostrar el resultado de la actualización -->
                <div id="updateAlert" class="alert" style="display:none;" role="alert"></div>

                <form id="formularioAgregarProveedor">
                    <!-- Campos del formulario -->
                    <div>
                        <h3 class="titulo-registro mb-3">Agregar Proveedor</h3>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Nombre Identificador</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user-circle"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre Identificador" name="nombreIdentificador">
                                    </div>
                                    <label class="labelforms" for="codigo">Medios</label>
                                    <div class="input-group dropdown" id="dropdown1">
                                        <div class="sell input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <div class="selected-options" onclick="toggleDropdown()"></div>
                                        <button type="button" class="dropdown-button" style="display:none;">Select Medios</button>
                                        <div class="dropdown-content">
                                            <?php foreach ($medios as $medio) : ?>
                                                <label>
                                                    <input type="checkbox" name="id_medios[]" value="<?php echo $medio['id']; ?>">
                                                    <?php echo $medio['NombredelMedio']; ?>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <label class="labelforms" for="codigo">Nombre de Proveedor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre de Proveedor" name="nombreProveedor">
                                    </div>
                                    <label class="labelforms" for="codigo">Nombre Representante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre Representante" name="nombreRepresentante">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Rut Proveedor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Rut Proveedor" name="rutProveedor">
                                    </div>
                                    <label class="labelforms" for="codigo">Giro Proveedor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-suitcase"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Giro Proveedor" name="giroProveedor">
                                    </div>
                                    <label class="labelforms" for="codigo">Nombre de Fantasía</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hand-spock"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasia">
                                    </div>
                                    <label class="labelforms" for="codigo">Rut Representante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Rut Representante" name="rutRepresentante">
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
                                    <label for="codigo">Razón Social</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Razón Social" name="razonSocial">
                                    </div>
                                    <label class="labelforms" for="codigo">Región</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <select class="sesel form-select" name="id_region" id="region" required>
                                            <?php foreach ($regiones as $regione) : ?>
                                                <option value="<?php echo $regione['id']; ?>"><?php echo $regione['nombreRegion']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="labelforms" for="codigo">Teléfono celular</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Teléfono celular" name="telCelular">
                                    </div>
                                    <label class="labelforms" for="codigo">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="codigo">Dirección Facturación</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-building"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Dirección Facturación" name="direccionFacturacion">
                                    </div>
                                    <label class="labelforms" for="codigo">Comuna</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <select class="sesel form-select" name="id_comuna" id="comuna" required>
                                            <?php foreach ($comunas as $comuna) : ?>
                                                <option value="<?php echo $comuna['id_comuna']; ?>" data-region="<?php echo $comuna['id_region']; ?>">
                                                    <?php echo $comuna['nombreComuna']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="labelforms" for="codigo">Teléfono fijo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Teléfono fijo" name="telFijo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="titulo-registro mb-3">Otros datos</h3>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="codigo">Bonifiación por año %</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Bonifiación por año %" name="bonificacion_ano">
                                    </div>
                                </div>
                            </div>
                            <div class="col" id="moneda-container">
                                <div class="form-group">
                                    <label for="codigo">Escala de rango</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chart-bar"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Escala de rango" name="escala_rango">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary btn-lg rounded-pill" type="button" id="actualizarProveedor">
                            <span class="btn-txt">Guardar Proveedor</span>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

//fin editar modal

//Modal agregar soporte
<div class="modal fade" id="agregarsoporteprov" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Alerta para mostrar el resultado de la actualización -->
                <div id="updateAlert" class="alert" style="display:none;" role="alert"></div>
                
                <!-- Campo para mostrar el id_proveedor -->
                <input class="form-control" placeholder="Prueba de id " name="pruebaid" id="pruebaid">
                
                <form id="formagregarsoporte">
                    <div class="form-group">
                        <label for="soporteSelect">Selecciona un Soporte</label>
                        <select class="form-control" id="soporteSelect" name="id_soporte">
                            <!-- Opciones se llenarán dinámicamente -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Soporte</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Script para manejar el modal y cargar los soportes
    document.addEventListener('DOMContentLoaded', function () {
    $('#agregarsoporteprov').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idProveedor = button.data('id-proveedor');
        console.log("ID Proveedor:", idProveedor);

        var inputPrueba = document.getElementById('pruebaid');
        inputPrueba.value = idProveedor;

        // Realizar la petición para obtener todos los soportes vinculados al proveedor actual
        fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/proveedor_soporte?select=id_soporte&id_proveedor=eq.${idProveedor}`, {
            headers: {
                'apikey': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
        'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
                  }
        })
        .then(response => response.json())
        .then(proveedor_soportes => {
            if (!proveedor_soportes || proveedor_soportes.length === 0) {
                console.error("No se encontraron soportes vinculados.");
                var vinculados_str = '';
            } else {
                var vinculados = proveedor_soportes.map(soporte => soporte.id_soporte);
                var vinculados_str = vinculados.filter(id => id).join(','); // Filtrar valores vacíos
            }

            // Solo hacer la petición si vinculados_str no está vacío
            if (vinculados_str) {
                // Realizar la petición para obtener los soportes que no están vinculados a este proveedor
                fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes?id_soporte=not.in.(${vinculados_str})&select=*`, {
                    headers: {
                        'apikey': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
        'Authorization': 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
                    }
                })
                .then(response => response.json())
                .then(soportes_no_vinculados => {
                    console.log(soportes_no_vinculados);

                    var soporteSelect = document.getElementById('soporteSelect');
                    console.log(soporteSelect);

                    soporteSelect.innerHTML = '';

                    if (soportes_no_vinculados && soportes_no_vinculados.length > 0) {
                        soportes_no_vinculados.forEach(function (soporte) {
                            console.log(soporte);
                            var option = document.createElement('option');
                            option.value = soporte.id_soporte;
                            option.textContent = soporte.nombreIdentficiador;
                            soporteSelect.appendChild(option);
                        });
                    } else {
                        console.warn("No se encontraron soportes no vinculados.");
                    }
                })
                .catch(error => console.error("Error al obtener soportes no vinculados:", error));
            } else {
                console.warn("No hay soportes vinculados. No se realizará la segunda solicitud.");
            }
        })
        .catch(error => console.error("Error al obtener soportes vinculados:", error));
    });
    document.getElementById('formagregarsoporte').addEventListener('submit', function (event) {
    event.preventDefault();

    var idProveedor = document.getElementsByName('pruebaid')[0].value;
    var idSoporte = document.getElementById('soporteSelect').value;

    if (!idProveedor || !idSoporte) {
        console.error("ID Proveedor o ID Soporte no válidos.");
        return;
    }

    fetch('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/proveedor_soporte', {
        method: 'POST',
        headers: {
                    "Content-Type": "application/json",
                    "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
                },
        body: JSON.stringify({
            id_proveedor: idProveedor,
            id_soporte: idSoporte
        })
    })
    .then(response => {
        console.log('Código de estado:', response.status); // Imprime el código de estado
        return response.text().then(text => {
            if (response.ok) {
                
                alert("Registro correcto");
                location.reload();
                try {
                    return JSON.parse(text); // Intenta parsear el texto como JSON
                } catch (error) {
                    throw new Error('Respuesta no es JSON válido: ' + text);
                }
            } else {
                throw new Error(`Error ${response.status}: ${text}`);
            }
        });
    })
    .then(data => {
        console.log("Soporte registrado exitosamente:", data);
        // Puedes mostrar un mensaje de éxito o cerrar el modal aquí
        $('#agregarsoporteprov').modal('hide');
    })
    .catch(error => {
        console.error("Error al registrar el soporte:", error.message);
        // Puedes mostrar un mensaje de error aquí
    });
});
});
</script>
//MODAL Crear SOPORTESS

<div class="modal fade" id="agregarSoportessss" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
     
            <div class="modal-body">
                <form id="formualarioSoporte">
                    <!-- Campo oculto para el ID -->
                    <input type="hidden"  name="id_proveedor" id="id_proveedor">
                    <!-- Campos del formulario -->
                    <h3 class="titulo-registro mb-3">Agregar Soporte</h3>
                    <div class="row">
                        <div class="col-6">
                        <div class="form-group">
                                    <label for="codigo">Nombre Identificador</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user-circle"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre Identificador" name="nombreIdentficiador" required>
                                    </div>
                        </div>
                              
                               
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                          <label  for="codigo">Medios</label>
<div class="input-group dropdown" id="dropdown2">
    <div class="sell input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    <div class="selected-options" onclick="toggleDropdown()"></div>
    <button type="button" class="dropdown-button" style="display:none;">Select Medios</button>
    <div class="dropdown-content">
        <?php foreach ($medios as $medio) : ?>
            <label>
                <input type="checkbox" name="id_medios[]" value="<?php echo $medio['id']; ?>">
                <?php echo $medio['NombredelMedio']; ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>
</div>
                    </div>
                    <div class="row"><label class="opeo"><input type="checkbox" name="revision"> <span>Usar los mismos datos del proveedor</span></label></div>
                   <div class="checklust">
                   <div class="row ">
                        <div class="col-6">
                        <div class="form-group">
                        <label  for="codigo">Razón Social</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Razón Social" name="razonSocial">
                                    </div>
                                    <label class="labelforms" for="codigo">Rut</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Rut" name="rut_soporte" required>
                                    </div>
                                    <label class="labelforms" for="codigo">Nombre Representante Legal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre Representante Legal" name="nombreRepresentanteLegal" required>
                                    </div>  
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                        <label  for="codigo">Nombre de Fantasía</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hand-spock"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasia" required>
                                    </div>
                                    <label class="labelforms"  for="codigo">Giro</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-suitcase"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Giro" name="giro" required>
                                    </div>
                                    <label class="labelforms" for="codigo">Rut Representante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Rut Representante" name="rutRepresentante" required>
                                    </div>
                                </div></div>
                    </div>
                    <div>
                        <h3 class="titulo-registro mb-3">Datos de facturación</h3>
                        <div class="row">
                        <div class="col-6">

                        <div class="form-group">
                        <label  for="codigo">Dirección Facturación</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-building"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Dirección Facturación" name="direccion">
                                    </div>
                                    <label class="labelforms" for="codigo">Región</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <select class="sesel form-select" name="id_region" id="region" required>
                                    <?php foreach ($regiones as $regione) : ?>
                                        <option value="<?php echo $regione['id']; ?>"><?php echo $regione['nombreRegion']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                    </div>
                                    <label class="labelforms" for="codigo">Teléfono celular</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Teléfono celular" name="telCelular" required>
                                    </div>
                                    </div></div>
                        <div class="col-6">

                        <div class="form-group">
                        <label  for="codigo">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" name="email">
                                    </div>   
                                    <label class="labelforms" for="codigo">Comuna</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <select class="sesel form-select" name="id_comuna" id="comuna" required>
                                <?php foreach ($comunas as $comuna) : ?>
                                    <option value="<?php echo $comuna['id_comuna']; ?>" data-region="<?php echo $comuna['id_region']; ?>">
                                        <?php echo $comuna['nombreComuna']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                                    </div> 
                                    <label class="labelforms"  for="codigo">Teléfono fijo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Teléfono fijo" name="telFijo" required>
                                    </div>   



                            
                           
                                
                        </div></div>
                    </div>
                   </div>
                    
                    </div>
                    <div>
                        <h3 class="titulo-registro mb-3">Otros datos</h3>


                                  

                        <input name="razonsoculto" type="hidden">
                        <input name="nombref" type="hidden">
                        <input name="rutt" type="hidden">
                        <input name="giroo" type="hidden">
                        <input name="nombreRepesentanteO" type="hidden">
                        <input name="rutRepresent" type="hidden">
                        <input name="direcciono" type="hidden">
                        <input name="regiono" type="hidden">
                        <input name="comunao" type="hidden">
                        <input name="telCelularo" type="hidden">
                        <input name="telFijoo" type="hidden">
                        <input name="emailO" type="hidden">
                        <div class="row">
                            <div class="col">
                            <div class="form-group">
                        <label  for="codigo">Bonificación por año %</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Bonificación por año %" name="bonificacion_ano" required>
                                    </div>  </div>
                        
                            </div>
                            <div class="col" id="moneda-container">
                            <div class="form-group">
                        <label  for="codigo">Escala de rango</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Escala de rango" name="escala_rango" required>
                                    </div>  </div>
                               
                            </div>
                        </div>
                    </div> 
                    <button type="submit" class="loiloi" id="provprov">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>






<script src="<?php echo $ruta; ?>assets/js/agregarsoporte.js"></script>
<script src="<?php echo $ruta; ?>assets/js/actualizarproveedor.js"></script>
<script src="<?php echo $ruta; ?>assets/js/agregarproveedor.js"></script>
<script src="<?php echo $ruta; ?>assets/js/actualizarsoporte.js"></script>




<script>
function setupDropdown(dropdownId) {
    const dropdown = document.querySelector(`#${dropdownId}`);
    const dropdownButton = dropdown.querySelector('.dropdown-button');
    const dropdownContent = dropdown.querySelector('.dropdown-content');
    const selectedOptionsContainer = dropdown.querySelector('.selected-options');
    const sellElement = dropdown.querySelector('.sell'); // Selecciona el elemento con la clase 'sell'

    // Manejador de evento para mostrar/ocultar el contenido del dropdown
    function toggleDropdown() {
        dropdown.classList.toggle('open');
        dropdownContent.style.display = dropdown.classList.contains('open') ? 'grid' : 'none';
    }

    // Mostrar el dropdown al hacer clic en el contenedor de opciones seleccionadas
    selectedOptionsContainer.addEventListener('click', function(event) {
        event.stopPropagation();
        toggleDropdown();
    });

    // Mostrar el dropdown al hacer clic en el botón
    dropdownButton.addEventListener('click', function(event) {
        event.stopPropagation();
        toggleDropdown();
    });

    // Cerrar el dropdown al hacer clic fuera de él
    window.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('open');
            dropdownContent.style.display = 'none';
        }
    });

    // Manejador para actualizar las opciones seleccionadas
    dropdown.querySelectorAll('.dropdown-content input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function(event) {
            event.stopPropagation();
            updateSelectedOptions();
        });
    });

    // Función para actualizar el contenedor de opciones seleccionadas
    function updateSelectedOptions() {
        selectedOptionsContainer.innerHTML = ''; // Limpia las opciones seleccionadas

        const selectedCheckboxes = dropdown.querySelectorAll('.dropdown-content input[type="checkbox"]:checked');
        if (selectedCheckboxes.length > 0) {
            dropdownButton.style.display = 'none';
            sellElement.style.display = 'none';
            selectedOptionsContainer.style.display = 'flex'; // Mostrar el contenedor si hay opciones seleccionadas
        } else {
            dropdownButton.style.display = 'block';
            sellElement.style.display = 'block';
            selectedOptionsContainer.style.display = 'none'; // Ocultar el contenedor si no hay opciones seleccionadas
        }

        selectedCheckboxes.forEach(checkbox => {
            const label = checkbox.parentElement.textContent.trim();
            const selectedOption = document.createElement('span');
            selectedOption.className = 'selected-option';
            selectedOption.textContent = label;
            selectedOption.dataset.value = checkbox.value;

            const removeButton = document.createElement('button');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', function(event) {
                event.stopPropagation();
                checkbox.checked = false;
                updateSelectedOptions();
            });

            selectedOption.appendChild(removeButton);
            selectedOptionsContainer.appendChild(selectedOption);
        });
    }

    // Actualizar la vista de las opciones seleccionadas en la inicialización
    updateSelectedOptions();
}

// Inicializa los dropdowns
setupDropdown('dropdown1');
setupDropdown('dropdown2');
setupDropdown('dropdown3');
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('agregarSoportessss');

    modal.addEventListener('show.bs.modal', (event) => {
        // Obtener el botón que abrió el modal
        const button = event.relatedTarget;

        // Asignar el ID del proveedor al input oculto en el modal
        const idProveedor = button.getAttribute('data-id');
        const idInput = modal.querySelector('#id_proveedor');
        idInput.value = idProveedor;

        // Asignar los valores de los atributos data-* a los inputs ocultos en el modal
        modal.querySelector('input[name="razonsoculto"]').value = button.getAttribute('data-rso');
        modal.querySelector('input[name="nombref"]').value = button.getAttribute('data-nfo');
        modal.querySelector('input[name="rutt"]').value = button.getAttribute('data-rpo');
        modal.querySelector('input[name="giroo"]').value = button.getAttribute('data-gpo');
        modal.querySelector('input[name="nombreRepesentanteO"]').value = button.getAttribute('data-nro');
        modal.querySelector('input[name="rutRepresent"]').value = button.getAttribute('data-rpoo');
        modal.querySelector('input[name="direcciono"]').value = button.getAttribute('data-dfo');
        modal.querySelector('input[name="regiono"]').value = button.getAttribute('data-iro');
        modal.querySelector('input[name="comunao"]').value = button.getAttribute('data-ico');
        modal.querySelector('input[name="telCelularo"]').value = button.getAttribute('data-tco');
        modal.querySelector('input[name="telFijoo"]').value = button.getAttribute('data-tfo');
        modal.querySelector('input[name="emailO"]').value = button.getAttribute('data-elo');
    });
    const checkbox = modal.querySelector('input[name="revision"]');
    const checklustElements = modal.querySelectorAll('.checklust');
    const form = document.getElementById('formualarioSoporte');

    const toggleChecklustVisibility = () => {
        checklustElements.forEach(element => {
            element.style.display = checkbox.checked ? 'none' : 'grid';
        });
    };

    // Escuchar el evento 'change' en el checkbox
    checkbox.addEventListener('change', toggleChecklustVisibility);
   checkbox.addEventListener('change', function() {
        if (this.checked) {
            checklustElements.forEach(el => el.style.display = 'none');
            form.querySelectorAll('.form-control').forEach(input => input.removeAttribute('required'));
        } else {
            checklustElements.forEach(el => el.style.display = '');
            form.querySelectorAll('.form-control').forEach(input => input.setAttribute('required', 'required'));
        }
    });

    form.addEventListener('submit', submitFormSoporte);
    // Inicializar la visibilidad al cargar el modal
    modal.addEventListener('show.bs.modal', () => {
        toggleChecklustVisibility();
    });
});
</script>
<script>
function getSoporteData(idSoporte) {
    var soportesMap = <?php echo json_encode($soportesMap); ?>;
    return soportesMap[idSoporte] || null;
}
</script>

<script>









function getProveedorData(idProveedor) {
    var proveedoresMap = <?php echo json_encode($proveedoresMap); ?>;
    return proveedoresMap[idProveedor] || null;
}

document.getElementById('region2').addEventListener('change', function () {
    var regionId = this.value;
    var comunaSelect = document.getElementById('comuna2');
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
<script>document.getElementById('region').addEventListener('change', function () {
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



<script>
function confirmarEliminacion(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, procedemos con la eliminación
            fetch(`/querys/modulos/deleteProveedor.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Eliminado!',
                            'El Proveedor ha sido eliminado.',
                            'success'
                        ).then(() => {
                            // Redirigir a ListMedios.php después de cerrar la alerta
                            window.location.href = 'ListProveedores.php';
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'No se pudo eliminar el Proveedor.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Ocurrió un error al intentar eliminar el medio.',
                        'error'
                    );
                });
        }
    });
}
</script>
<script>
function confirmarEliminacionSoporte(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, procedemos con la eliminación
            fetch(`/querys/modulos/deleteSoporte.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Eliminado!',
                            'El Soporte ha sido eliminado.',
                            'success'
                        ).then(() => {
                            // Redirigir a ListMedios.php después de cerrar la alerta
                            window.location.href = 'ListProveedores.php';
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'No se pudo eliminar el Soporte.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Ocurrió un error al intentar eliminar el Soporte.',
                        'error'
                    );
                });
        }
    });
}
</script>





<?php include 'componentes/settings.php'; ?>
<?php include 'componentes/footer.php'; ?>
