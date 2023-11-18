<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>New Client</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Clients</a></li>
                        <li class="breadcrumb-item active">New</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Client</h3>
                        <div class="card-tools">
                            <span><a href="<?= base_url('admin/allClients') ?>" class="btn btn-outline-info btn-sm"><i
                                        class="fas fa-long-arrow-alt-left mr-1"></i>Back</a></span>

                        </div>
                    </div>
                    <div class="card-body">


                        <form action="<?= base_url('admin/clients/add') ?>" method="post" class="form-horizontal">

                            <span class="text-danger mb-1"><?= validation_show_error('name') ?></span>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="<?= set_value('name') ?>"
                                        placeholder="Name">
                                </div>
                            </div>

                            <span class="text-danger mb-1"><?= validation_show_error('email') ?></span>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email"
                                        value="<?= set_value('email') ?>" placeholder="Email">
                                </div>
                            </div>

                            <span class="text-danger mb-1"><?= validation_show_error('mobile') ?></span>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Mobile</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="mobile"
                                        value="<?= set_value('mobile') ?>" placeholder="10 digit mobile no">
                                </div>
                            </div>

                            <span class="text-danger mb-1"><?= validation_show_error('status') ?></span>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status">
                                        <option value="" selected>Select</option>
                                        <option value="1" selected>Active </option>
                                        <option value="2">Disabled </option>
                                    </select>
                                </div>
                            </div>

                            <span class="text-danger mb-1"><?= validation_show_error('password') ?></span>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <span class="text-danger mb-1"><?= validation_show_error('passconf') ?></span>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="passconf">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Add</button>
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