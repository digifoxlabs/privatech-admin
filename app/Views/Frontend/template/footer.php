<!-- Logout Modal -->
<div class="modal fade" id="modal-logout">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Logout</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
                
                <a href="<?php echo base_url('client/logout') ?>" class="btn btn-outline-light">Logout</a>
<!--              <button type="button" class="btn btn-outline-light">Logout</button>-->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



<!-- Password Modal -->
<div class="modal fade" role="dialog" id="modal-password">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-gray-light">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Reset password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="loader_bg" style="display:none;">
                        <div id="loader"></div>
                    </div>

                    <span id="message"></span>

                    <form method="post" id="passwordForm">


                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <span id="password_error" class="text-danger"></span>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="passconf" placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <span id="passconf_error" class="text-danger"></span>

                        <div class="row">
                            <div class="col-8"></div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" onClick="resetPasswordForm()" id="passwordFormBtn"
                                    class="btn btn-success btn-block btn-sm">Reset</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>


                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  



</div><!-- Wrapper -->


<<script>
  function resetPasswordForm() {

$('#passwordForm').on("submit", function(event) {
    event.preventDefault();

    $.ajax({
        url: "<?php echo base_url(); ?>dashboard/setNewPassword",
        method: "POST",
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {

            $('.loader_bg').show();
            $('#passwordFormBtn').attr('disabled', 'disabled');
        },
        success: function(data) {
            $('.loader_bg').hide();
            if (data.error) {

                if (data.password_error != '') {
                    $('#password_error').html(data.password_error);
                } else {
                    $('#password_error').html('');
                }
                if (data.confpass_error != '') {
                    $('#passconf_error').html(data.passconf_error);
                } else {
                    $('#passconf_error').html('');
                }

            }
            if (data.success) {

                $('#message').html(data.message);
                setTimeout(function() {
                    $('.loader_bg').show();
                    window.location.href =
                        "<?php echo base_url('dashboard'); ?>";
                }, 500);

            }


            $('#passwordFormBtn').attr('disabled', false);
        },
        error: function() {

            $('.loader_bg').hide();
            $('#passwordForm')[0].reset();
            alert("Server Error !");
            $('#passwordFormBtn').attr('disabled', false);

        }

    })

});
}
</script>







<?=script_tag('public/assets/common/dist/js/adminlte.min.js')?>





<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<?=script_tag('public/assets/common/plugins/bootstrap/js/bootstrap.bundle.min.js')?>

<!-- ChartJS -->
<?=script_tag('public/assets/common/plugins/chart.js/Chart.min.js')?>

<!-- Sparkline -->
<?=script_tag('public/assets/common/plugins/sparklines/sparkline.js')?>

<!-- JQVMap -->
<?=script_tag('public/assets/common/plugins/jqvmap/jquery.vmap.min.js')?>
<?=script_tag('public/assets/common/plugins/jqvmap/maps/jquery.vmap.usa.js')?>

<!-- jQuery Knob Chart -->
<?=script_tag('public/assets/common/plugins/jquery-knob/jquery.knob.min.js')?>

<!-- daterangepicker -->
<?=script_tag('public/assets/common/plugins/moment/moment.min.js')?>
<?=script_tag('public/assets/common/plugins/daterangepicker/daterangepicker.js')?>

<!-- Tempusdominus Bootstrap 4 -->
<?=script_tag('public/assets/common/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>

<!-- Summernote -->
<?=script_tag('public/assets/common/plugins/summernote/summernote-bs4.min.js')?>

<!-- overlayScrollbars -->
<?=script_tag('public/assets/common/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>

<!-- AdminLTE App -->
<?=script_tag('public/assets/common/dist/js/adminlte.js')?>



<!-- Nanobar -->
<?= script_tag('public/assets/common/dist/js/nanobar.js') ?>
<script>
	var simplebar = new Nanobar();
			simplebar.go(100);
</script>


<!-- DataTables -->
<script src="<?= base_url("public/assets/common/plugins/datatables/jquery.dataTables.min.js")  ?>"></script>
<script src="<?= base_url("public/assets/common/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")  ?>"></script>
<script src="<?= base_url("public/assets/common/plugins/datatables-responsive/js/dataTables.responsive.min.js")  ?>"></script>
<script src="<?= base_url("public/assets/common/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")  ?>"></script>

<!--Datatable Button-->

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>



</body>

</html>