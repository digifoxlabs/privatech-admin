<!-- Logout Modal -->
<div class="modal fade" id="modal-logout">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
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
                
                <a href="<?php echo base_url('admin/logout') ?>" class="btn btn-outline-light">Logout</a>
<!--              <button type="button" class="btn btn-outline-light">Logout</button>-->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="#">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


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

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<?=script_tag('public/assets/common/dist/js/pages/dashboard.js')?>

<!-- AdminLTE for demo purposes -->
<?=script_tag('public/assets/common/dist/js/demo.js')?>


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
