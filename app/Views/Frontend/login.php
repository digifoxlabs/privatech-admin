<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PRIVATECH</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <?=link_tag('public/assets/common/plugins/fontawesome-free/css/all.min.css')?>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <?=link_tag('public/assets/common/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>
    <!-- Theme style -->
    <?=link_tag('public/assets/common/dist/css/adminlte.min.css')?>
    <!-- Custom CSS -->
    <?=link_tag('public/assets/frontend/mycustom.css')?>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    <?=script_tag('public/assets/common/plugins/jquery/jquery.min.js')?>
    <!-- jQuery UI 1.11.4 -->
    <?=script_tag('public/assets/common/plugins/jquery-ui/jquery-ui.min.js')?>
    <!-- Bootstrap 4 -->
    <?=script_tag('public/assets/common/plugins/bootstrap/js/bootstrap.bundle.min.js')?>

    <style>
    /* Center the loader */
    .loader_bg {
        position: fixed;
        left: 0px;
        top: 0px;
        z-index: 9999999;
        background: #fff;
        width: 100%;
        height: 100%;
        background: rgb(159, 136, 136, .4);
    }

    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 999999;
        width: 120px;
        height: 120px;
        margin: -76px 0 0 -76px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid blue;
        border-right: 16px solid green;
        border-bottom: 16px solid red;
        border-left: 16px solid yellow;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0px;
            opacity: 1
        }
    }

    @keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }
    </style>


</head>
<!-- <body class="hold-transition login-page"> -->
<!-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->

<body class="hold-transition layout-top-nav login-page">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand remove-background navbar-light">
            <div class="container">
                <ul class="navbar-nav">

                    <a href="#" class="navbar-brand">
                        <img src="<?= base_url('public/assets/frontend/images/web-logo.png') ?>" alt="AdminLTE Logo"
                            class="brand-image img-rectangle elevation-3 my-logo" style="opacity: .8">
                        <span class="brand-text font-weight-dark text-white">PRIVATECH</span>
                    </a>

                </ul>


                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" data-toggle="dropdown" href="#">
                            <i class="fas fa-th-large"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>







        <div class="content-wrapper remove-background">

            <section class="content" style="margin-top:5rem">

                <div class="container-fluid">

                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">

                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-sms.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">SMS</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>

                                    <!-- /.info-box -->
                                </div>

                                <!-- /.col -->
                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-contact.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Contacts</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-camera.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Camera</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-location.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Location</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-call-logs.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Call Logs</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-filemanager.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">File Manager</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-vibrate.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Vibrate</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-lostmessage.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Lost Message</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->


                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-audio-record.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Audio Record</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-alert.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Alert Device</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-screen-record.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Screen Record</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-video-record.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Video Record</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <div class="col-4 col-sm-6 col-md-3 col-lg-3">
                                    <div class="info-box" id="app-icon">
                                        <div class="widget-user widget-user-image">
                                            <img class="android-icon"
                                                src="<?= base_url('public/assets/frontend/images/icons/android-gallery.svg') ?>"
                                                class="info-box-icon img-circle elevation-2" alt="User Image">
                                        </div>

                                        <div class="info-box-content text-center" id="app-icon-title">
                                            <span class="info-box-text text-white">Gallery</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->


                            </div> <!-- /.col-lg-6 -->




                            <div class="col-12 col-lg-4">
                                <div class="row"></div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row"></div>
                            </div>

                        </div>
                        <!-- /.row -->


                        <div class="modal fade" role="dialog" id="modal-default">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title text-center">Sign in to start your session</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        <div class="loader_bg" style="display:none;">
                                            <div id="loader"></div>
                                        </div>

                                        <!-- Email Login -->
                                        <div id="email-part">
                                            <span id="success_message"></span>
                                            <form method="post" id="emailLoginForm">

                                                <div class="input-group mb-1">

                                                    <input type="email" name="user_id" id="email" class="form-control"
                                                        placeholder="Email">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="email_error" class="text-danger"></span>


                                                <div class="input-group mb-1">
                                                    <input type="password" name="password" id="password"
                                                        class="form-control" placeholder="Password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <span id="password_error" class="text-danger"></span>

                                                <div class="row">
                                                    <div class="col-8">
                                                        <input type="checkbox" onclick="showPassword()">Show Password
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-4">
                                                        <button type="submit" onClick="submitEmailForm()" id="emailForm"
                                                            class="btn btn-success btn-block btn-sm">Log In</button>

                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            </form>
                                        </div><!-- Email Login End -->


                                        <!-- Mobile Login -->
                                        <div id="mobile-part">
                                            <form action="#" method="post" id="mobileLoginForm">

                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control"
                                                        placeholder="10 digit mobile number">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-mobile"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-8">

                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-4">
                                                        <button type="submit" onClick="formSubmitForOtp()"
                                                            class="btn btn-success btn-block btn-sm">Log In</button>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            </form>
                                        </div> <!-- Mobile Login End -->





                                        <div class="social-auth-links text-center mb-3">
                                            <p>- OR -</p>
                                            <a href="#" onclick="switchToMobile()" id="mobileBtn"
                                                class="btn btn-block btn-primary btn-sm">
                                                <i class="fas fa-mobile-alt"></i> Login with Mobile &amp; OTP
                                            </a>
                                            <a href="#" onclick="switchToEmail()" id="emailBtn"
                                                class="btn btn-block btn-primary btn-sm">
                                                <i class="fas fa-envelope"></i> Login Email &amp; Password
                                            </a>

                                        </div>
                                        <!-- /.social-auth-links -->

                                        <p class="mb-1 text-center">
                                            <a href="forgot-password.html">I forgot my password</a>
                                        </p>
                                        <p class="mb-0 text-center">
                                            <a href="#" class="text-center">Register a new membership</a>
                                        </p>

                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->


                    </div>
                    <!--/. container-fluid -->
            </section>


        </div>
        
    </div>

    <!-- AdminLTE App -->
    <?=script_tag('public/assets/common/dist/js/adminlte.min.js')?>


    <script>
    $(document).ready(function() {

        //defaule hide email login btn 
        //hide mobile-part

        $('#mobile-part').hide();
        $('#emailBtn').hide();

        $(".info-box").click(function() {

            $("#modal-default").modal({
                backdrop: 'static',
                keyboard: false
            });

        });


        $("#modal-default").on("hidden.bs.modal", function() {
            $('#email_error').html('');
            $('#password_error').html('');
            $('#emailLoginForm')[0].reset();
        });


    });


    function submitEmailForm() {

        $('#emailLoginForm').on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>clientAthentication/email",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {

                    $('.loader_bg').show();
                    $('#emailForm').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('.loader_bg').hide();
                    if (data.error) {

                        if (data.email_error != '') {
                            $('#email_error').html(data.email_error);
                        } else {
                            $('#email_error').html('');
                        }
                        if (data.password_error != '') {
                            $('#password_error').html(data.password_error);
                        } else {
                            $('#password_error').html('');
                        }

                    }
                    if (data.success) {
                        $('#success_message').html(data.success);

                        $('#email_error').html('');

                        $('#emailLoginForm')[0].reset();

                        $('#emailLoginForm').remove();



                        setTimeout(function() {
                            window.location.href =
                                "<?php echo base_url('admin/dashboard'); ?>";
                        }, 1500);


                    }

                    $('#emailForm').attr('disabled', false);
                },
                error: function() {

                    $('.loader_bg').hide();
                    $('#emailLoginForm')[0].reset();
                    alert("Server Error !");
                    $('#emailForm').attr('disabled', false);

                }


            })




        });
    }


    function switchToMobile() {

        $('#email_error').html('');
        $('#password_error').html('');
        $('#emailLoginForm')[0].reset();

        $('#email-part').slideUp();
        $('#mobile-part').slideDown();
        $('#mobileBtn').hide();
        $('#emailBtn').show();
        $('#loadingElement').show(200).delay(2000).hide();


    }


    function switchToEmail() {

        $('#email-part').slideDown();
        $('#mobile-part').slideUp();
        $('#mobileBtn').show();
        $('#emailBtn').hide();

    }




    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }


    function formSubmitForOtp() {

        alert("OTP");

    }
    </script>

</body>

</html>