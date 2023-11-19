<div class="content-wrapper remove-background">


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-light"> Welcome, <small><?= session()->get('name'); ?></small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Subscription</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <?php $session = session(); ?>

    <script type="text/javascript">
    <?php if($session->getFlashdata('success')): ?>
    toastr.success('<?php echo $session->getFlashdata('success'); ?>')
    <?php elseif($session->getFlashdata('error')): ?>
    toastr.warning('<?php  foreach($session->getFlashdata('error') as $key => $value) {
echo "$key: $value"."</br>";
}  ?>');
    <?php endif; ?>
    </script>

    <!-- Main content -->
    <div class="content">
        <div class="container">

            <div class="row">

                <div class="col-12">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Subscription</h5>


                            <div class="card-tools">

                                <a href="<?= base_url('transactions') ?>" class="btn btn-block btn-info btn-sm">My
                                    Transactions</a>
                            </div>



                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Subscription
                                                        Status</span>
                                                    <span class="info-box-number text-center text-muted mb-0">
                                                        <?= $subs_status ?></span>


                                                    <div class="text-center"> <a href="<?= base_url('subscription/packages') ?>"
                                                            class="btn btn-xs btn-primary">
                                                            <i class="fa-solid fa-cart-shopping"></i> Purchase
                                                        </a>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Storage
                                                        Plan</span>
                                                    <span
                                                        class="info-box-number text-center text-muted mb-0">FREE</span>
                                                        <div class="text-center"> <a href="#"
                                                            class="btn btn-xs btn-primary disabled">
                                                            <i class="fa-solid fa-cart-shopping"></i> Purchase
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- Row -->

                        </div>
                    </div>
                </div>

            </div>