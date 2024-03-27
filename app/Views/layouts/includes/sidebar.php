<div class="col col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div
        class="d-xxl-flex justify-content-xxl-center align-items-xxl-center d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <div class="d-flex flex-column justify-content-center align-items-center align-content-center dropdown pb-4">
            <img class="rounded-circle" src="<?= base_url('assets/img/hczKIze.jpg') ?>" width="50" height="50">
            <h4 class="text-center">Hi, <?= model('UserModel')->ambilDataLogin()->nama ?></h4>
            <h5 class="badge bg-success">
                <?= model('UserModel')->joinLevelWhere(session()->get('id_user'))->nama_level ?></h5>
        </div>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item"><a href="#" class="nav-link align-middle px-0"><i
                        class="fa fa-home fs-4 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span></a></li>
            <li class="nav-item"><a class="nav-link px-0 align-middle dropdown-toggle" href="#submenu1"
                    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="submenu1"><i
                        class="fa fa-bar-chart fs-4 bi-speedometer2"></i><span
                        class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                <ul id="submenu1" class="nav flex-column ms-1 collapse ms-1 ms-md-3">
                    <li class="w-100"><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Item</span></a>
                    </li>
                    <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Item</span></a></li>
                </ul>
            </li>
            <li><a href="#" class="nav-link px-0 align-middle"><i class="fa fa-table fs-4 bi-table"></i><span
                        class="ms-1 d-none d-sm-inline">Orders</span></a></li>
            <li><a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i
                        class="fa fa-glass fs-4 bi-bootstrap"></i><span
                        class="ms-1 d-none d-sm-inline">Lounge</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100"><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Item</span></a>
                    </li>
                    <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Item</span></a></li>
                </ul>
            </li>
            <li><a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i
                        class="fa fa-th-large fs-4 bi-grid"></i><span
                        class="ms-1 d-none d-sm-inline">Products</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100"><a href="#" class="nav-link px-0"><span
                                class="d-none d-sm-inline">Product</span></a></li>
                    <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Product</span></a></li>
                    <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Product</span></a></li>
                    <li><a href="#" class="nav-link px-0"><span class="d-none d-sm-inline">Product</span></a></li>
                </ul>
            </li>
            <li><a href="#" class="nav-link px-0 align-middle"><i class="fa fa-users fs-4 bi-people"></i><span
                        class="ms-1 d-none d-sm-inline">Customers</span></a></li>
        </ul>
        <hr>
    </div>
</div>