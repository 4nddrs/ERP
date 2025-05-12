<?php

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<h4 class="mt-3">Modificar empleado</h4>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form class="row g-3" method="post" action="<?= base_url('empleados/' . $empleado['id']); ?>" autocomplete="off">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="id" value="<?= $empleado['id'] ?>">

    <div class="col-12">
        <p class="fst-italic">Campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
    </div>

    <div class="col-md-3">
        <label for="usuario" class="form-label"><span class="text-danger">*</span> Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= set_value('usuario', $empleado['usuario']); ?>" required autofocus>
    </div>

    <div class="col-md-9">
        <label for="nombre" class="form-label"><span class="text-danger">*</span> Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= set_value('nombre', $empleado['nombre']); ?>" required>
    </div>

    <div class="form-group col-md-4">
        <label for="id_sucursal">Sucursal</label>
        <select id="id_sucursal" name="id_sucursal" class="form-control">
            <option value="">Seleccionar</option>
            <?php foreach ($sucursales as $sucursal) : ?>
                <option value="<?= $sucursal['id']; ?>" <?= ($sucursal['id'] == $empleado['id_sucursal']) ? 'selected' : ''; ?>>
                    <?= $sucursal['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group col-md-4">
        <label for="id_rol">Rol</label>
        <select id="id_rol" name="id_rol" class="form-control">
            <option value="">Seleccionar</option>
            <?php foreach ($roles as $rol) : ?>
                <option value="<?= $rol['id']; ?>" <?= ($rol['id'] == $empleado['id_rol']) ? 'selected' : ''; ?>>
                    <?= $rol['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="text-end">
        <a href="<?= base_url('empleados'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php $this->endSection(); ?>

