  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">home</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>




<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <h5 class="lead mb-2">Clients</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-6">
            <a href="<?= base_url('admin/clients/active') ?>">

                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Active</span>
                        <span class="info-box-number"><?= $activeClients ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

            </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-6">
            <a href="<?= base_url('admin/clients/pending') ?>">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number"><?= $pendingClients ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-6">
            <a href="<?= base_url('admin/clients/expired') ?>">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Expired</span>
                        <span class="info-box-number"><?= $expiredClients ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-6">
                <a href="<?= base_url('admin/allClients') ?>">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">All Clients</span>
                        <span class="info-box-number"><?= $allClients ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <h5 class="lead mt-4 mb-2">Dealers</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-sitemap"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Requests</span>
                        <span class="info-box-number">XX</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa-solid fa-sitemap"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Dealers</span>
                        <span class="info-box-number">XX</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa-solid fa-sitemap"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Messages</span>
                        <span class="info-box-number">XX</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-6">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="fa-solid fa-sitemap"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Settings</span>
                        <span class="info-box-number">XX</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <h5 class="lead mt-4 mb-2">Subscriptions</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-6">
            <a href="<?= base_url('admin/transactions') ?>">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-receipt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Transactions</span>
                        <span class="info-box-number"><?= $allTransactions ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-6">
            <a href="<?= base_url('admin/managePackages') ?>">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa-solid fa-layer-group"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Packages</span>
                        <span class="info-box-number"><?= $allPackages ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-6">
            <a href="<?= base_url('admin/activationCodes') ?>">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa fa-ticket-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Activation Codes</span>
                        <span class="info-box-number"><?= $allActivationCodes ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-6">
            <a href="<?= base_url('admin/couponCodes') ?>">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="fas fa-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Discount Coupons</span>
                        <span class="info-box-number"><?= $allCoupons ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->















    </div>
</section>

</div>
<!-- Content Wrapper -->








<<script>

    $(document).ready(function() {

                 $("#dashboardMenu").addClass('active');

    });

    </script>