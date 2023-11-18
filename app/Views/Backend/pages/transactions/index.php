<style>
table.dataTable td {
  font-size: 1em;
}
table.dataTable th {
  font-size: 0.9em;
}

table.dataTable tr.dtrg-level-0 td {
  font-size: 0.1em;
}


</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transactions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transactions</a></li>
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
                        <h3 class="card-title">All Transactions</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-block btn-success btn-sm" data-toggle="modal"
                                data-target="#modal-add">Add</button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">

                        <!-- Custom Filter -->
                        <table class="float-right" >
                            <tr>
                                <td>
                                    <select class="form-control form-control-sm" id='searchByStatus'>
                                        <option value=''>-- Status--</option>
                                        <option value='1'>Pending</option>
                                        <option value='2'>Success</option>
                                    </select>
                                </td>
                            </tr>
                        </table>


                        <table id="dataTable" class="table table-xs text-nowrap">
                            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Txn ID</th>                
                                    <th>Dated</th>
                                    <th>Client</th>
                                    <th>Number</th>
                                    <th>Type</th>
                                    <th>validity</th>
                                    <th>Mode</th>
                                    <th>Amt</th>
                                    <th>Tax</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Package</th>
                                    <th>Act Code</th>
                                    <th>Coupon</th>
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
        responsive: true,
        scrollCollapse: true,
        ajax: {
            url: site_url + "/admin/transactions/ajaxCallAllTxn", // json datasource
            type: "post",
            data: function(data) {
                // key1: value1 - in case if we want send data with request      
                var type = $('#searchByStatus').val();
                // Append to data
                data.status = type;
            }
        },
        columns: [{
                data: "t_id"
            },
            {
                data: "txn_id"
            },
            {
                data: "created_at"
            },
            {
                data: "name"
            },
            {
                data: "mobile"
            },   
            {
                data: "txn_type"
            },           
            {
                data: "plan_validity_days"
            },           
             {
                data: "txn_mode"
            },           
             {
                data: "net_amount"
            },            
            {
                data: "tax_amt"
            },           
             {
                data: "price"
            },            
            {
                data: "discount_amt"
            },            
            {
                data: "package_name"
            },            
            {
                data: "activation_code"
            },            
            {
                data: "coupon_code"
            },
            {
                mRender: function(data, type, row) {
                    if (row.status == 2) {
                        return '<span class="badge bg-success">Success</span>';
                    } else {
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                }
            },

        ],
        columnDefs: [     
            {
                orderable: false,
                searchable: false,
                targets: [0,1,4,5,6,7,8,9,10,11,12,13,14]
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