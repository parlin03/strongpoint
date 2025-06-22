<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                    <br><a href="<?= base_url('potensi/dtdc/'); ?>">
                        <i class="fas fa-arrow-left"></i> Kembali<a>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data yang belum terdaftar di DTDC</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <TH>Program</th>
                                        <TH>Jumlah</th>
                                        <TH>Belum Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>PIP</td>
                                        <td><?= $jpip; ?></td>
                                        <td><a href="<?= base_url('/potensi/dtdc/unregpip'); ?>"> <b><?= $jupip ?></b></a></td>
                                    </tr>
                                    <tr>
                                        <td>KIP</td>
                                        <td><?= $jkip; ?></td>
                                        <td><a href="<?= base_url('/potensi/dtdc/unregkip'); ?>"><b><?= $jukip ?></b></a></td>
                                    </tr>
                                    <tr>
                                        <td>BPUM</td>
                                        <td><?= $jbpum; ?></td>
                                        <td><a href="<?= base_url('/potensi/dtdc/unregbpum'); ?>"><b><?= $jubpum ?></b></a></td>
                                    </tr>
                                    <tr>
                                        <td>Bedah Rumah</td>
                                        <td><?= $jbr; ?></td>
                                        <td><a href="<?= base_url('/potensi/dtdc/unregbedahrumah'); ?>"><b><?= $jubr ?></b></a></td>
                                    </tr>

                                </tbody>
                                <!-- <tfoot>
                                            <tr>
                                                <th>Rendering engine</th>
                                                <th>Browser</th>
                                                <th>Platform(s)</th>
                                                <th>Engine version</th>
                                                <th>CSS grade</th>
                                            </tr>
                                        </tfoot> -->
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <br><a href="<?= base_url('potensi/dtdc/'); ?>">
                <i class="fas fa-arrow-left"></i> Kembali<a>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->