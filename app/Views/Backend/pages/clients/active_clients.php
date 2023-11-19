<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Active Subscriptions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Clients</a></li>
                        <li class="breadcrumb-item active">Active Subscriptons</li>
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
                        <h3 class="card-title">Active Subscriptions</h3>
                        <div class="card-tools">
                          <span><a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-long-arrow-alt-left mr-1"></i>Back</a></span>

                        </div>
                    </div>
                    <div class="card-body">

                        <!-- Custom Filter -->
                        <table class="float-right">
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm" id='searchByStatus'>
                                        <option value=''>-- Status--</option>
                                        <option value='1'>Active</option>
                                        <option value='2'>Disabled</option>
                                    </select>
                                </td>
                            </tr>
                        </table>


                        <table id="dataTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>                
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Subscription</th>
                                    <th>Status</th>
                   

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script>
var site_url = "<?php echo site_url(); ?>";

$(document).ready(function() {

    var i = 1;

    $("#clientTree").addClass('menu-open');
    $("#clientMenu").addClass('active');
    $("#clientSubMenuActive").addClass('active');


    var dataTable = $('#dataTable').DataTable({
        lengthMenu: [
            [10, 30, -1],
            [10, 30, "All"]
        ], // page length options
        bProcessing: true,
        serverSide: true,
        scrollY: "400px",
        scrollCollapse: true,
        ajax: {
            url: site_url + "/admin/clients/ajaxCallAllClientsActive", // json datasource
            type: "post",
            data: function(data) {
                // key1: value1 - in case if we want send data with request      
                var type = $('#searchByStatus').val();
                // Append to data
                data.status = type;
            }
        },
        columns: [{
            mRender: function(data, type, full, meta) {
                    return i++;
                }
            },
            {
                data: "name"
            },
            {
                data: "mobile"
            },
            {
                data: "email"
            },
            {
                mRender: function(data, type, row) {
                    if (row.subscription > 0) {
                        return '<span class="badge bg-success">YES</span>';
                    } else {
                        return '<span class="badge bg-warning">NO</span>';
                    }
                }
            },
            {
                mRender: function(data, type, row) {
                    if (row.status == 1) {
                        return '<span class="badge bg-success">ACTIVE</span>';
                    } else {
                        return '<span class="badge bg-warning">DISABLED</span>';
                    }
                }
            },

        ],
        columnDefs: [     

            {
                orderable: false,
                targets: [0, 1, 2, 3]
            },
            {
                className: 'text-center',
                targets: [1, 2, 3, 4, 5]
            },
            {
                "targets": [1, 2, 3, 4, 5],
                "render": function(data) {
                    return data.toUpperCase();
                },
            },

        ],
        bFilter: true, // to display datatable search
    });


    $('#searchByStatus').change(function() {
        dataTable.draw();
    });



    // Handle the "Edit" button click event
    $('#dataTable tbody').on('click', '.edit-button', function () {
        var data = dataTable.row($(this).parents('tr')).data();
        var edit_id = $(this).data('id');
        var edit_name = $(this).data('name');
        var edit_gender = $(this).data('gender');
        var edit_email = $(this).data('email');
        var edit_mobile = $(this).data('mobile');
        var edit_type= $(this).data('type');
        var edit_status= $(this).data('status');

       $('#update_id').val(edit_id);
       $('#idName').val(edit_name);
       $('#idGender').val(edit_gender);
       $('#idEmail').val(edit_email);
       $('#idContact').val(edit_mobile);
       $('#idStatus').val(edit_status);
       $('#idType').val(edit_type);
    });


    
    $('#modal-delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var todo_id = button.data('id')  
      var todo_name = button.data('name')
  
      var modal = $(this)  
      modal.find('.modal-body #del_id').val(todo_id)
      modal.find('.modal-body #delName').text(todo_name)  

    }); 




});










</script>