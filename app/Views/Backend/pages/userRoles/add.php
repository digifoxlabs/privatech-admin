<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Role</h1>
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
                    <span><a href="<?= base_url('admin/users/Roles') ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-long-arrow-alt-left mr-1"></i>Back</a></span>

                        <div class="card-tools">
                   
                        </div>
                    </div>
                    <div class="card-body">



                    <form role="form" action="<?php base_url('admin/users/Roles/new') ?>" method="post">
                        <div class="card-body">   
                        <?php// echo validation_errors(); ?>

                        <span class="text-danger mb-1"><?= validation_show_error('role_name') ?></span>
                        <div class="form-group">
                          <label for="group_name">Role Name</label>
                          <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            
                          <label for="permission">Permission</label>

                          <table class="table table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>View</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                                
                            <tr>
                                <td>Clients</td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="createClient"> </td>  
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateClient"> </td>  
                                <td> <input type="checkbox" name="permission[]" id="permission" value="viewClient"> </td>  
                                <td> <input type="checkbox" name="permission[]" id="permission" value="deleteClient"> </td>
                              
                              </tr>           
                                
                            <tr>
                                <td>Dealers</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createDealer"></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateDealer"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewDealer"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteDealer"></td>
                            </tr>
                            
                            <tr>
                                <td>Packages</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createPackage"></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updatePackage"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewPackage"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deletePackage"></td>
                              </tr>   
                              
                                             
                            <tr>
                                <td>Transactions</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createTransaction"></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateTransaction"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewTransaction"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteTransaction"></td>
                            </tr>
                                                                  
                            <tr>
                                
                            <td>Reports</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createReport"></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateReport"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewReport"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteReport"></td>
                            </tr>
                                                         
                              <tr>
                                <td>Users</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createUser"></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateUser"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewUser"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser"></td>
                              </tr>
                                
                                
                            <tr>
                                <td>Roles</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createRole"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateRole"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewRole"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteRole"></td>
                            </tr>  
                         
                                
                            <tr>
                                <td>Settings</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createSetting"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewSetting"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteSetting"></td>
                              </tr>    
                                
                            <tr>                              
                
                            </tbody>
                          </table>

                        </div>


                          <div class="card-footer">
                            <a href="<?php echo base_url('admin/users/Roles') ?>" class="btn btn-warning btn-sm">Back</a>
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                          </div>
                       
                         </div>  
                    </form>






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


    $("#employeeTree").addClass('menu-open');
    $("#employeeMenu").addClass('active');
    $("#employeeSubMenuRoles").addClass('active');




});

</script>