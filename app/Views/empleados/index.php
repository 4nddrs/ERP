<?php

$this->extend('plantilla/layout');
$this->section('contentido');

?>

<div class="d-flex justify-content-between">
    <h4 id="titulo">Empleados</h4>

    <div>
        <p>
            <a href="<?= base_url('empleados/new'); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Nuevo
            </a>
        </p>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm" id="dataTable" aria-describedby="titulo" style="width: 100%">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Sucursal</th>
                <th>Rol</th>
                <th style="width: 3%"></th>
                <th style="width: 3%"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($empleados as $empleado) : ?>
                <tr>
                    <td><?= esc($empleado['usuario']); ?></td>
                    <td><?= esc($empleado['nombre']); ?></td>
                    <td><?= $empleado['sucursal']; ?></td>
                    <td><?= $empleado['rol']; ?></td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='<?= base_url('empleados/' . $empleado['id'] . '/edit'); ?>' title='Modificar registro'>
                            <span class='fas fa-edit'></span>
                        </a>
                    </td>
                    <td>
                        <a class='btn btn-danger btn-sm' href='#' onclick="eliminarRegistro(<?= $empleado['id']; ?>)" title='Eliminar registro'>
                            <span class='fas fa-trash'></span>
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
    $(document).ready(function() {
        $('#dataTable').DataTable({
            language: {
                url: "<?= base_url('js/DatatablesSpanish.json'); ?>"
            },
            pageLength: 10,
            order: [[0, "asc"]]
        });
    });

    function eliminarRegistro(id) {
        Swal.fire({
            title: "¿Eliminar Registro?",
            text: "¡Esta acción no se puede deshacer!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar"
        }).then((result) => {
            if (result.isConfirmed) {
                const formElimina = document.getElementById('form-elimina');
                formElimina.action = '<?= base_url('empleados/'); ?>' + id;
                formElimina.submit();
            }
        });
    }
</script>

<?php $this->endSection(); ?>

