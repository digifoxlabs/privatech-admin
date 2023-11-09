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



</div><!-- Wrapper -->

<?=script_tag('public/assets/common/dist/js/adminlte.min.js')?>
</body>

</html>