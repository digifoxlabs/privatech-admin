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
                                    <th>Action</th>

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
            {
                mRender: function(data, type, row) {
                    return '<a href="<?= base_url('admin/clients/view') ?>' + '/' + row.u_id +
                            '" class="btn btn-outline-info btn-xs" >VIEW</a>'
                }
            },
        ],
        columnDefs: [     
            {
                orderable: false,
                searchable: false,
                targets: 0
            },
            {
                className: 'text-center',
                targets: [1, 2, 3, 4, 5,6]
            },
            {
                "targets": [1, 2, 3, 4, 5],
                "render": function(data) {
                    return data.toUpperCase();
                },
            },
        ],
        "order": [[ 1, 'asc' ]],
        bFilter: true, // to display datatable search

        "drawCallback": function(settings) {
            var api = this.api();
            var startIndex = api.context[0]._iDisplayStart;

            api.column(0).nodes().each(function(cell, i) {
                cell.innerHTML = startIndex + i + 1;
            });
        }

    });


    $('#searchByStatus').change(function() {
        dataTable.draw();
    });




});

</script>