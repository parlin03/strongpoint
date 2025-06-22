<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah DPT</span>
                            <span class="info-box-number">
                                <?= number_format($this->db->count_all('dpt')); ?>
                                <!-- <small>%</small> -->
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-friends"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tim 50</span>
                            <span class="info-box-number"><?= number_format($this->db->get_Where('lks_tim50', array())->num_rows()); ?></span>

                            <!-- <span class="info-box-text">Tim</span>
                            <span class="info-box-number"> <?= number_format($this->db->count_all('organik') + $this->db->count_all('soa') + $this->db->count_all('simpul')); ?></span> -->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tshirt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Potensi Suara</span>
                            <span class="info-box-number"><?= number_format($this->db->get_Where('lks_dtdc', array())->num_rows()); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chart-line"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">RPS 2024</span>
                            <span class="info-box-number"><?= number_format($rps); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Statistik Sebaran DPT Kota Makassar B</h5>

                            <!-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item">Something else here</a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="chart">
                                        <!-- Sales Chart Canvas -->
                                        <div id="mygraph"></div>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->

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
<!-- <script src="<?php echo base_url(); ?>assets/js/accessibility.js"></script> -->
<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script> -->
<!-- end load library -->
<script type="text/javascript">
    $(function() {
        var chart;
        $(document).ready(function() {
            $.getJSON("<?php echo site_url('home/index_list'); ?>", function(json) {

                chart0 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'mygraph',
                        type: 'column'
                    },
                    accessibility: {
                        enabled: false
                    },
                    title: {
                        text: 'Kontribusi Pemilih Terhadap Target Suara'
                    },
                    xAxis: {
                        categories: ['Panakkukang', 'Biringkanaya', 'Manggala', 'Tamalanrea']
                    },
                    yAxis: {
                        title: {
                            text: 'Total DPT'
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
                    colors: [
                        '#0275d8',
                        '#5cb85c',
                        '#5bc0de',
                        // '#f0ad4e',
                        '#d9534f'
                    ],
                    series: json
                });;
            });

        });

    });
</script>