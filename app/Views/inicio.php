<?php

$this->extend('plantilla/layout');

$this->section('contentido');

if (verificar('tablero', $_SESSION['permisos'])) { ?>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Productos</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $totalProductos; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-box text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Clientes</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $totalClientes; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Ventas por Dia</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo number_format($totalVentasDia['total'], 2); ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-calendar text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Ventas por Mes</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo number_format($totalVentasMes['total'], 2); ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>

    <div class="card text-white bg-primary">
        <img class="card-img-top" src="<?php echo base_url('images/tablero.jpg'); ?>" alt="Title" />
        <div class="card-body text-center">
            <h4 class="card-title">Pos Venta Multi Sucursal</h4>
            <p class="card-text">Bienvenido</p>
        </div>
    </div>


<?php }
if (verificar('reportes', $_SESSION['permisos'])) { ?>

    <div class="row mt-3">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <h5 class="font-weight-bolder mb-0">
                                    <a href="<?php echo base_url('reportes/productos'); ?>">Reporte de productos</a>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-danger shadow text-center border-radius-md">
                                <i class="fas fa-file-pdf text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <h5 class="font-weight-bolder mb-0">
                                    <a href="<?php echo base_url('reportes/crea_ventas'); ?>">Reporte de ventas</a>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-danger shadow text-center border-radius-md">
                                <i class="fas fa-file-pdf text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }

if (verificar('tablero', $_SESSION['permisos'])) { ?>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="topClientes"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="ventasMes"></div>
                </div>
            </div>
        </div>
    </div>

<?php }

$this->endSection();

if (verificar('tablero', $_SESSION['permisos'])) { ?>

    <?php $this->section('script'); ?>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Highcharts.chart('topClientes', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Top Clientes con Más Ventas'
                },
                xAxis: {
                    categories: [
                        <?php foreach ($topClientes as $cliente) : ?> '<?php echo $cliente['cliente']; ?>',
                        <?php endforeach; ?>
                    ],
                    title: {
                        text: 'Clientes'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Total Ventas'
                    }
                },
                series: [{
                    name: 'Total Ventas',
                    data: [
                        <?php foreach ($topClientes as $cliente) : ?>
                            <?php echo $cliente['total_ventas']; ?>,
                        <?php endforeach; ?>
                    ]
                }]
            });

            Highcharts.chart('ventasMes', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Ventas por Mes'
                },
                xAxis: {
                    categories: [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    title: {
                        text: 'Meses'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Total Ventas'
                    }
                },
                series: [{
                    name: 'Total Ventas',
                    data: [
                        <?php echo $ventasPorMes->ene; ?>,
                        <?php echo $ventasPorMes->feb; ?>,
                        <?php echo $ventasPorMes->mar; ?>,
                        <?php echo $ventasPorMes->abr; ?>,
                        <?php echo $ventasPorMes->may; ?>,
                        <?php echo $ventasPorMes->jun; ?>,
                        <?php echo $ventasPorMes->jul; ?>,
                        <?php echo $ventasPorMes->ago; ?>,
                        <?php echo $ventasPorMes->sep; ?>,
                        <?php echo $ventasPorMes->oct; ?>,
                        <?php echo $ventasPorMes->nov; ?>,
                        <?php echo $ventasPorMes->dic; ?>
                    ]
                }]
            });
        });
    </script>

<?php $this->endSection();
} ?>