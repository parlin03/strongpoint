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

                                                        <div id="mygraph" style="min-width: 400px; height: 480px; margin: 0 auto"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hover text-dark  ">
                                                                <thead class="text-center">
                                                                    <th class="border">Program</th>
                                                                    <th class="border">Jumlah</th>
                                                                    <!-- <th class="border">REKOMENDASI</th> -->
                                                                    <!-- <th class="border">Action</th> -->
                                                                </thead>
                                                                <tbody>
                                                                    <?php if (empty($program)) : ?>
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
                                                                    foreach ($program as $row) :
                                                                        if ($row->program == "") {
                                                                            $row->program = "Lain-Lain";
                                                                        } ?>
                                                                        <tr class="text-center">

                                                                            <td class="border"><?= $row->program; ?></td>
                                                                            <td class="border"><?= $row->total; ?></td>
                                                                        </tr>
                                                                        <?php $jtotal += $row->total; ?>
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


<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            chart: {
                renderTo: 'mygraph',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            accessibility: {
                enabled: false
            },
            title: {
                text: 'Capaian Program DTDC'
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
                }
            },
            plotOptions: {
                pie: {
                    colors: ['#FF0000', '#00FFFF', '#FFA500', '#800080', '#008000', '#5865F2', '#FFFF00', '#00FF00', '#FF69B4', '#A52A2A', '#0000FF', '#7FFFD4', '#808000'],
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

        $.getJSON("<?php echo site_url('potensi/dtdc/Capaian_list'); ?>", function(json) {
            options.series[0].data = json;
            chart = new Highcharts.Chart(options);
        });

    });
</script>