<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
    </h1>
    <!-- load library jquery dan highcharts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/highcharts-more.js"></script>
    <!-- end load library -->
    <script>
        $(function() {
            var chart;

            $(document).ready(function() {
                chart0 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'mygraph',
                        height: 330,
                        type: 'column'
                    },
                    title: {
                        text: ''
                    },
                    xAxis: {
                        categories: ['Kecamatan']
                    },
                    yAxis: {
                        title: {
                            text: 'Total DPT'
                        }
                    },
                    plotOptions: {
                        column: {
                            dataLabels: {
                                enabled: true,
                                crop: false,
                                overflow: 'none'
                            }
                        }
                    },

                    series: [<?php foreach ($maingraph as $mg) :  ?> {

                                name: '<?= $mg['namakec']; ?>',
                                data: [<?= $mg['total']; ?>]

                            },
                        <?php endforeach; ?>
                    ]
                });
            });
        });
    </script>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah DPT</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">955,000</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Relawan</div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">215,000</div>
                                    <div class="text-xs mb-0 font-weight-bold text-gray-800">215,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Simpatisan
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1200</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        saksi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">318</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Statistik Sebaran DPT Kota Makassar</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <!-- <div class="chart-area"> -->
                            <div id="mygraph"></div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="panel panel-primary">
                    <div class="panel-body">
                        <div id="mygraph"></div>
                    </div>
                </div> -->
                <!-- Content Row -->


            </div>

    </section>
    <!-- /.content -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->