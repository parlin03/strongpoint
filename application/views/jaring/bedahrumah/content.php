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

    <!-- Table bpum -->
    <div class="table-responsive">
        <table class="table table-striped border">
            <thead class="text-center">
                <th class="border">#</th>
                <th class="border">NAMA</th>
                <th class="border">JENIS KELAMIN</th>
                <th class="border">NO KTP</th>
                <th class="border">ALAMAT</th>
                <th class="border">KELURAHAN</th>
                <th class="border">KECAMATAN</th>
            </thead>

            <tbody>
                <?php foreach ($Bpum_list as $key => $bpum) { ?>
                    <tr class="text-center">

                        <td class="border"><?= $key + 1 ?></td>
                        <td class="border"><?= $bpum['nama'] ?></td>
                        <td class="border"><?= $bpum['jenis_kelamin'] ?></td>
                        <td class="border"><?= $bpum['noktp'] ?></td>
                        <td class="border"><?= $bpum['alamat'] ?></td>
                        <td class="border"><?= $bpum['kelurahan'] ?></td>
                        <td class="border"><?= $bpum['kecamatan'] ?></td>
                    </tr>
                <?php } ?>

                <!-- Empty State -->
                <?php if (empty($bpum_list)) { ?>
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
$this->load->view('jaring/bedahrumah/modal-export-excel');
$this->load->view('jaring/bedahrumah/modal-import-excel');
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