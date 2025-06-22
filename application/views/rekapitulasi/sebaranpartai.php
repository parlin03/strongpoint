<link rel="stylesheet" href="<?= base_url('assets/') ?>css/fix-head-1stcoloum-table.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ju">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                    <br><a href="<?= base_url('rekapitulasi/'); ?>">
                        <i class="fas fa-arrow-left"></i> Kembali<a>
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
            <!-- Panakkukang -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- /.card-header -->

                    <div class="card">
                        <div class="card-header">
                            <div class="row d-flex justify-content-center">
                                <div>
                                    <h3>Kecamatan <?= $kec; ?></h3>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="card-body table-responsive table-scroll" p-0">
                            <table class="table table-sm table-hover text-nowrap"> -->
                        <div class="card-body">
                            <table id="blank" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">TPS</th>
                                        <?php $i = 0; ?>
                                        <?php foreach ($kelurahan as $kel) : ?>
                                            <th class="text-center"><?= $kel['namakel'] . ' <br><font size="2">(' . $kel['jtps'] . ' TPS)</font>'; ?></th>
                                            <?php $i++; ?>
                                            <?php $j[] = $kel['namakel']; ?>
                                            <?php $m[] = $kel['jtps']; ?>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($l = 0; $l < $i; ++$l) {
                                        $total[$l] = 0;
                                    } ?>
                                    <?php $total[1] = 0; ?>
                                    <?php foreach ($sebaran as $pt) : ?>
                                        <tr>
                                            <th class="text-center"><?= $pt['tps']; ?></th>
                                            <?php for ($k = 0; $k < $i; ++$k) {
                                                echo "<td class='text-center " . ($pt['C' . $k] == 0 & $pt['C' . $k] != null ? "bg-red" : "") . "'>" . ($m[$k] >= $pt['tps']   ? $pt['C' . $k] : null)  . "</td>";
                                                $total[$k] += $pt['C' . $k];
                                            } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">

                                        <th>Total</th>
                                        <?php for ($k = 0; $k < $i; ++$k) {
                                            echo "<th>" . $total[$k] . "</td>";
                                        } ?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>


            <!-- Tamalanrea -->

            <br><a href="<?= base_url('rekapitulasi/'); ?>">
                <i class="fas fa-arrow-left"></i> Kembali<a>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- load library jquery dan highcharts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-more.js"></script>

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
            "order": [
                [0, 'asc']
            ],
            "pageLength": 15,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", {
                extend: 'excel',
                title: 'Perhitungan Suara ' + '<?= $report; ?>',
                filename: 'Perhitungan Suara ' + '<?= $report; ?>'
            }, {
                extend: 'pdf',
                title: 'Perhitungan Suara ' + '<?= $report; ?>',
                filename: 'Perhitungan Suara ' + '<?= $report; ?>',
                orientation: 'landscape'
            }, {
                extend: 'print',
                title: 'Perhitungan Suara ' + '<?= $report; ?>'
            }]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#blank").DataTable({
            "order": [
                [0, 'asc']
            ],
            // "pageLength": 15,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", {
                extend: 'excel',
                title: 'TPS yang belum terinput',
                filename: 'TPS yang belum terinput'
            }, {
                extend: 'pdf',
                title: 'TPS yang belum terinput',
                filename: 'TPS yang belum terinput',
                orientation: 'landscape'
            }, {
                extend: 'print',
                title: 'TPS yang belum terinput'
            }]
        }).buttons().container().appendTo('#blank_wrapper .col-md-6:eq(0)');

    });
</script>
<!-- end load library -->