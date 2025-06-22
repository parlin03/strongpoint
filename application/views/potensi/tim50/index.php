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
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header border-0">
                            <!-- <div class="d-flex justify-content-between"> -->
                            <h3 class="card-title">Suara Terdaftar TIM50</h3>

                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <!-- <span class="text-bold text-lg">820</span>
                                    <span>Visitors Over Time</span> -->
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <!-- <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span class="text-muted">Since last week</span> -->
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <!-- <div class="container" style="margin-top:20px">
                                <div>
                                    <div class="panel panel-primary">
                                        <div class="panel-body">
                                            <div id="container" style="min-width: 400px; height: 480px; margin: 0 auto"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="container" style=" height: 470px; margin: 0 auto">
                                        <div id="container"></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-5">
                    <!-- Info Boxes Style 2 -->
                    <!--  -->
                    <!-- /.info-box -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Capaian Dukungan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-sm table-hover text-nowrap" align="center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kecamatan</th>
                                        <th class="text-center">Terdaftar</th>
                                        <th class="text-center">Target</th>
                                        <th class="text-center">Persentase</th>
                                    </tr>
                                </thead>
                                <?php $i = 1; ?>
                                <?php $total = 0; ?>
                                <?php $target = 0; ?>
                                <?php foreach ($pencapaian as $cp) : ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><a href="<?= base_url('potensi/tim50/kec/') . strtolower($cp['namakec']); ?>"><?= ucwords(strtolower($cp['namakec'])); ?></a></td>
                                            <td class="text-center"><?= $cp['total']; ?></td>
                                            <td class="text-center"><?= $cp['target']; ?></td>
                                            <td class="text-center"><?= number_format((($cp['total'] * 100) / ($cp['target'])), 2); ?> %</td>
                                        </tr>
                                    </tbody>
                                    <?php $i++; ?>
                                    <?php $total += $cp['total']; ?>
                                    <?php $target += $cp['target']; ?>
                                <?php endforeach; ?>
                                <tfoot>
                                    <tr>

                                        <th colspan="2" class="text-center">Total</th>

                                        <th class="text-center"><?= $total; ?></th>
                                        <th class="text-center"><?= $target; ?></th>
                                        <th class="text-center"><?= number_format((($total * 100) / $target), 2); ?> %</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row ">
                                <div class="container">
                                    <div>
                                        <div class="panel panel-primary">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-12">

                                                        <div id="mygraph" style="min-width: 200px; height: 260px; margin: 0 auto"></div>
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
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="post" action="<?= site_url('potensi/tim50/index') ?>">
                            <div class="card-header">
                                <!-- <h3 class="card-title">DataTable with default features</h3> -->
                                <div class="row justify-content-end">
                                    <div>
                                        <select id="filter" name="filter" class="form-control">
                                            <option value="0">All Data</option>
                                            <option value="1">Terdaftar DPT</option>
                                            <option value="2">Tidak Terdaftar DPT</option>
                                        </select>
                                    </div>
                                    <div>
                                        <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->

                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <TH>#</th>
                                        <TH>NIK</th>
                                        <TH>Nama</th>
                                        <TH>Alamat</th>
                                        <TH>Kel/Kec</th>
                                        <TH>TPS</th>
                                        <TH>No. HP</th>
                                        <TH>PIC</th>
                                        <TH></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($export)) : ?>
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-danger" role="alert">
                                                    data not found!
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $i = 1; ?>
                                    <?php
                                    foreach ($export as $m) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $m['noktp']; ?></td>
                                            <td><b><?= $m['nama']; ?></b></td>
                                            <td>
                                                <?= $m['alamat']; ?> RT. <?= $m['rt']; ?> RW. <?= $m['rw']; ?>
                                            </td>
                                            <td>
                                                <?= ucwords(strtolower($m['namakel'])); ?>/<?= ucwords(strtolower($m['namakec'])); ?>
                                            </td>
                                            <td><b><?= $m['tps']; ?></b></td>
                                            <td> <?= $m['nohp']; ?></td>
                                            <td><?= $m['name'] ?></td>
                                            <td style="width: 0.1em" class="<?= $m['status'] == 'Terdaftar DPT' ? 'bg-green' : 'bg-red'; ?>"></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
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


        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- load library jquery dan highcharts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-more.js"></script>

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

<script type="text/javascript">
    $(function() {
        var chart;
        $(document).ready(function() {
            $.getJSON("<?php echo site_url('potensi/tim50/list'); ?>", function(json) {

                chart0 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container',
                        type: 'column'
                    },
                    accessibility: {
                        enabled: false
                    },
                    title: {
                        text: 'Capaian Suara Terdaftar Terhadap Target Suara Tim 50'
                    },
                    xAxis: {
                        categories: ['<a href="<?= base_url('potensi/tim50/panakkukang'); ?>">Panakkukang</a>', '<a href="<?= base_url('potensi/tim50/biringkanaya'); ?>">Biringkanaya</a>', '<a href="<?= base_url('potensi/tim50/manggala'); ?>">Manggala</a>', '<a href="<?= base_url('potensi/tim50/tamalanrea'); ?>">Tamalanrea</a>']
                    },
                    yAxis: {
                        title: {
                            text: 'Jumlah DPT'
                        }
                    },
                    labels: {
                        items: [{
                            html: '',
                            style: {
                                left: '50px',
                                top: '18px',
                                color: ( // theme
                                    Highcharts.defaultOptions.title.style &&
                                    Highcharts.defaultOptions.title.style.color
                                ) || 'black'
                            }
                        }]
                    },
                    plotOptions: {
                        column: {
                            // stacking: 'percen',
                            dataLabels: {
                                enabled: true,
                                crop: false,
                                overflow: 'none'
                            }
                        }
                    },
                    series: json
                });;

            });

        });

    });
</script>
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
                text: 'Status'
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b>: <br>' + this.y + ' (' + this.percentage + ' %)';
                }
            },

            plotOptions: {
                pie: {
                    colors: ['green', 'red'],
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        // color: '#000000',
                        connectorColor: 'green',
                        formatter: function() {
                            return '<b>' + this.point.name + '</b>: <br>' + this.y + ' <small>(' + Highcharts.numberFormat(this.percentage, 2) + ' %)</small>';
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

        $.getJSON("<?php echo site_url('potensi/tim50/Pie_list'); ?>", function(json) {
            options.series[0].data = json;
            chart = new Highcharts.Chart(options);
        });

    });
</script>
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