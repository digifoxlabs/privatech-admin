<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shares</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Shares</a></li>
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
                        <h3 class="card-title"><?= $cardTitle; ?></h3>
                        <div class="card-tools">
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
                                    <th>Share</th>
                                    <th>Default Period</th>
                                    <th>Custom Period</th>
                                    <th>Start From</th>
                                    <th>End On</th>
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



<!-- Update Modal-->
<div class="modal fade" id="modal-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Share</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form start -->
                <form role="form" action="<?= base_url('admin/members/updateShare') ?>" method="post">
                    <div class="card-body">
                        <input type="hidden" name="row_id" id="update_id">
                        <div class="row">
                            <div class="col-sm-8">

                                <div class="form-group input-group-sm">

                                    <label for="share_value">Share value *</label>
                                    <select class="form-control" name="share_value" id="idShare">
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

                            <div class="col-sm-4">
      
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label for="idDefaultPeriod">Default period</label>
                                    <input type="text" class="form-control" name="default_period" id="idDefaultPeriod"
                                        placeholder="Default Period" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">

                            <div class="form-group input-group-sm">
                                    <label for="idCustomPeriod">Custom period</label>
                                    <input type="text" class="form-control" name="custom_period" id="idCustomPeriod"
                                        placeholder="Custom Period" autocomplete="off">
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group input-group-sm">
                                    <label for="password">Start From</label>
                                    <input type="date" class="form-control" name="start_from" id="idStart" >
                                </div>

                            </div>
                            <div class="col-sm-6">
                            <div class="form-group input-group-sm">
                                    <label for="password">End on</label>
                                    <input type="date" class="form-control" name="end_on" id="idEnd" >
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
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are You sure to <strong>Delete</strong> the Share of <strong><span id="delName"></span></strong> ?</p>
                <form action="<?php echo base_url('admin/members/deleteShare') ?>" method="post">
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
    $("#memberSubMenuShare").addClass('active');


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
            url: site_url + "/admin/members/ajaxCallAllShares", // json datasource
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
                data: "share_amount"
            },
            {
                data: "default_period"
            },
            {
                data: "custom_period"
            },
            {
                "data": "start_from",
                "render": function(data) {
                    // Format the date as "dd mm yyyy"
                    var date = new Date(data);
                    var dd = String(date.getDate()).padStart(2, '0');
                    var mm = String(date.getMonth() + 1).padStart(2, '0'); // January is 0
                    var yyyy = date.getFullYear();
                    return dd + '-' + mm + '-' + yyyy;
                }
            },
            {
                data: "end_on",
                "render": function(data) {
                    // Format the date as "dd mm yyyy"
                    var date = new Date(data);
                    var dd = String(date.getDate()).padStart(2, '0');
                    var mm = String(date.getMonth() + 1).padStart(2, '0'); // January is 0
                    var yyyy = date.getFullYear();
                    return dd + '-' + mm + '-' + yyyy;
                }
            },
            {
                mRender: function(data, type, row) {
                    return '<button class="btn btn-outline-warning btn-xs edit-button" data-toggle="modal" data-target="#modal-update" data-id="' + row.u_id + '" data-share="' + row.share_amount + '" data-defaultperiod="' + row.default_period + '" data-customperiod="' + row.custom_period + '" data-startfrom="' + row.start_from + '" data-endon="' + row.end_on + '" >Edit</button> <button class="btn btn-outline-danger btn-xs del-button" data-toggle="modal" data-target="#modal-delete" data-id="' + row.u_id + '" data-name="' + row.name + '" >Del</button>'
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
                targets: [1, 2, 3, 4]
            },
            {
                "targets": [1, 2],
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
    $('#dataTable tbody').on('click', '.edit-button', function() {
        var data = dataTable.row($(this).parents('tr')).data();
        var edit_id = $(this).data('id');
        var edit_share = $(this).data('share');
        var edit_defaultPeriod= $(this).data('defaultperiod');
        var edit_customPeriod = $(this).data('customperiod');
        var edit_startFrom = $(this).data('startfrom');
        var edit_endOn = $(this).data('endon');

        $('#update_id').val(edit_id);
        $('#idShare').val(edit_share);
        $('#idDefaultPeriod').val(edit_defaultPeriod);
        $('#idCustomPeriod').val(edit_customPeriod);
        $('#idStart').val(edit_startFrom);
        $('#idEnd').val(edit_endOn);

    });



    $('#modal-delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var todo_id = button.data('id')
        var todo_name = button.data('name')

        var modal = $(this)
        modal.find('.modal-body #del_id').val(todo_id)
        modal.find('.modal-body #delName').text(todo_name)

    });




});
</script>