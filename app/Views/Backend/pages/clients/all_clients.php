<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Clients</a></li>
                        <li class="breadcrumb-item active">Manage</li>
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
                        <h3 class="card-title">All Clients</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-block btn-success btn-sm" data-toggle="modal"
                                data-target="#modal-add">Add Client</button>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- Custom Filter -->
                        <table class="float-right">
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm" id='searchByStatus'>
                                        <option value=''>-- Status--</option>
                                        <option value='2'>Pending</option>
                                        <option value='1'>Active</option>
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
                                    <th>STATUS</th>
                                    <th>ACTION</th>

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




<!-- Add Modal-->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form role="form" action="<?= base_url('admin/members/createMember') ?>" method="post">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-8">

                                <div class="form-group input-group-sm">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" name="name" placeholder="Full Name"
                                        autocomplete="off" required>
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="" selected>Select</option>
                                        <option value="male" <?= set_value('gender')=='male'?'selected':'' ?>>MALE
                                        </option>
                                        <option value="female" <?= set_value('gender')=='male'?'selected':'' ?>>FEMALE
                                        </option>
                                        <option value="others" <?= set_value('gender')=='others'?'selected':'' ?>>OTHERS
                                        </option>

                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label for="exampleInputPassword1">Email ID *</label>
                                    <input type="email" class="form-control" name="email_id" placeholder="Email ID"
                                        required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group input-group-sm">

                                    <label for="password">Contact No *</label>
                                    <input type="text" class="form-control" name="contact" placeholder="Contact no"
                                        required autocomplete="off">

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group input-group-sm">
                                    <label for="password">User Type</label>
                                    <select class="form-control" name="user_type">
                                        <option value="member" selected>Member</option>
                                        <option value="admin">Admin</option>

                                    </select>

                                </div>


                            </div>
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">

                                    <label for="share_value">Share value *</label>
                                    <select class="form-control" name="share_value">
                                        <option value="" selected>Select</option>
                                        <option value="0">0</option>
                                        <option value="1000">1000</option>
                                        <option value="2000">2000</option>
                                        <option value="3000">3000</option>
                                        <option value="4000">4000</option>
                                        <option value="5000">5000</option>
                                        <option value="6000">6000</option>
                                        <option value="8000">8000</option>
                                        <option value="10000">10000</option>
                                        <option value="12000">12000</option>
                                    </select>
                                </div>
                            </div>


                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary swalDefaultSuccess">CREATE</button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>

</div> <!-- /.modal-dialog -->









<!-- Update Modal-->
<div class="modal fade" id="modal-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form role="form" action="<?= base_url('admin/members/updateMember') ?>" method="post">
                    <div class="card-body">
                    <input type="hidden" name="row_id" id="update_id" >    
                        <div class="row">
                            <div class="col-sm-8">

                                <div class="form-group input-group-sm">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" name="name" id="idName" placeholder="Full Name"
                                        autocomplete="off" required>
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" id="idGender">
                                        <option value="" selected>Select</option>
                                        <option value="male" <?= set_value('gender')=='male'?'selected':'' ?>>MALE
                                        </option>
                                        <option value="female" <?= set_value('gender')=='male'?'selected':'' ?>>FEMALE
                                        </option>
                                        <option value="others" <?= set_value('gender')=='others'?'selected':'' ?>>OTHERS
                                        </option>

                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label for="exampleInputPassword1">Email ID *</label>
                                    <input type="email" class="form-control" name="email_id" id="idEmail" placeholder="Email ID"
                                        required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group input-group-sm">

                                    <label for="password">Contact No *</label>
                                    <input type="text" class="form-control" name="contact" id="idContact" placeholder="Contact no"
                                        required autocomplete="off">

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group input-group-sm">
                                    <label for="password">User Type</label>
                                    <select class="form-control" name="user_type" id="idType">
                                        <option value="member" selected>Member</option>
                                        <option value="admin">Admin</option>

                                    </select>

                                </div>


                            </div>
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">

                                    <label for="share_value">Status</label>
                                    <select class="form-control" name="status" id="idStatus">
                                        <option value="" selected>Select</option>
                                        <option value="1">Active</option>
                                        <option value="2">Disabled</option>
                                    </select>
                                </div>
                            </div>


                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary swalDefaultSuccess">UPDATE</button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>

</div> <!-- /.modal-dialog -->



        <!--Delete Modal-->        
        <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content bg-light">
            <div class="modal-header">
              <h4 class="modal-title">Delete Member</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">                
                <p>Are You sure to <strong>Delete</strong> the Member <strong><span id = "delName"></span></strong>   ?</p>                            
                <form action="<?php echo base_url('admin/members/deleteMember') ?>" method="post">                    
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




<script>
var site_url = "<?php echo site_url(); ?>";

$(document).ready(function() {

    $("#memberTree").addClass('menu-open');
    $("#memberMenu").addClass('active');
    $("#memberSubMenuManage").addClass('active');


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
            url: site_url + "/admin/clients/ajaxCallAllClients", // json datasource
            type: "post",
            data: function(data) {
                // key1: value1 - in case if we want send data with request      
                var type = $('#searchByStatus').val();
                // Append to data
                data.status = type;
            }
        },
        columns: [{
                data: "u_id"
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
                data: "subscription"
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
            {
                mRender: function(data, type, row) {
                    return '<button class="btn btn-outline-warning btn-xs edit-button" data-toggle="modal" data-target="#modal-update" data-id="' + row.u_id + '"  data-name="' + row.name + '"   data-gender="' + row.gender + '" data-email="' + row.email + '" data-mobile="' + row.mobile + '" data-status="' + row.status + '"  data-share="' + row.share + '" data-type="' + row.user_type + '"  >Edit</button> <button class="btn btn-outline-danger btn-xs del-button" data-toggle="modal" data-target="#modal-delete" data-id="' + row.u_id + '" data-name="' + row.name + '" >Del</button>'
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