<div class="content-wrapper remove-background">

    <!-- Main content -->
   <section class="content">
   <?php  $session = session(); ?>

        <div class="card mt-3">
            <div class="card-body register-card-body">
                <p class="login-box-msg">OTP Login using</p>

                <span class="text-info text-center"><p><?= $session->getTempdata('user_input'); ?></p></span>


                <form action="<?= base_url('/loginClientOTP') ?>" method="post">

                <span class="text-danger mb-1"><?= validation_show_error('user_id') ?></span>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="user_id" value="<?php echo $session->getTempdata('user_input') ? $session->getTempdata('user_input') : set_value('user_id') ?>" readonly>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>              
                    </div>
              
                    
                    <span class="text-danger mb-1"><?= validation_show_error('otp') ?></span>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="otp"  placeholder="OTP">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-8">
                       
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-success btn-block btn-sm">Log In</button>

                    </div>
                    <!-- /.col -->
                </div>

   
                </form>


                <div class="social-auth-links text-center mb-2">
                    <a href="<?= base_url('/') ?>" class="btn btn-primary btn-sm">Cancel</a>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    <!-- /.register-box -->
</section>
</div>