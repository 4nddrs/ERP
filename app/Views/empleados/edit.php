<?= $this->extend('plantilla/layout') ?>
<?= $this->section('contentido') ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Nuevo Empleado</h4>
        <a href="<?= base_url('empleados') ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <?php if (isset($errors) && count($errors) > 0) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('empleados/create') ?>" method="post" novalidate>
        <?= csrf_field() ?>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                <input type="text" name="nombre" id="nombre" class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" value="<?= old('nombre') ?>" required>
                <div class="invalid-feedback">Por favor, ingrese el nombre.</div>
            </div>

            <div class="col-md-6">
                <label for="apellido" class="form-label">Apellido <span class="text-danger">*</span></label>
                <input type="text" name="apellido" id="apellido" class="form-control <?= isset($errors['apellido']) ? 'is-invalid' : '' ?>" value="<?= old('apellido') ?>" required>
                <div class="invalid-feedback">Por favor, ingrese el apellido.</div>
            </div>

            <div class="col-md-6">
                <label for="correo" class="form-label">Correo <span class="text-danger">*</span></label>
                <input type="email" name="correo" id="correo" class="form-control <?= isset($errors['correo']) ? 'is-invalid' : '' ?>" value="<?= old('correo') ?>" required>
                <div class="invalid-feedback">Ingrese un correo válido.</div>
            </div>

            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" class="form-control <?= isset($errors['telefono']) ? 'is-invalid' : '' ?>" value="<?= old('telefono') ?>" pattern="[0-9+\s()\-]{7,20}" placeholder="+591 7 1234567">
                <div class="invalid-feedback">Ingrese un teléfono válido.</div>
            </div>

            <div class="col-12">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea name="direccion" id="direccion" class="form-control <?= isset($errors['direccion']) ? 'is-invalid' : '' ?>" rows="2"><?= old('direccion') ?></textarea>
                <div class="invalid-feedback">Ingrese una dirección válida.</div>
            </div>

            <div class="col-md-6">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control <?= isset($errors['fecha_nacimiento']) ? 'is-invalid' : '' ?>" value="<?= old('fecha_nacimiento') ?>" required max="<?= date('Y-m-d', strtotime('-18 years')) ?>">
                <div class="invalid-feedback">Debe ser mayor de 18 años.</div>
            </div>

            <div class="col-md-6">
                <label for="fecha_ingreso" class="form-label">Fecha de Ingreso <span class="text-danger">*</span></label>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control <?= isset($errors['fecha_ingreso']) ? 'is-invalid' : '' ?>" value="<?= old('fecha_ingreso') ?>" required max="<?= date('Y-m-d') ?>">
                <div class="invalid-feedback">Ingrese una fecha válida.</div>
            </div>

            <div class="col-md-6">
                <label for="cargo" class="form-label">Cargo <span class="text-danger">*</span></label>
                <input type="text" name="cargo" id="cargo" class="form-control <?= isset($errors['cargo']) ? 'is-invalid' : '' ?>" value="<?= old('cargo') ?>" required>
                <div class="invalid-feedback">Ingrese el cargo.</div>
            </div>

            <div class="col-md-6">
                <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                <input type="text" name="departamento" id="departamento" class="form-control <?= isset($errors['departamento']) ? 'is-invalid' : '' ?>" value="<?= old('departamento') ?>" required>
                <div class="invalid-feedback">Ingrese el departamento.</div>
            </div>

            <div class="col-md-6">
                <label for="sueldo" class="form-label">Sueldo <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="sueldo" id="sueldo" class="form-control <?= isset($errors['sueldo']) ? 'is-invalid' : '' ?>" value="<?= old('sueldo') ?>" required>
                <div class="invalid-feedback">Ingrese un sueldo válido.</div>
            </div>

            <div class="col-md-6">
                <label for="horas_trabajo_semana" class="form-label">Horas de trabajo por semana <span class="text-danger">*</span></label>
                <input type="number" name="horas_trabajo_semana" id="horas_trabajo_semana" class="form-control <?= isset($errors['horas_trabajo_semana']) ? 'is-invalid' : '' ?>" value="<?= old('horas_trabajo_semana') ?>" required>
                <div class="invalid-feedback">Ingrese el número de horas semanales.</div>
            </div>

            <div class="col-md-6">
                <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                <select name="estado" id="estado" class="form-select <?= isset($errors['estado']) ? 'is-invalid' : '' ?>" required>
                    <option value="">Selecciona...</option>
                    <option value="activo" <?= old('estado') == 'activo' ? 'selected' : '' ?>>Activo</option>
                    <option value="inactivo" <?= old('estado') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    <option value="licencia" <?= old('estado') == 'licencia' ? 'selected' : '' ?>>Licencia</option>
                    <option value="suspendido" <?= old('estado') == 'suspendido' ? 'selected' : '' ?>>Suspendido</option>
                </select>
                <div class="invalid-feedback">Seleccione un estado válido.</div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Guardar</button>
            <a href="<?= base_url('empleados') ?>" class="btn btn-secondary"><i class="fas fa-times me-1"></i> Cancelar</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
