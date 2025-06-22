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

    <!-- Table pip -->
    <div class="table-responsive">
        <table class="table table-striped border">
            <thead class="text-center">
                <th class="border">#</th>
                <th class="border">NAMA LENGKAP</th>
                <th class="border">ALAMAT LENGKAP</th>
                <th class="border">KELURAHAN</th>
                <th class="border">RTRW</th>
                <th class="border">NO. TELEPON / HP</th>
                <th class="border">ANGKATAN</th>
                <th class="border">UNIVERSITAS</th>
                <th class="border">AYAH</th>
                <th class="border">IBU</th>
                <th class="border">NO HP Ortu</th>
                <th class="border">TANGGAPAN</th>
            </thead>

            <tbody>
                <?php foreach ($table_list as $key => $tbl) { ?>
                    <tr class="text-center">

                        <td class="border"><?= $key + 1 ?></td>
                        <td class="border"><?= $tbl['nama'] ?></td>
                        <td class="border"><?= $tbl['alamat'] ?></td>
                        <td class="border"><?= $tbl['namakel'] ?></td>
                        <td class="border"><?= $tbl['rtrw'] ?></td>
                        <td class="border"><?= $tbl['nohp'] ?></td>
                        <td class="border"><?= $tbl['angkatan'] ?></td>
                        <td class="border"><?= $tbl['universitas'] ?></td>
                        <td class="border"><?= $tbl['ayah'] ?></td>
                        <td class="border"><?= $tbl['ibu'] ?></td>
                        <td class="border"><?= $tbl['hportu'] ?></td>
                        <td class="border"><?= $tbl['tanggapan'] ?></td>


                    </tr>
                <?php } ?>

                <!-- Empty State -->
                <?php if (empty($pip_list)) { ?>
                    <tr class="text-center">
                        <td colspan="6">Data not found</td>
                    </tr>
                <?php } ?>

            </tbody>

        </table>
    </div>

</div>

<!-- Load Modal Views -->
<?php
$this->load->view('import/dtdckip/modal-export-excel');
$this->load->view('import/dtdckip/modal-import-excel');
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