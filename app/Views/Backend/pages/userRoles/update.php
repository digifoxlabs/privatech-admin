<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Role</h1>
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



                    <form role="form" action="<?php base_url('admin/users/Roles/update') ?>" method="post">


                    <input type="hidden" name="row_id" value="<?= $group_id; ?>">

                        <div class="card-body">   
                        <?php// echo validation_errors(); ?>

                        <span class="text-danger mb-1"><?= validation_show_error('role_name') ?></span>
                        <div class="form-group">
                          <label for="group_name">Role Name</label>
                          <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name" value="<?php echo $group_data['group_name']; ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            
                          <label for="permission">Permission</label>

                          <?php $serialize_permission = unserialize($group_data['permissions']); ?>

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
                                <td> <input type="checkbox" name="permission[]" id="permission" value="createClient"  <?php if($serialize_permission) { if(in_array('createClient', $serialize_permission)) { echo "checked"; } 
                                } ?>     > </td>  
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateClient"  <?php if($serialize_permission) { if(in_array('updateClient', $serialize_permission)) { echo "checked"; } 
                                } ?> > </td>  
                                <td> <input type="checkbox" name="permission[]" id="permission" value="viewClient"   <?php if($serialize_permission) { if(in_array('viewClient', $serialize_permission)) { echo "checked"; } 
                                } ?> > </td>  
                                <td> <input type="checkbox" name="permission[]" id="permission" value="deleteClient"  <?php if($serialize_permission) { if(in_array('deleteClient', $serialize_permission)) { echo "checked"; } 
                                } ?>  > </td>
                              
                              </tr>           
                                
                            <tr>
                                <td>Dealers</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createDealer"  <?php if($serialize_permission) { if(in_array('createDealer', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateDealer" <?php if($serialize_permission) { if(in_array('updateDealer', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewDealer" <?php if($serialize_permission) { if(in_array('viewDealer', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteDealer" <?php if($serialize_permission) { if(in_array('deleteDealer', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                            </tr>
                            
                            <tr>
                                <td>Packages</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createPackage" <?php if($serialize_permission) { if(in_array('createPackage', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updatePackage" <?php if($serialize_permission) { if(in_array('updatePackage', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewPackage" <?php if($serialize_permission) { if(in_array('viewPackage', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deletePackage" <?php if($serialize_permission) { if(in_array('deletePackage', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                              </tr>   
                              
                                             
                            <tr>
                                <td>Transactions</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createTransaction" <?php if($serialize_permission) { if(in_array('createTransaction', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateTransaction" <?php if($serialize_permission) { if(in_array('updateTransaction', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewTransaction" <?php if($serialize_permission) { if(in_array('viewTransaction', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteTransaction" <?php if($serialize_permission) { if(in_array('deleteTransaction', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                            </tr>
                                                                  
                            <tr>
                                
                            <td>Reports</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createReport" <?php if($serialize_permission) { if(in_array('createReport', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateReport" <?php if($serialize_permission) { if(in_array('updateReport', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewReport" <?php if($serialize_permission) { if(in_array('viewReport', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteReport" <?php if($serialize_permission) { if(in_array('deleteReport', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                            </tr>
                                                         
                              <tr>
                                <td>Users</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createUser" <?php if($serialize_permission) { if(in_array('createUser', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td> <input type="checkbox" name="permission[]" id="permission" value="updateUser" <?php if($serialize_permission) { if(in_array('updateUser', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" <?php if($serialize_permission) { if(in_array('viewUser', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" <?php if($serialize_permission) { if(in_array('deleteUser', $serialize_permission)) { echo "checked"; } 
                                } ?> ></td>
                              </tr>
                                
                                
                              <tr>
                                <td>Roles</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createRole" <?php if($serialize_permission) { if(in_array('createRole', $serialize_permission)) { echo "checked"; }  }?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateRole" <?php if($serialize_permission) { if(in_array('updateRole', $serialize_permission)) { echo "checked"; }  }?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewRole" <?php if($serialize_permission) { if(in_array('viewRole', $serialize_permission)) { echo "checked"; }  }?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteRole" <?php if($serialize_permission) { if(in_array('deleteRole', $serialize_permission)) { echo "checked"; }  }?> ></td>
                              </tr>  
                         
                                
                              <tr>
                                <td>Settings</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createSetting" <?php if($serialize_permission) { if(in_array('createSetting', $serialize_permission)) { echo "checked"; }  }?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" <?php if($serialize_permission) { if(in_array('updateSetting', $serialize_permission)) { echo "checked"; }  }?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewSetting" <?php if($serialize_permission) { if(in_array('viewSetting', $serialize_permission)) { echo "checked"; }  }?> ></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteSetting" <?php if($serialize_permission) { if(in_array('deleteSetting', $serialize_permission)) { echo "checked"; }  }?> ></td>
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