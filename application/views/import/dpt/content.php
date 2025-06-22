<!-- Content Page -->
<div class="container">

    <!-- Header -->
    <div class="content-header">

        <!-- Import Button -->
        <a data-toggle="modal" data-target="#modalImport" class="btn btn-sm btn-success">
            <i class="fas fa-file-import"></i> Import
        </a>

        <!-- Export Button -->
        <a data-toggle="modal" data-target="#modalExport" class="btn btn-sm btn-primary float-right">
            <i class="fas fa-download"></i> Export
        </a>

    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h5 class="card-title">Monthly Recap Report</h5> -->
                            <div class="row">
                                <div class="col-md-5">
                                    <form action=" <?= base_url('import/dpt')  ?>" method="POST">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search NIK & Name..." name="keyword" autocomplete="off" autofocus>
                                            <div class="input-group-append">
                                                <input class="btn btn-primary" type="submit" name="submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5>Result: <?= $total_rows; ?></h5>
                            <div class="row justify-content-center">
                                <div class="info-box mb-10">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover text-dark  ">
                                            <thead class="text-center text-light">
                                                <tr class="bg-primary">
                                                    <th class="border">#</th>
                                                    <th class="border">No. KTP</th>
                                                    <th class="border">NAMA PEMILIH</th>
                                                    <th class="border">TEMPAT LAHIR</th>
                                                    <th class="border">TGL. LAHIR</th>
                                                    <th class="border">STATUS</th>
                                                    <th class="border">JENIS KEL.</th>
                                                    <th class="border">ALAMAT LENGKAP</th>
                                                    <th class="border">RT</th>
                                                    <th class="border">RW</th>
                                                    <th class="border">TPS</th>
                                                    <th class="border">KECAMATAN</th>
                                                    <th class="border">KELURAHAN</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($table_list)) : ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <div class="alert alert-danger" role="alert">
                                                                data not found!
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php
                                                foreach ($table_list as $tbl) : ?>
                                                    <tr>

                                                        <th class="text-right"> <?= ++$start; ?> </th>
                                                        <td class="border"><?= $tbl['noktp'] ?></td>
                                                        <td class="border"><?= $tbl['nama'] ?></td>
                                                        <td class="border"><?= $tbl['t4_lahir'] ?></td>
                                                        <td class="border"><?= $tbl['tgl_lahir'] ?></td>
                                                        <td class="border"><?= $tbl['status'] ?></td>
                                                        <td class="border"><?= $tbl['sex'] ?></td>
                                                        <td class="border"><?= $tbl['alamat'] ?></td>
                                                        <td class="border"><?= $tbl['rt'] ?></td>
                                                        <td class="border"><?= $tbl['rw'] ?></td>
                                                        <td class="border"><?= $tbl['tps'] ?></td>
                                                        <td class="border"><?= $tbl['namakec'] ?></td>
                                                        <td class="border"><?= $tbl['namakel'] ?></td>

                                                    </tr>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?= $this->pagination->create_links(); ?>
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

<!-- Load Modal Views -->
<?php
$this->load->view('import/dpt/modal-export-excel');
$this->load->view('import/dpt/modal-import-excel');
?>

<!-- Popper -->
<script src="<?= base_url("assets/vendor/popper/popper.min.js") ?>"></script>

<!-- Bootstrap -->
<script src="<?= base_url("assets/vendor/bootstrap/js/bootstrap.min.js") ?>"></script>

<!-- jQuery UI -->
<script src="<?= base_url("assets/vendor/jquery-ui/jquery-ui.min.js") ?>"></script>

<!-- Modal Feedback Show -->
<?php if ($this->session->flashdata('modal_message')) { ?>
    <?= $this->session->flashdata('modal_message') ?>
    <script>
        $(window).on('load', function() {
            $('#modalFeedback').modal('show');
        });
    </script>
<?php } ?>