<div class="content-wrapper remove-background">

    <!-- Main content -->
   <section class="content">
   <?php  $session = session(); ?>

        <div class="card mt-3">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Login at</p>

                <span class="text-info text-center"><p><?= $session->getTempdata('user_input'); ?></p></span>

                <table class="table table-bordered text-center">

                  <tr>
                  <td style="width:50%">
                       <a href="<?= base_url('login/password') ?>" class="btn btn-block btn-outline-primary">Password</a>
                     
                    </td>
                    <td>
                    <a href="<?= base_url('login/otp') ?>" class="btn btn-block btn-outline-secondary">OTP</a>                   
                    </td>
                  </tr>

            </table>

                <div class="social-auth-links text-center mb-2">
                    <a href="<?= base_url('/') ?>" class="btn btn-primary btn-sm">Cancel</a>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    <!-- /.register-box -->
</section>
</div>