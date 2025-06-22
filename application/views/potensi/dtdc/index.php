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
                            <h3 class="card-title">Suara Terdaftar DTDC</h3>

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
                                    <div class="container" style=" height: 430px; margin: 0 auto">
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
                            <h3 class="card-title"><a href="<?= base_url('potensi/dtdc/capaian'); ?>">Capaian Dukungan</a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-sm table-hover text-nowrap" align="center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kecamatan</th>
                                        <th class="text-center">Terdaftar</th>
                                        <th class="text-center">Total DPT</th>
                                        <th class="text-center">Persentase</th>
                                    </tr>
                                </thead>
                                <?php $i = 1; ?>
                                <?php $total = 0; ?>
                                <?php $totaldpt = 0; ?>

                                <?php foreach ($pencapaian as $cp) : ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><a href="<?= base_url('potensi/dtdc/kec/') . strtolower($cp['namakec']); ?>"><?= ucwords(strtolower($cp['namakec'])); ?></a></td>
                                            <td class="text-center"><?= $cp['total']; ?></td>
                                            <td class="text-center"><?= $cp['totaldpt']; ?></td>
                                            <td class="text-center"><?= number_format((($cp['total'] * 100) / $cp['totaldpt']), 2); ?> %</td>
                                        </tr>


                                    </tbody>
                                    <?php $i++; ?>
                                    <?php $total += $cp['total']; ?>
                                    <?php $totaldpt += $cp['totaldpt']; ?>
                                <?php endforeach; ?>
                                <tfoot>
                                    <tr>

                                        <th colspan="2" class="text-center">Total</th>

                                        <th class="text-center"><?= $total; ?></th>
                                        <th class="text-center"><?= $totaldpt; ?></th>
                                        <th class="text-center"><?= number_format((($total * 100) / $totaldpt), 2); ?> %</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><a href="<?= base_url('potensi/dtdc/team'); ?>">Capaian Tim</a></h3>
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

                                <?php foreach ($pencapaiantim as $ct) : ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= ucwords($ct['name']); ?></td>
                                            <td class="text-center"><?= $ct['total']; ?></td>
                                        </tr>


                                    </tbody>
                                    <?php $i++; ?>
                                <?php endforeach; ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h5 class="card-title">Monthly Recap Report</h5> -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <form action=" <?= base_url('potensi/dtdc/')  ?>" method="POST">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" placeholder="Search NIK" name="keyword" autocomplete="off" autofocus>
                                            <div class="input-group-append">
                                                <input class="btn btn-primary" type="submit" name="submit">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-sm-5 ">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-warning">
                                            <a href="<?= base_url('potensi/dtdc/export'); ?>">Export</a>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-3 ">
                                    <div class="row">
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm d-flex justify-content-end">
                                                <h5>Total DTDC Terdaftar: <?= $total_rows; ?></h5> <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm d-flex justify-content-end">
                                                <h5>Total Belum Terdaftar: <a href="<?= base_url('/potensi/dtdc/unreg'); ?>"><?= $unreg; ?></a></h5> <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table table-hover text-nowrap" align="center">

                                <thead>
                                    <TH>#</th>
                                    <TH>DPT</th>
                                    <TH>Program</th>
                                    <TH>No. HP</th>
                                    <TH>Foto KTP</th>
                                    <th>PIC</th>
                                </thead>
                                <tbody>
                                    <?php if (empty($dtdc)) : ?>
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
                                    foreach ($dtdc as $m) : ?>
                                        <tr>
                                            <td><?= ++$start; ?></td>
                                            <td><?= $m['noktp']; ?>
                                                <br><b><?= $m['nama']; ?></b>
                                                <br><?= $m['alamat']; ?> RT. <?= $m['rt']; ?> RW. <?= $m['rw']; ?> Kel. <?= ucwords(strtolower($m['namakel'])); ?> Kec. <?= ucwords(strtolower($m['namakec'])); ?>
                                                <b>TPS. <?= $m['tps']; ?></b>
                                            </td>
                                            <td> <?= $m['program']; ?></td>
                                            <td> <?= $m['nohp']; ?></td>
                                            <!-- <td style="width: 150px">

                                                <a href="https://dtdc.sonsofadam.org/assets/img/dtdc/<?= $m['image']; ?>" class="portfolio-popup">
                                                    <img src="public_html/dtdc.sonsofadam.org/assets/img/dtdc<?= $m['image']; ?>" class="img-thumbnail" />
                                                </a>
                                            </td> -->
                                            <td style="width: 150px">
                                                <a href="<?= base_url('assets/img/dtdc/') . $m['image']; ?>" class="portfolio-popup">
                                                    <img src="<?= base_url('assets/img/dtdc/') . $m['image']; ?> " class="img-thumbnail" />
                                                </a>
                                            </td>

                                            <td><?= $m['name'] ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?= $this->pagination->create_links(); ?>
                        </div>
                        <!-- /.info-box-content -->

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <?php if (!empty($duplicate)) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap" align="center">

                                    <thead>
                                        <TH>#</th>
                                        <TH>NIK</th>
                                        <TH>Duplikat</th>
                                    </thead>
                                    <tbody>

                                        <?php $i = 1; ?>
                                        <?php
                                        foreach ($duplicate as $d) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $d['noktp']; ?></td>
                                                <td> <?= $d['total']; ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.info-box-content -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            <?php endif; ?>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- load library jquery dan highcharts -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-more.js"></script>
<!-- end load library -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<script type="text/javascript">
    // memanggil plugin magnific popup
    $('.portfolio-popup').magnificPopup({
        type: 'image',
        removalDelay: 300,
        mainClass: 'mfp-fade',
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
    // memanggil datatable membuat callback datatable pada magnific popup agar gambar 
    // yang di munculkan sesuai pada saat pindah paginasi dari 1 ke 2 
    // dan seterusnya
    $(document).ready(function() {
        var table = $('#example').dataTable({
            "fnDrawCallback": function() {
                $('.portfolio-popup').magnificPopup({
                    type: 'image',
                    removalDelay: 300,
                    mainClass: 'mfp-fade',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        easing: 'ease-in-out',
                        opener: function(openerElement) {
                            return openerElement.is('img') ? openerElement : openerElement.find('img');
                        }
                    }
                });
            }
        });
    });
</script>


<script type="text/javascript">
    $(function() {
        var chart;
        $(document).ready(function() {
            $.getJSON("<?php echo site_url('potensi/dtdc/list'); ?>", function(json) {

                chart0 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container',
                        type: 'column'
                    },
                    accessibility: {
                        enabled: false
                    },
                    title: {
                        text: 'Capaian Suara Terdaftar Terhadap Target Suara'
                    },
                    xAxis: {
                        categories: ['<a href="<?= base_url('potensi/dtdc/panakkukang'); ?>">Panakkukang</a>', '<a href="<?= base_url('potensi/dtdc/biringkanaya'); ?>">Biringkanaya</a>', '<a href="<?= base_url('potensi/dtdc/manggala'); ?>">Manggala</a>', '<a href="<?= base_url('potensi/dtdc/tamalanrea'); ?>">Tamalanrea</a>']
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