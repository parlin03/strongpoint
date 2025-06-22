<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                </div><!-- /.col -->
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div>/.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h5 class="card-title">Monthly Recap Report</h5> -->
                            <!-- notif error -->
                            <?= form_error('menu', '<div class="alert alert-danger" role ="alert">', '</div>'); ?>

                            <!-- notif sukses -->
                            <?= $this->session->flashdata('message'); ?>
                            <div class="row justify-content-end">
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newRoleModal"> Add New Role</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="info-box mb-10">
                                    <div class="table table-responsive">
                                        <table class="table table-bordered table-striped table-hover ">
                                            <thead class="text-center text-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>

                                                <?php foreach ($role as $r) : ?>

                                                    <tr>
                                                        <th class="text-center" scope="row"><?= $i; ?>
                                                        </th>
                                                        <td><?= $r['role']; ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('menu/roleaccess/') . $r['id']; ?>" class="badge badge-warning">access</a>
                                                            <a href="" class="badge badge-success">edit</a>
                                                            <a href="" class="badge badge-danger">delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>

                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal Add New Role -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/role'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Add New Role -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>