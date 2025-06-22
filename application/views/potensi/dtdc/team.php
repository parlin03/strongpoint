<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ju">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                    <br><a href="<?= base_url('potensi/dtdc/'); ?>">
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
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <!-- <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">820</span>
                                    <span>Visitors Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right"> -->
                            <!-- <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span> -->
                            <!-- </p> -->
                            <!-- </div> -->
                            <!-- /.d-flex -->
                            <?php
                            if (!empty($grafik)) {
                                /* Mengambil query report*/
                                foreach ($grafik as $result) {
                                    if (!empty($uid)) {
                                        $name = $result->name;
                                    } else {
                                        $name = '';
                                    }
                                    $date[] = $result->date_created; //ambil bulan
                                    $value[] = (float) $result->total; //ambil nilai
                                }
                                /* end mengambil query*/
                            }
                            ?>

                            <!-- Load chart dengan menggunakan ID -->
                            <!-- END load chart -->

                            <div class="position-relative mb-8">
                                <div id="report"></div>
                                <!-- <canvas id="report" height="350"></canvas> -->
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <?php foreach ($pencapaian as $cp) : ?>
                                    <span class="mr-2">



                                        <i class="fas fa-square text-gray"></i> <?= ucwords(strtolower($cp['namakec'])); ?> (<b><?= $cp['total']; ?></b>)
                                    </span>
                                <?php endforeach; ?>
                                <span class="mr-2">
                                    <?php $tdaftar = 0; ?>
                                    <?php foreach ($TotalDaftar as $td) : ?>
                                        <?php $tdaftar += $td['totaldaftar']; ?>
                                    <?php endforeach; ?>
                                    <i class="fas fa-square text-primary"></i> Total Suara Terdaftar (<b><?= $tdaftar; ?></b>)
                                </span>

                                <span>
                                    <?php $tdpt = 0; ?>
                                    <?php foreach ($TotalDpt as $tp) : ?>
                                        <?php $tdpt += $tp['totaldpt']; ?>
                                    <?php endforeach; ?>
                                    <i class="fas fa-square text-success"></i> Persentase Pencapaian (<b><?= number_format(($tdaftar * 100 / $tdpt), 2); ?> %</b>)
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">



                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ranking Tim</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0">

                            <table class="table table-sm table-hover text-nowrap" align="center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>PIC</th>
                                        <th class="text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <?php $i = 1; ?>
                                <?php $total = 0; ?>

                                <?php foreach ($pencapaiantimall as $ct) : ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><a href="<?= base_url('potensi/dtdc/team/' . $ct['id']); ?>"><?= ucwords($ct['name']); ?></td>
                                            <td class="text-center"><?= $ct['total']; ?></td>
                                        </tr>


                                    </tbody>
                                    <?php $i++; ?>
                                    <?php $total += $ct['total']; ?>
                                <?php endforeach; ?>
                                <tfoot>
                                    <tr>

                                        <th colspan="2" class="text-center">Total</th>

                                        <th class="text-center"><?= $total; ?></th>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script> -->
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script type="text/javascript">
    $(function() {
        var chart = new Highcharts.Chart({
            colors: ["#7cb5ec", "#f7a35c"],
            chart: {
                renderTo: 'report',
                type: 'line',
                margin: 75,
                options3d: {
                    enabled: false,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
            title: {
                text: 'Laporan Suara Terdaftar <b>' + <?= json_encode(ucwords($name)); ?> + '</b>',
                style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
                }
            },
            subtitle: {
                text: '',
                style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
                }
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: <?= json_encode($date); ?>
            },
            exporting: {
                enabled: false
            },
            yAxis: {
                title: {
                    text: 'Jumlah'
                },
            },
            tooltip: {
                formatter: function() {
                    return 'Tanggal <b>' + this.x + '</b>, Suara Terdaftar = <b>' + Highcharts.numberFormat(this.y, 0) + '</b>';
                }
            },
            legend: {
                enabled: false
            },
            series: [{

                name: '',
                data: <?= json_encode($value); ?>,
                shadow: true,
                dataLabels: {
                    enabled: true,
                    color: '#045396',
                    align: 'center',
                    formatter: function() {
                        return Highcharts.numberFormat(this.y, 0);
                    }, // one decimal
                    y: 0, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>