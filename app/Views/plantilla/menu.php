<div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <?php
        // En tu controlador o vista
        $uri = service('uri');

        // Obtén la ruta actual
        $currentPath = $uri->getPath();
        // Ajustar $currentPath eliminando el prefijo '/pos-cdp/public/'
        $currentPath = str_replace(env('NOMBREPROYECTO'), '', $currentPath);

        // Define las rutas esperadas y sus clases correspondientes
        $expectedPaths = [
            'inicio' => ['class' => 'tablero', 'icon' => 'fa-home'],
            'productos' => ['class' => 'productos', 'icon' => 'fa-list'],
            'clientes' => ['class' => 'clientes', 'icon' => 'fa-users'],
            'nuevaventa' => ['class' => 'nueva venta', 'icon' => 'fa-box'],
            'ventas' => ['class' => 'historial ventas', 'icon' => 'fa-cash-register'],
            'roles' => ['class' => 'roles', 'icon' => 'fa-key'],
            'usuarios' => ['class' => 'usuarios', 'icon' => 'fa-user'],
            'sucursal' => ['class' => 'sucursal', 'icon' => 'fa-cog'],
            // Agrega más rutas según sea necesario
        ];

        foreach ($expectedPaths as $path => $info) {
            $isActive = ($currentPath == $path) ? 'active' : '';

            if (verificar($info['class'], $_SESSION['permisos'])) { ?>
                <li class="nav-item">
                    <a class="nav-link <?= $isActive ?>" href="<?= base_url("$path"); ?>">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-dark text-center me-2 d-flex align-items-center justify-content-center">
                            <!-- Utiliza el ícono asociado a la ruta -->
                            <i class="fas <?= $info['icon'] ?>"></i>
                        </div>
                        <span class="nav-link-text ms-1"><?= ucfirst($info['class']) ?></span>
                    </a>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</div>
