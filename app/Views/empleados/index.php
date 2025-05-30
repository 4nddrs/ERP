<?php

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<div class="d-flex justify-content-between">
    <h4 class="" id="titulo">Empleados</h4>

    <div>
        <p>
            <a href="<?= base_url('empleados/new'); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Nuevo
            </a>
        </p>
    </div>
</div>

<?php if (session()->getFlashdata('msg')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('msg'); ?>
    </div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" id="dataTable" aria-describedby="titulo" style="width: 100%">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha Nac.</th>
                <th>Fecha Ingreso</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>Sueldo</th>
                <th>Horas/Semana</th>
                <th>Estado</th>
                <th style="width: 3%"></th>
                <th style="width: 3%"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($empleados as $empleado) : ?>
                <tr>
                    <td><?= esc($empleado['nombre']); ?></td>
                    <td><?= esc($empleado['apellido']); ?></td>
                    <td><?= esc($empleado['correo']); ?></td>
                    <td><?= esc($empleado['telefono']); ?></td>
                    <td><?= esc($empleado['direccion']); ?></td>
                    <td><?= esc($empleado['fecha_nacimiento']); ?></td>
                    <td><?= esc($empleado['fecha_ingreso']); ?></td>
                    <td><?= esc($empleado['cargo']); ?></td>
                    <td><?= esc($empleado['departamento']); ?></td>
                    <td><?= esc($empleado['sueldo']); ?></td>
                    <td><?= esc($empleado['horas_trabajo_semana']); ?></td>
                    <td><?= esc($empleado['estado']); ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="<?= base_url('empleados/edit/' . $empleado['id']) ?>" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="#" onclick="eliminarRegistro(<?= $empleado['id']; ?>)" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form action="" method="post" id="form-elimina">
    <input type="hidden" name="_method" value="delete">
    <?= csrf_field(); ?>
</form>

<?php
$this->endSection();
$this->section('script');
?>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "language": {
                "url": "<?= base_url('js/DatatablesSpanish.json'); ?>"
            },
            "pageLength": 10,
            "order": [[0, "asc"]]
        });
    });

    function eliminarRegistro(id) {
        Swal.fire({
            title: "¿Eliminar Registro?",
            text: "¡Está seguro de eliminar el registro!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar"
        }).then((result) => {
            if (result.isConfirmed) {
                const url = '<?= base_url('empleados/'); ?>' + id;
                const formElimina = document.querySelector('#form-elimina');
                formElimina.action = url;
                formElimina.submit();
            }
        });
    }
</script>

<?php $this->endSection(); ?>
