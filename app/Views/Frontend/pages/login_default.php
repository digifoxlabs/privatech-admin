<div class="content-wrapper remove-background">

    <!-- Main content -->
    <section class="content">

        <?php  $session = session(); ?>

        <script type="text/javascript">
        <?php if($session->getFlashdata('success')): ?>
        toastr.success('<?php echo $session->getFlashdata('success'); ?>')
        <?php elseif($session->getFlashdata('error')): ?>
        toastr.warning('<?php  foreach($session->getFlashdata('error') as $key => $value) {
echo "$key: $value"."</br>";
}  ?>');
        <?php endif; ?>
        </script>

        <div class="container">

            <div class="row">
                <div class="col-lg-6 m-auto">

                    <div class="card mt-3">
                        <div class="card-body register-card-body">
                            <p class="login-box-msg">Login</p>


                            <form action="<?= base_url('/login/client') ?>" method="post">

                                <span class="text-danger mb-1"><?= validation_show_error('user_id') ?></span>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="user_id"
                                        value="<?php echo set_value('user_id') ?>" placeholder="Email/Mobile No">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>


                                <span class="text-danger mb-1"><?= validation_show_error('password') ?></span>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="password" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-sm">Log In</button>
                                </div>

                            </form>

                            <div class="social-auth-links text-center mb-2">
                                <a href="<?= base_url('/register') ?>" class="btn btn-warning btn-sm">Register</a>
                                <a href="<?= base_url('/') ?>" class="btn btn-primary btn-sm">Cancel</a>
                            </div>
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->
                    <!-- /.register-box -->

                </div>

            </div>
        </div>

    </section>
</div>