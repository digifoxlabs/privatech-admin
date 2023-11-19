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
                        <li class="breadcrumb-item active">Profile</li>
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
                            <h5 class="card-title m-0">Profile</h5>
                        </div>
                        <div class="card-body">

                            <form action="<?= base_url('profile') ?>" method="post" class="form-horizontal">

                                <span class="text-danger mb-1"><?= validation_show_error('name') ?></span>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            value="<?php echo empty($client_data['name']) ? "" : $client_data['name'];?>"
                                            placeholder="Name">
                                    </div>
                                </div>

                                <span class="text-danger mb-1"><?= validation_show_error('email') ?></span>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email"
                                            value="<?php echo empty($client_data['email']) ? "" : $client_data['email'];?>"
                                            placeholder="Email">
                                    </div>
                                </div>

                                <span class="text-danger mb-1"><?= validation_show_error('mobile') ?></span>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="mobile"
                                            value="<?php echo empty($client_data['mobile']) ? "" : $client_data['mobile'];?>"
                                            placeholder="10 digit mobile no">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>