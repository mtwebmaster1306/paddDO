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
                                    <div id="dropdown5" class="input-group dropdown" >
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
                                        <select class="sesel form-select" name="id_region" id="regionx" required>
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
                                        <select class="sesel form-select" name="id_comuna" id="comunax" required>
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
<script src="../../assets/js/getmedios.js"></script>
<script src="../../assets/js/getregiones.js"></script>