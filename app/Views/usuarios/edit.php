<?php

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<h4 class="mt-3">Modificar usuario</h4>

<!-- Mensajes de validación -->
<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null) : ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('usuarios/' . $usuario['id']); ?>" autocomplete="off">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="col-md-3">
        <label for="usuario" class="form-label"><span class="text-danger">*</span> Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= set_value('usuario', $usuario['usuario']); ?>" placeholder="Usuario" required autofocus>
    </div>

    <div class="col-md-9">
        <label for="nombre" class="form-label"><span class="text-danger">*</span> Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= set_value('nombre', $usuario['nombre']); ?>" placeholder="Nombre" required>
    </div>

    <div class="form-group col-md-4">
        <label for="id_sucursal">Sucursal</label>
        <select id="id_sucursal" class="form-control" name="id_sucursal">
            <option value="">Seleccionar</option>
            <?php foreach ($sucursales as $sucursal) { ?>
                <option value="<?php echo $sucursal['id']; ?>" <?= ($sucursal['id'] == $usuario['id_sucursal']) ? 'selected' : ''; ?>><?php echo $sucursal['nombre']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group col-md-4">
        <label for="id_rol">Rol</label>
        <select id="id_rol" class="form-control" name="id_rol">
            <option value="">Seleccionar</option>
            <?php foreach ($roles as $rol) { ?>
                <option value="<?php echo $rol['id']; ?>" <?= ($rol['id'] == $usuario['id_rol']) ? 'selected' : ''; ?>><?php echo $rol['nombre']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="text-end">
        <a href="<?= base_url('usuarios'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();
$this->section('script');
?>

<script>
    document.addEventListener("keypress", function(e) {
        let code = e.keyCode || e.which;
        if (code === 13) {
            e.preventDefault();
            return false;
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        let inventariableSelect = document.getElementById("inventariable");
        let existenciaInput = document.getElementById("existencia");

        inventariableSelect.addEventListener("change", function() {
            let option = inventariableSelect.options[inventariableSelect.selectedIndex].value;

            if (option == 1) {
                existenciaInput.readOnly = false;
            } else {
                existenciaInput.readOnly = true;
            }

            existenciaInput.value = 0;
        });
    });

    function validateDecimal(valor) {
        let re = /^\d*\.?\d*$/;
        return re.test(valor);
    }
</script>


<?php $this->endSection(); ?>