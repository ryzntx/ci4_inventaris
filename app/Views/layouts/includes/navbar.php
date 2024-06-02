<nav class="sb-topnav navbar navbar-expand-md navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 d-flex justify-content-center align-content-center align-middle align-items-center"
        href="index.html">
        <img src="<?=base_url('assets/img/clipboard-image.png')?>" width="60"><span
            class="text-light fs-6 ms-2 d-inline-flex flex-column">
            <p class="m-0 p-0">Sarana &amp; Prasarana</p>
            <p class="m-0 p-0">SMP Negeri 1 Subang</p>
        </span></a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 ms-md-5 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <a href="<?=base_url('auth/logout')?>" class="btn btn-sm btn-danger" onclick="
        return confirm('Apakah Anda yakin ingin keluar?')"><i class="fas fa-sign-out-alt fa-fw me-2"></i><span
                class="d-md-inline d-none">Keluar</span></a>
        <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li> -->
    </ul>
</nav>