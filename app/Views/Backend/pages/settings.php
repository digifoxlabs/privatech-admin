<div class="content-wrapper">
    <?php  $session = session(); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header mb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
        <div class="container-fluid">

            <script type="text/javascript">
            <?php if($session->getFlashdata('success')): ?>
            toastr.success('<?php echo $session->getFlashdata('success'); ?>')
            <?php elseif($session->getFlashdata('error')): ?>
            toastr.warning('<?php echo $session->getFlashdata('error'); ?>')
            <?php endif; ?>
            </script>

            <div class="row">

                <div class="col-sm-6 col-md-4">
                    <!-- Horizontal Form -->
                    <div class="card card-primary">
                        <div class="card-header bg-lightblue">
                            <h3 class="card-title">Site Title</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="">

                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $settings[0]['id']; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Site Title</label>
                                    <input type="text" class="form-control" name="value" value="<?= $settings[0]['site_title']; ?>">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-default float-right">Save</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>


                <div class="col-sm-6 col-md-4">
                    <!-- Horizontal Form -->
                    <div class="card card-primary">
                        <div class="card-header bg-lightblue">
                            <h3 class="card-title">Site Footer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="">

                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $settings[1]['id']; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Site Footer</label>
                                    <input type="text" class="form-control" name="value" value="<?= $settings[1]['site_footer']; ?>">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-default float-right">Save</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-sm-6 col-md-4">
                    <!-- Horizontal Form -->
                    <div class="card card-primary">
                        <div class="card-header bg-lightblue">
                            <h3 class="card-title">GST Rate</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="">

                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $settings[2]['id']; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">GST Rate</label>
                                    <input type="text" class="form-control" name="value" value="<?= $settings[2]['gst_rate']; ?>">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-default float-right">Save</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>











            </div>








        </div>





</div>
</section>
</div>

<script>
$(document).ready(function() {


    $("#settingsMenu").addClass('active');

    //Bootstrap Switch Mode    
    //     $("input[data-bootstrap-switch]").each(function(){
    //      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    //    });




    $('#modal-update').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        var todo_id = button.data('todo').id
        var todo_name = button.data('todo').name
        var todo_status = button.data('todo').status

        var modal = $(this)

        modal.find('.modal-body #id_E').val(todo_id)
        modal.find('.modal-body #name_E').val(todo_name)
        modal.find('.modal-body #status_E').val(todo_status)


    });


    $('#modal-delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        var todo_id = button.data('todo').id
        var todo_name = button.data('todo').name


        var modal = $(this)

        modal.find('.modal-body #id').val(todo_id)
        modal.find('.modal-body #delName').text(todo_name)


    });








});
</script>