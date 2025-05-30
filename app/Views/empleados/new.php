<?= $this->extend('plantilla/layout') ?>
<?= $this->section('contentido') ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Nuevo Empleado</h4>
        <a href="<?= base_url('empleados') ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <?php if (isset($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('empleados/create') ?>" method="post" novalidate>
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= old('nombre') ?>" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="<?= old('apellido') ?>" required>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" value="<?= old('correo') ?>" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="<?= old('telefono') ?>">
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea name="direccion" id="direccion" class="form-control"><?= old('direccion') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?= old('fecha_nacimiento') ?>" required>
        </div>

        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="<?= old('fecha_ingreso') ?>" required>
        </div>

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" name="cargo" id="cargo" class="form-control" value="<?= old('cargo') ?>" required>
        </div>

        <div class="mb-3">
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" name="departamento" id="departamento" class="form-control" value="<?= old('departamento') ?>" required>
        </div>

        <div class="mb-3">
            <label for="sueldo" class="form-label">Sueldo</label>
            <input type="number" step="0.01" name="sueldo" id="sueldo" class="form-control" value="<?= old('sueldo') ?>" required>
        </div>

        <div class="mb-3">
            <label for="horas_trabajo_semana" class="form-label">Horas de trabajo por semana</label>
            <input type="number" name="horas_trabajo_semana" id="horas_trabajo_semana" class="form-control" value="<?= old('horas_trabajo_semana') ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="">Selecciona...</option>
                <option value="activo" <?= old('estado') == 'activo' ? 'selected' : '' ?>>Activo</option>
                <option value="inactivo" <?= old('estado') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                <option value="licencia" <?= old('estado') == 'licencia' ? 'selected' : '' ?>>Licencia</option>
                <option value="suspendido" <?= old('estado') == 'suspendido' ? 'selected' : '' ?>>Suspendido</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?= base_url('empleados') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= $this->endSection() ?>
