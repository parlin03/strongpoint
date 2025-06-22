<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ju">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $menu . $title; ?></h1>
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
                        <div class="card-body">
                            <div class="row ">
                                <div class="container" style="margin-top:20px">
                                    <div>
                                        <div class="panel panel-primary">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div id="mygraph" style="min-width: 400px; height: 480px; margin: 0 auto"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="table">
                                                            <table style="width:100%" class="table table-bordered table-striped table-hover text-dark  ">
                                                                <thead class="text-center">
                                                                    <th class="align-middle text-center">Nama Calon</th>
                                                                    <th class="border">Jumlah Suara</th>
                                                                    <!-- <th class="border">REKOMENDASI</th> -->
                                                                    <!-- <th class="border">Action</th> -->
                                                                </thead>
                                                                <tbody>
                                                                    <?php if (empty($summary)) : ?>
                                                                        <tr>
                                                                            <td colspan="7">
                                                                                <div class="alert alert-danger" role="alert">
                                                                                    data not found!
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                    <?php
                                                                    $jtotal = 0;
                                                                    foreach ($summary as $row) : ?>
                                                                        <tr>
                                                                            <td class="border"><?= ($row->no_urut == 00 ? '' : $row->no_urut . '. ') . $row->nama_calon; ?></td>
                                                                            <td class="border text-right"><b><?= $row->jml_suara; ?></b></td>
                                                                        </tr>
                                                                        <?php $jtotal += $row->jml_suara; ?>
                                                                    <?php endforeach; ?>

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr class="text-center">
                                                                        <th class="border">Total</th>
                                                                        <th class="border"><?= $jtotal; ?></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <?= $this->session->flashdata('messagerekap'); ?>

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php if (!empty($kec)) : ?>
                                        <a href="<?= base_url('') . 'rekapitulasi' . $back; ?>">
                                            <i class="fas fa-arrow-left"></i> Kembali<a>
                                            <?php endif; ?>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h3 class="card-title"><b>Perhitungan Suara <?= $report; ?></b></h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <!-- <table class="table table-sm table-hover wrap-text" align="center" border="1"> -->
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center"><?= $head; ?></th>
                                        <th class="align-middle text-center">Total DPT</th>
                                        <th class="align-middle text-center">Suara Partai</th>
                                        <th class="align-middle text-center">H. ADAM MUHAMMAD, ST, M.SI</th>
                                        <th class="align-middle text-center">A M IRWAN PATAWARI, S.Si</th>
                                        <th class="align-middle text-center">Hj. NURIMBAYANI DASSIR, S.S</th>
                                        <th class="align-middle text-center">HENRY BATARA</th>
                                        <th class="align-middle text-center">RESKI AMELIA, S. Farm</th>
                                        <th class="align-middle text-center">Dr. SYAMSUDDIN NUR, SH, MH, CPM</th>
                                        <!-- <th class="align-middle text-center">Suara Rusak</th> -->
                                        <th class="align-middle text-center">Total Suara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($hasil)) : ?>
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-danger" role="alert">
                                                    data not found!
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php
                                    $jtotal = 0;
                                    foreach ($hasil as $row) : ?>
                                        <tr>
                                            <?php if ($head == 'TPS') : ?>
                                                <td class="align-middle">
                                                    <?= $row['head']; ?>
                                                    <?php if (!empty($row['id_tps'])) : ?>
                                                        <span><a href="<?= base_url('') . 'rekapitulasi/edit?id=' . $row['id_tps']; ?>" class="badge badge-warning" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-fw fa-edit" aria-hidden="true"></i></a></span>
                                                    <?php endif ?>
                                                </td>
                                            <?php else : ?>
                                                <td class="align-middle">
                                                    <!-- <a href="<?= base_url('') ?>rekapitulasi?kec= ?><?= $link ?> strtolower(<?= $row['head'] ?>) . '">' . <?= ucwords($row['head']) ?> . '</a> -->
                                                    <a href="<?= base_url('') . 'rekapitulasi?kec=' . $link . strtolower($row['head']); ?>"><?= ucwords($row['head']); ?></a>
                                                </td>
                                            <?php endif; ?>
                                            <td class="align-middle text-center"><?= $row['jml_dpt']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jml_suara_00']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jml_suara_01']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jml_suara_02']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jml_suara_03']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jml_suara_04']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jml_suara_05']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jml_suara_06']; ?></td>
                                            <!-- <td class="align-middle text-center"><?= $row['jml_rusak']; ?></td> -->
                                            <td class="align-middle text-center">
                                                <?= $row['jml_suara']; ?>

                                                <?php if (!empty($row['id_tps'])) : ?>
                                                    <span> <a href="<?= base_url('') . 'rekapitulasi/delete?kec=' . $link . '&id=' . $row['id_tps']; ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $report . ' TPS ' . $row['head']; ?> ?');" class="badge badge-danger badge-circle" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a></span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <!-- <?php $jtotal += $row['total']; ?> -->

                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <h3 class="card-title"><b>TPS yang belum terinput</b></h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="blank" class="table table-bordered table-striped">
                                <!-- <table class="table table-sm table-hover wrap-text" align="center" border="1"> -->
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">#</th>
                                        <th class="align-middle text-center">Kecamatan</th>
                                        <th class="align-middle text-center">Kelurahan</th>
                                        <th class="align-middle text-center">TPS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($blank)) : ?>
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-danger" role="alert">
                                                    data not found!
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php
                                    $i = 1;
                                    foreach ($blank as $row) : ?>
                                        <tr>
                                            <td class="align-middle text-center">
                                                <?= $i++ ?>
                                            </td>
                                            <td class="align-middle text-center"><?= $row['namakec']; ?></td>
                                            <td class="align-middle text-center"><?= $row['namakel']; ?></td>
                                            <td class="align-middle text-center"><?= $row['tps']; ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
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



<!-- load library jquery dan highcharts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-more.js"></script>
<!-- end load library -->

<!-- jQuery -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script> -->
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
<!-- AdminLTE App -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            chart: {
                renderTo: 'mygraph',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
            },
            accessibility: {
                enabled: false
            },
            title: {
                text: 'Jumlah Suara Masuk'
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
                }
            },

            plotOptions: {
                pie: {
                    colors: ['#B8860B', '#42afee', '#9932CC', '#F0E68C', '#006400', '#FF69B4', '#000080'],
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        // color: '#000000',
                        connectorColor: 'green',
                        formatter: function() {
                            return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.percentage, 2) + ' % ';
                        }
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: []
            }]
        }

        $.getJSON("<?php echo site_url('rekapitulasi/Graph_list'); ?>", function(json) {
            options.series[0].data = json;
            chart = new Highcharts.Chart(options);
        });

    });
</script>
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