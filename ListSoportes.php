<?php
// Iniciar la sesión
session_start();


include 'querys/qsoportes.php';
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
                            <h4>Listado de Soportes</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Soporte</th>
                                            <th>Nombre de Proveedor</th>
                                            <th>RUT</th>
                                            <th>Teléfono Fijo</th>
                                            <th>Teléfono Movíl</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($soportes as $soporte): ?>
                                        <tr>
                                            <td><?php echo $soporte['id_soporte']; ?></td>
                                            <td><?php echo $soporte['nombre_soporte']; ?></td>
                                            <td><?php echo $proveedoresMap[$soporte['id_proveedor']]['nombreProveedor'] ?? ''; ?></td>
                                            <td><?php echo $proveedoresMap[$soporte['id_proveedor']]['rutProveedor'] ?? ''; ?></td>
                                            <td><?php echo $proveedoresMap[$soporte['id_proveedor']]['telFijo'] ?? ''; ?></td>
                                            <td><?php echo $proveedoresMap[$soporte['id_proveedor']]['telCelular'] ?? ''; ?></td>
                                            <td><a href="#" class="btn btn-primary">Detail</a></td>
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
<?php include 'componentes/settings.php'; ?>
<?php include 'componentes/footer.php'; ?>