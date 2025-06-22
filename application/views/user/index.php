<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 480px;">
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
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary col-sm-12">
                            <!-- <h5 class="card-title">Monthly Recap Report</h5> -->
                            <!-- <div class="col-sm-8">
                            </div> -->
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a href="<?= base_url(); ?>/user/edit" class="dropdown-item">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row justify-content-center">
                                <div class="info-box mb-4 bg-warning">
                                    <span class="info-box-icon bg-warning elevation-1">
                                        <!-- <i class="fas fa-users"></i> -->
                                        <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="card-img">
                                    </span>

                                    <div class="info-box-content align-content-center">
                                        <span class="info-box-text">
                                            <h5 class="card-title"><?= $user['name']; ?></h5>
                                        </span>
                                        <span class="info-box-text"><?= $user['email']; ?></span>
                                        <span class="info-box-text">
                                            <small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small>
                                        </span>
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