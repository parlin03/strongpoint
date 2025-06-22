<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ju">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                    <br><a href="<?= base_url('potensi/dtdc/kec/' . $kec); ?>">
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
                        <div class="card-header " style="justify-content: center;">
                            <h3 class="card-title">Capaian Dukungan Kel. <?= ucfirst($kel); ?> Kec. <?= ucfirst($kec); ?> DI TPS <?= ucfirst($tps); ?> </h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0">

                            <table class="table table-hover text-nowrap" align="center">

                                <thead>
                                    <TH>#</th>
                                    <TH>DPT</th>
                                    <th>PIC</th>
                                </thead>
                                <tbody>
                                    <?php if (empty($PencapaianTps)) : ?>
                                        <tr>
                                            <td class="text-center" colspan="7">
                                                <div class="alert alert-danger" role="alert">
                                                    <b>Belum ada dukungan yang terdaftar</b>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $i = 1; ?>
                                    <?php
                                    foreach ($PencapaianTps as $m) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $m['noktp']; ?>
                                                <br><b><?= $m['nama']; ?></b>
                                                <br><?= $m['alamat']; ?> RT. <?= $m['rt']; ?> RW. <?= $m['rw']; ?> Kel. <?= $m['namakel']; ?> Kec. <?= $m['namakec']; ?>
                                                <b>TPS. <?= $m['tps']; ?></b>
                                                <br>No. Telpon : <?= $m['nohp']; ?>
                                                <br>Program : <?= $m['program']; ?>
                                            </td>
                                            <!-- <td style="width: 150px">

                <a href="https://dtdc.sonsofadam.org/assets/img/dtdc/<?= $m['image']; ?>" class="portfolio-popup">
                    <img src="public_html/dtdc.sonsofadam.org/assets/img/dtdc<?= $m['image']; ?>" class="img-thumbnail" />
                </a>
            </td> -->

                                            <td><?= $m['name'] ?></td>
                                        </tr>
                                        <?php $i++; ?>
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
            <br><a href="<?= base_url('potensi/dtdc/kec/' . $kec); ?>">
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
<!-- end load library -->