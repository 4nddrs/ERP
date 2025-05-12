<?php

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<h4 class="mt-3">Nuevo cliente</h4>

<!-- Mensajes de validación -->
<?php if (session()->getFlashdata('errors') !== null) : ?>
    <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="row g-3" method="post" action="<?= base_url('clientes'); ?>" autocomplete="off">

    <div class="col-12">
        <p class="fst-italic">
            Campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.
        </p>
    </div>

    <?= csrf_field(); ?>

    <div class="col-md-3">
        <label for="identidad" class="form-label"><span class="text-danger">*</span> Identidad</label>
        <input type="text" class="form-control" id="identidad" name="identidad" value="<?= set_value('identidad'); ?>" placeholder="N° identidad" required autofocus>
    </div>

    <div class="col-md-9">
        <label for="nombre" class="form-label"><span class="text-danger">*</span> Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= set_value('nombre'); ?>" placeholder="Nombre" required>
    </div>

    <div class="col-md-4">
        <label for="apellido" class="form-label"><span class="text-danger">*</span> Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?= set_value('apellido'); ?>" placeholder="Apellido" required>
    </div>

    <div class="col-md-4">
        <label for="telefono" class="form-label"><span class="text-danger">*</span> Telefono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= set_value('telefono'); ?>" placeholder="Telefono">
    </div>

    <div class="col-md-4">
        <label for="direccion"><span class="text-danger">*</span> Gmail</label>
        <input type="email" id="direccion" class="form-control" name="direccion"  
       placeholder="Correo Gmail" pattern="[a-zA-Z0-9._%+-]+@gmail\.com"  
       value="<?= set_value('direccion'); ?>" required>

    </div>

    <div class="text-end">
        <a href="<?= base_url('clientes'); ?>" class="btn btn-secondary">Regresar</a>
        <button class="btn btn-success" type="submit">Guardar</button>
    </div>
</form>

<?php
$this->endSection();