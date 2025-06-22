<!-- Content Page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>


                    <!-- Import Button -->
                    <a data-toggle="modal" data-target="#modalImport" class="btn btn-sm btn-success">
                        <i class="fas fa-file-import"></i> Import
                    </a>

                    <!-- Export Button -->
                    <!-- <a data-toggle="modal" data-target="#modalExport" class="btn btn-sm btn-primary float-right">
                        <i class="fas fa-download"></i> Export
                    </a> -->

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Table pip -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <!-- <div class="card-header">
                                    <h3 class="card-title">DataTable with default features</h3>
                                </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIK</th>
                                        <th>NAMA</th>
                                        <th>TMPTLHR</th>
                                        <th>TGLLHR</th>
                                        <th>STATUS</th>
                                        <th>JENIS_KELAMIN</th>
                                        <th>ALAMAT</th>
                                        <th>RT</th>
                                        <th>RW</th>
                                        <th>TPS</th>
                                        <th>KECAMATAN</th>
                                        <th>KELURAHAN</th>
                                        <th>NOMOR HP</th>
                                        <th>PERIODE</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($table_list as $key => $tbl) { ?>
                                        <tr class="text-center">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $tbl['nik'] ?></td>
                                            <td><?= $tbl['nama'] ?></td>
                                            <td><?= $tbl['tempat_lahir'] ?></td>
                                            <td><?= $tbl['tanggal_lahir'] ?></td>
                                            <td><?= $tbl['status'] ?></td>
                                            <td><?= $tbl['jenis_kelamin'] ?></td>
                                            <td><?= $tbl['alamat'] ?></td>
                                            <td><?= $tbl['rt'] ?></td>
                                            <td><?= $tbl['rw'] ?></td>
                                            <td><?= $tbl['tps'] ?></td>
                                            <td><?= $tbl['kecamatan'] ?></td>
                                            <td><?= $tbl['kelurahan'] ?></td>
                                            <td><?= $tbl['nohp'] ?></td>
                                            <td><?= $tbl['periode'] ?></td>


                                        </tr>
                                    <?php } ?>

                                    <!-- Empty State -->
                                    <?php if (empty($table_list)) { ?>
                                        <tr class="text-center">
                                            <td colspan="6">Data not found</td>
                                        </tr>
                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>


<!-- Modal Import Excel -->
<div id="modalImport" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= site_url('import/jaringbedahrumah/import_excel') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-3">

                    <!-- Upload File -->
                    <input name="uploadFile" class="form-control mb-1" type="file" accept=".xls,.xlsx,.csv" required>

                    <!-- Download Template -->
                    <a href="<?= base_url('assets/excel/template.xlsx') ?>" class="float-right" download>Download Template</a>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", {
                extend: 'pdf',
                orientation: 'landscape'
            }, "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

<!-- Popper -->
<!-- <script src="<?= base_url("assets/vendor/popper/popper.min.js") ?>"></script> -->

<!-- Bootstrap -->
<!-- <script src="<?= base_url("assets/vendor/bootstrap/js/bootstrap.min.js") ?>"></script> -->

<!-- jQuery UI -->
<!-- <script src="<?= base_url("assets/vendor/jquery-ui/jquery-ui.min.js") ?>"></script> -->

<!-- Modal Feedback Show -->
<?php if ($this->session->flashdata('modal_message')) { ?>
    <?= $this->session->flashdata('modal_message') ?>
    <script>
        $(window).on('load', function() {
            $('#modalFeedback').modal('show');
        });
    </script>
<?php } ?>