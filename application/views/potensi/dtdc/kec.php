<link rel="stylesheet" href="<?= base_url('assets/') ?>css/fix-head-1stcoloum-table.css">
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

                    <!-- /.card-header -->

                    <div class="card">
                        <div class="card-header " style="justify-content: center;">
                            <h3 class="card-title">Capaian Dukungan Tiap Kelurahan Di Kecamatan <?= ucfirst($kec); ?></h3>
                        </div>
                        <!-- <div class="card-body table-responsive table-scroll" p-0">
                            <table class="table table-sm table-hover text-nowrap"> -->
                        <div id="table-scroll" class="table-scroll height: 400px" style="height: 400px;">
                            <table id="main-table" class="main-table">
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
                                    <?php foreach ($PencapaianKec as $pt) : ?>
                                        <tr>
                                            <th class="text-center"><?= $pt['tps']; ?></th>
                                            <?php for ($k = 0; $k < $i; ++$k) {
                                                echo "<td class='text-center'><a href='" . base_url('potensi/dtdc/tps/' . $kec . "/" . strtolower($j[$k]) . "/" . $pt['tps']) . "'>" . ($m[$k] >= $pt['tps']   ? $pt['C' . $k] : null)  . "</td>";
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
            <br><a href="<?= base_url('potensi/dtdc/'); ?>">
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