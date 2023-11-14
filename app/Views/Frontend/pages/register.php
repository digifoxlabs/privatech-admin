<div class="content-wrapper remove-background">

    <!-- Main content -->
    <section class="content">
        <?php  $session = session(); ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">

                    <div class="card">
                        <div class="card-body register-card-body">
                            <p class="login-box-msg">Register a new membership</p>

                            <form action="<?= base_url('/register') ?>" method="post">
                                <span class="text-danger mb-1"><?= validation_show_error('name') ?></span>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="name" value="<?= set_value('name') ?>"
                                        placeholder="Full name">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>

                                <span class="text-danger mb-1"><?= validation_show_error('email') ?></span>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email"
                                        value="<?php echo $session->getTempdata('default_email') ? $session->getTempdata('default_email') : set_value('email') ?>"
                                        placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>

                                <span class="text-danger mb-1"><?= validation_show_error('mobile') ?></span>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="mobile"
                                        value="<?php echo $session->getTempdata('default_mobile') ? $session->getTempdata('default_mobile') : set_value('mobile') ?>"
                                        placeholder="Mobile Number">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-mobile"></span>
                                        </div>
                                    </div>
                                </div>

                                <span class="text-danger mb-1"><?= validation_show_error('password') ?></span>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <span class="text-danger mb-1"><?= validation_show_error('passconf') ?></span>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="passconf"
                                        placeholder="Confirm Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary pl-0">

                                            <p>
                                                I agree to the <a href="#">terms</a>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4 text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Register</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>

                            <div class="social-auth-links text-center mb-2">
                                <a href="<?= base_url('/') ?>" class="btn btn-primary btn-sm">I already have a
                                    membership</a>
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