<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <?php
    $session = session(); ?>

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
    <section class="content">


        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                    <span><a href="<?= base_url('admin/users') ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-long-arrow-alt-left mr-1"></i>Back</a></span>

                        <div class="card-tools">
                   
                                <a href="<?= base_url('admin/users/Roles/new') ?>" class="btn btn-block btn-success btn-sm">Create Roles</a>
                        </div>
                    </div>
                    <div class="card-body">

          
                        <table id="dataTable" class="table table-sm table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role Name</th>               
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                        <?php
                        $count = 0;
                        foreach ($roles as $list) :
                        ?>
                            <tr style="text-align:center;">
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo strtoupper($list['group_name']); ?></td>
                                <td style="text-align:center;">

                                <a href="<?php echo base_url('admin/users/Roles/update/'.$list['g_id']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> 

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" data-todo='{"id":"<?= $list['g_id']; ?>","name":"<?= $list['group_name']; ?>"}'><i class="fa fa-trash"></i></button>  
                                
                                </td>

                            </tr>

                        <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

<!--Delete Modal-->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h4 class="modal-title">Delete Coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are You sure to <strong>Delete</strong> the Role <strong><span id="delName"></span></strong> ?</p>
                <form action="<?= base_url('admin/users/Roles/delete') ?>" method="post">
                    <input type="hidden" name="row_id" id="del_id">

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Confirm</button>
                    </div>

                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal end -->



</div>
<!-- /.content-wrapper -->



<script>



$(document).ready(function() {



    $("#employeeTree").addClass('menu-open');
    $("#employeeMenu").addClass('active');
    $("#employeeSubMenuRoles").addClass('active');

    var dataTable = $('#dataTable').DataTable({
     
            "columnDefs": [ 
                {
                orderable: false,
                searchable: false,
                targets: 0
            },
            {
                className: 'text-center',
                targets: [0,1,2]
            },
            {
                "targets": [1],
                "render": function(data) {
                    return data.toUpperCase();
                },
            },            
            
            ]

    });



    $('#modal-delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var todo_id = button.data('todo').id  
        var todo_name = button.data('todo').name  

        var modal = $(this)
        modal.find('.modal-body #del_id').val(todo_id)
        modal.find('.modal-body #delName').text(todo_name)

    });
 



});





</script>