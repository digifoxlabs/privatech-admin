<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
        <img src="<?= base_url('public/assets/common/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ADMIN PANEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('public/assets/common/img/default_user.png') ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session()->get('name') ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item">
                    <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link" id="dashboardMenu">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item has-treeview" id="clientTree">

                    <a href="#" class="nav-link" id="clientMenu">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Clients
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="<?= base_url('admin/clients/active'); ?>" class="nav-link"
                                id="clientSubMenuActive">
                                <i class="far fa-circle nav-icon text-success"></i>
                                <p>Active</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="<?= base_url('admin/clients/pending'); ?>" class="nav-link"
                                id="clientSubMenuPending">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Pending</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="<?= base_url('admin/clients/expired'); ?>" class="nav-link"
                                id="clientSubMenuExpired">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>Expired</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="<?= base_url('admin/allClients'); ?>" class="nav-link" id="clientSubMenuAll">
                                <i class="far fa-circle nav-icon text-primary"></i>
                                <p>View All</p>
                            </a>
                        </li>




                    </ul>
                </li>


                <li class="nav-item has-treeview" id="packageTree">

                    <a href="#" class="nav-link" id="packageMenu">
               
                        <i class="nav-icon fa-solid fa-tree"></i>
                        <p>
                            Packages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="<?= base_url('admin/managePackages'); ?>" class="nav-link"
                                id="packageSubMenuManage">
                                <i class="far fa-circle nav-icon text-success"></i>
                                <p>Manage Packages</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="<?= base_url('admin/activationCodes'); ?>" class="nav-link"
                                id="packageSubMenuCodes">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Activation Codes</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="<?= base_url('admin/couponCodes'); ?>" class="nav-link"
                                id="packageSubMenuCoupons">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>Coupons</p>
                            </a>
                        </li>


                    </ul>
                </li>



                <li class="nav-item">
                    <a href="<?= base_url('admin/transactions') ?>" class="nav-link" id="transactionMenu">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Transactions</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="<?= base_url('admin/settings') ?>" class="nav-link" id="settingsMenu">
                    <i class="nav-icon fa-solid fa-gear"></i>
                        <p class="text">Settings</p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>