<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $pageTitle; ?></title>
    <!-- <link rel="icon" type="image/x-icon" href="<?= base_url('public/assets/frontend/images/favicon-32x32.png') ?>"> -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/assets/frontend/images/favicon/apple-touch-icon.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/assets/frontend/images/favicon/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/assets/frontend/images/favicon/favicon-16x16.png') ?>">
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

    <!-- Toastr -->
     <?=link_tag('public/assets/common/plugins/toastr/toastr.min.css')?>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

      <!-- DataTables -->
  <?=link_tag('public/assets/common/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>
  <?=link_tag('public/assets/common/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>
  <!-- DataTable Button-->
  <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
  
  <!-- overlayScrollbars -->
  <?=link_tag('public/assets/common/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>  
  
  <!-- Daterange picker -->
  <?=link_tag('public/assets/common/plugins/daterangepicker/daterangepicker.css')?>  
  
  <!-- summernote -->
  <?=link_tag('public/assets/common/plugins/summernote/summernote-bs4.css')?>  



    <?=script_tag('public/assets/common/plugins/jquery/jquery.min.js')?>
    <!-- jQuery UI 1.11.4 -->
    <?=script_tag('public/assets/common/plugins/jquery-ui/jquery-ui.min.js')?>


  
    <?= script_tag('public/assets/common/plugins/sweetalert2/sweetalert2.min.js') ?>
    <!-- Toastr -->
    <?= script_tag('public/assets/common/plugins/toastr/toastr.min.js') ?>



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