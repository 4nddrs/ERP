
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('images/logo1.png'); ?>">
    <link rel="icon" type="image/png" href="<?= base_url('images/logo1.png'); ?>">
    <title>
        Inventario
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url('assets/css/nucleo-icons.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/nucleo-svg.css'); ?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="<?= base_url('assets/css/nucleo-icons.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/nucleo-svg.css'); ?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('assets/css/soft-ui-dashboard.css?v=1.0.7'); ?>" rel="stylesheet" />

    <link href="<?= base_url('assets/datatables/datatables.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/jquery-ui/jquery-ui.min.css'); ?>" rel="stylesheet">

    <?php $this->renderSection('style'); ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="<?= base_url('inicio'); ?>">
                <img src="<?= base_url('images/logo1.png'); ?>" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Inventario</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <!-- menu -->
        <?= $this->include('plantilla/menu'); ?>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">🐧DevSync</a></li>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

                    <ul class="navbar-nav ms-md-auto justify-content-end">
                        <li class="nav-item d-flex align-items-center mx-4">
                            <a href="<?= base_url('perfil/cambiarClave'); ?>" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Perfil</span>
                            </a>
                        </li>

                        <li class="nav-item d-flex align-items-center">
                            <a href="<?= base_url('logout'); ?>" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-power-off me-sm-1"></i>
                                <span class="d-sm-inline d-none">Salir</span>
                            </a>
                        </li>


                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <div class="card">
                <div class="card-body">
                    <?php $this->renderSection('contentido'); ?>
                </div>
            </div>

        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/js/core/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js'); ?>"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('assets/js/soft-ui-dashboard.min.js?v=1.0.7'); ?>"></script>
    <script src="<?= base_url('js/jquery.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?= base_url('assets/datatables/datatables.min.js'); ?>"></script>

    <?php $this->renderSection('script'); ?>

</body>

</html>
