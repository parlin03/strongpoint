<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ju">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                    <br><a href="<?= base_url('potensi/tim50/kec/' . $kec); ?>">
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

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">

                                <thead>
                                    <TH>#</th>
                                    <TH>DPT</th>
                                    <th>PIC</th>
                                    <th></th>
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
                                            </td>
                                            <td><?= $m['name'] ?></td>
                                            <td style="width: 0.1em" class="<?= $m['status'] == 'Terdaftar DPT' ? 'bg-green' : 'bg-red'; ?>"></td>
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
            <br><a href="<?= base_url('potensi/tim50/kec/' . $kec); ?>">
                <i class="fas fa-arrow-left"></i> Kembali<a>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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