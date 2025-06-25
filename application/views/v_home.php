<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ju">
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
                        <div class="card-body">
                            <div class="row ">
                                <div class="container" style="margin-top:20px">
                                    <div>
                                        <div class="panel panel-primary">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="chart">
                                                            <div id="graphPekerjaan" style=" max-width: 100%; margin: 0 auto"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hover text-dark  ">
                                                                <thead class="text-center">
                                                                    <th class="border">Pekerjaan</th>
                                                                    <th class="border">Jumlah</th>
                                                                    <!-- <th class="border">REKOMENDASI</th> -->
                                                                    <!-- <th class="border">Action</th> -->
                                                                </thead>
                                                                <tbody>
                                                                    <?php if (empty($summaryPekerjaan)) : ?>
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
                                                                    foreach ($summaryPekerjaan as $row) : ?>
                                                                        <tr class="text-center">

                                                                            <td class="border"><a href="<?= base_url('pekerjaan/') . strtolower($row->pekerjaan); ?>"><?= $row->pekerjaan; ?></a></td>
                                                                            <td class="border"><?= "Rp " . number_format("$row->total", 0, ",", "."); ?></td>

                                                                        </tr>
                                                                        <?php $jtotal += $row->total; ?>
                                                                    <?php endforeach; ?>
                                                                    <?php
                                                                    $pajak = $jtotal * 12.5 / 100;
                                                                    $real_cost = $jtotal - $pajak;
                                                                    ?>

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr class="text-center">
                                                                        <th class="border">Total</th>
                                                                        <th class="border"><?= "Rp " . number_format("$jtotal", 0, ",", "."); ?></th>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th class="border">Pajak</th>
                                                                        <th class="border"><?= "Rp " . number_format("$pajak", 0, ",", "."); ?></th>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th class="border">Real Cost</th>
                                                                        <th class="border"><?= "Rp " . number_format("$real_cost", 0, ",", "."); ?></th>
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
            <!-- /.row -->

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
                                                    <div class="col-md-8">
                                                        <div class="chart">
                                                            <div id="graphOpd" style=" max-width: 100%; margin: 0 auto"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hover text-dark  ">
                                                                <thead class="text-center">
                                                                    <th class="border">OPD</th>
                                                                    <th class="border">Jumlah</th>
                                                                    <!-- <th class="border">REKOMENDASI</th> -->
                                                                    <!-- <th class="border">Action</th> -->
                                                                </thead>
                                                                <tbody>
                                                                    <?php if (empty($summaryOpd)) : ?>
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
                                                                    foreach ($summaryOpd as $row) : ?>
                                                                        <?php $jtotal += $row->total; ?>
                                                                        <tr class="text-center">

                                                                            <td class="border"><a href="<?= base_url('pekerjaan/') . strtolower($row->opd); ?>"><?= $row->opd; ?></a></td>
                                                                            <td class="border"><?= "Rp " . number_format("$row->total", 0, ",", ".") . " (" . number_format("$row->percentage", 2, ",", ".") . "%)"; ?></td>

                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                    <?php
                                                                    $pajak = $jtotal * 12.5 / 100;
                                                                    $real_cost = $jtotal - $pajak;
                                                                    ?>

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr class="text-center">
                                                                        <th class="border">Total</th>
                                                                        <th class="border"><?= "Rp " . number_format("$jtotal", 0, ",", "."); ?></th>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th class="border">Pajak</th>
                                                                        <th class="border"><?= "Rp " . number_format("$pajak", 0, ",", "."); ?></th>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th class="border">Real Cost</th>
                                                                        <th class="border"><?= "Rp " . number_format("$real_cost", 0, ",", "."); ?></th>
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
            <!-- /.row -->

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
                                                    <div class="col-md-8">
                                                        <div class="chart">
                                                            <div id="graphRekanan" style="max-width: 100%; margin: 0 auto"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hover text-dark  ">
                                                                <thead class="text-center">
                                                                    <th class="border">Rekanan</th>
                                                                    <th class="border">Jumlah</th>
                                                                    <!-- <th class="border">REKOMENDASI</th> -->
                                                                    <!-- <th class="border">Action</th> -->
                                                                </thead>
                                                                <tbody>
                                                                    <?php if (empty($summaryRekanan)) : ?>
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
                                                                    foreach ($summaryRekanan as $row) : ?>
                                                                        <?php $jtotal += $row->total; ?>
                                                                        <tr class="text-center">

                                                                            <td class="border"><a href="<?= base_url('pekerjaan/') . strtolower($row->rekanan); ?>"><?= $row->rekanan; ?></a></td>
                                                                            <td class="border"><?= "Rp " . number_format("$row->total", 0, ",", ".") . " (" . number_format("$row->percentage", 2, ",", ".") . "%)"; ?></td>

                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                    <?php
                                                                    $pajak = $jtotal * 12.5 / 100;
                                                                    $real_cost = $jtotal - $pajak;
                                                                    ?>

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr class="text-center">
                                                                        <th class="border">Total</th>
                                                                        <th class="border"><?= "Rp " . number_format("$jtotal", 0, ",", "."); ?></th>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th class="border">Pajak</th>
                                                                        <th class="border"><?= "Rp " . number_format("$pajak", 0, ",", "."); ?></th>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <th class="border">Real Cost</th>
                                                                        <th class="border"><?= "Rp " . number_format("$real_cost", 0, ",", "."); ?></th>
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
<!-- AdminLTE App -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            chart: {
                renderTo: 'graphPekerjaan',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            accessibility: {
                enabled: false
            },
            title: {
                text: 'Sebaran Pagu Anggaran Pekerjaan'
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
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

        $.getJSON("<?php echo site_url('home/pekerjaan_list'); ?>", function(json) {
            options.series[0].data = json;
            chart = new Highcharts.Chart(options);
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            chart: {
                renderTo: 'graphOpd',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            accessibility: {
                enabled: false
            },
            title: {
                text: 'Sebaran Pagu Anggaran OPD'
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
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

        $.getJSON("<?php echo site_url('home/opd_list'); ?>", function(json) {
            options.series[0].data = json;
            chart = new Highcharts.Chart(options);
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            chart: {
                renderTo: 'graphRekanan',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            accessibility: {
                enabled: false
            },
            title: {
                text: 'Sebaran Pagu Anggaran Rekanan'
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
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

        $.getJSON("<?php echo site_url('home/rekanan_list'); ?>", function(json) {
            options.series[0].data = json;
            chart = new Highcharts.Chart(options);
        });

    });
</script>

<script>
    $(function() {
        $("#tabeljaringbpum").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,

            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": 'pekerjaan/ajax_list',
                "type": "POST"
            },
            "buttons": [{
                "extend": 'copy',
                "action": newexportaction
            }, {
                "extend": 'csv',
                "action": newexportaction
            }, {
                "extend": 'excel',
                "text": 'Excel',
                "titleAttr": 'Excel',
                "action": newexportaction
            }, {
                "extend": 'pdf',
                "action": newexportaction,
                "orientation": 'landscape'
            }, {
                "extend": 'print',
                "text": 'Print',
                "titleAttr": 'Print',
                "action": newexportaction
            }],
            "dom": 'Bfrtip',
            "select": true,
            "serverSide": true

        }).buttons().container().appendTo('#tabeljaringbpum_wrapper .col-md-6:eq(0)');

        function newexportaction(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function(e, s, data) {
                // Just this once, load all data from the server...
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function(e, settings) {
                    // Call the original action function
                    if (button[0].className.indexOf('buttons-copy') >= 0) {
                        $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                        $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                        $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                        $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-print') >= 0) {
                        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                    }
                    dt.one('preXhr', function(e, s, data) {
                        // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                        // Set the property to what it was before exporting.
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                    setTimeout(dt.ajax.reload, 0);
                    // Prevent rendering of the full data to the DOM
                    return false;
                });
            });
            // Requery the server with the new one-time export settings
            dt.ajax.reload();
        }

    });
</script>