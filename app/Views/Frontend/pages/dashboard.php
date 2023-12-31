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
            
                        <span class="text-white"><?= $device; ?><span>
                       
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

                <div class="col-lg-12">


                    <section class="content" style="margin-top:2rem">

                        <div class="container-fluid">

                            <!-- Info boxes -->
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="row">

                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">

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
                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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
                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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
                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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
                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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
                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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
                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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

                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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


                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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

                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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

                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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

                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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

                                        <div class="col-4 col-sm-3 col-md-3 col-lg-2">
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

                                </div>
                                <!-- /.row -->




                            </div>

                        </div>
                        <!--/. container-fluid -->
                    </section>




                </div>

            </div>




        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->




  








</div>


<script>
$(document).ready(function() {

    //defaule hide email login btn 
    //hide mobile-part

    $('#mobile-part').hide();
    $('#emailBtn').hide();


    $("#modal-password").on("hidden.bs.modal", function() {
        $('#passwordForm')[0].reset();
    });

});






</script>