<?php

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<h4 class="mt-3">Modificar sucursal</h4>

<!-- Mensajes de validación -->
<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null) : ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('sucursal/' . $sucursal['id']); ?>" autocomplete="off">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="id" value="<?= $sucursal['id'] ?>">

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <div class="col-md-3">
        <label for="numero" class="form-label"><span class="text-danger">*</span> Identidad</label>
        <input type="text" class="form-control" id="numero" name="numero" value="<?= set_value('numero', $sucursal['numero']); ?>" placeholder="N° identidad" required autofocus>
    </div>

    <div class="col-md-9">
        <label for="nombre" class="form-label"><span class="text-danger">*</span> Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= set_value('nombre', $sucursal['nombre']); ?>" placeholder="Nombre" required>
    </div>

    <div class="col-md-4">
        <label for="correo" class="form-label"><span class="text-danger">*</span> Correo</label>
        <input type="email" class="form-control" id="correo" name="correo" value="<?= set_value('correo', $sucursal['correo']); ?>" placeholder="Correo" required>
    </div>

    <div class="col-md-4">
        <label for="telefono" class="form-label"><span class="text-danger">*</span> Telefono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= set_value('telefono', $sucursal['telefono']); ?>" placeholder="Telefono">
    </div>

    <div class="col-md-4">
        <label for="folio_venta" class="form-label"><span class="text-danger">*</span> Folio</label>
        <input type="text" class="form-control" id="folio_venta" name="folio_venta" value="<?= set_value('folio_venta', $sucursal['folio_venta']); ?>" placeholder="Folio">
    </div>

    <div class="col-md-6">
        <label for="direccion"><span class="text-danger">*</span> Gmail</label>
        <textarea id="direccion" class="form-control" name="direccion" rows="2" placeholder="Gmail"><?= $sucursal['direccion']; ?></textarea>
    </div>

    <div class="col-md-6">
        <label for="mensaje"><span class="text-danger">*</span> Mensaje</label>
        <textarea id="mensaje" class="form-control" name="mensaje" rows="2" placeholder="Mensaje"><?= $sucursal['mensaje']; ?></textarea>
    </div>

    <div class="text-end">
        <a href="<?= base_url('sucursal'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();