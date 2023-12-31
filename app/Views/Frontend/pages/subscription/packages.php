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
                        <li class="breadcrumb-item"><a href="<?= base_url('subscription') ?>">Subscription</a></li>
                        <li class="breadcrumb-item active">Packages</li>
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
                            <h5 class="card-title m-0">Packages</h5>


                        </div>
                        <div class="card-body">

                            <div class="card card-solid">
                                <div class="card-body pb-0">
                                    <div class="row">


                                    <?php foreach($packages as $list):  ?>

                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="card card-primary  card-outline">
                                                <div class="card-header elevation-2 lead border-bottom-0"><b><?= $list['name']; ?></b>
                                                </div>
                                                <div class="card-body  pt-0">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="bg-info py-2 px-3 mt-4">
                                                                <h2 class="mb-0">
                                                                <i class="fa-solid fa-indian-rupee-sign"></i> <?= $list['price']; ?> /-
                                                                </h2>
                                                                <h4 class="mt-1">
                                                                    <small><i class="fa-regular fa-calendar"></i>: <?= $list['duration_in_days']; ?> days </small>
                                                                </h4>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="text-center">
                                                        <a href="<?= base_url('subscription/purchase/'.$list['pck_id']) ?>" class="btn btn-sm btn-primary">
                                                            <i class="fa-solid fa-cart-shopping"></i> Buy
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php endforeach; ?>



                                    </div>
                                </div>


                            </div>





                        </div>
                    </div>
                </div>

            </div>