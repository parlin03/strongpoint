<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                    <br><a href="<?= base_url('potensi/dtdc/unreg'); ?>">
                        <i class="fas fa-arrow-left"></i> Kembali<a>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data yang belum terdaftar di DTDC</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>EMAIL</th>
                                        <th>NAMA LENGKAP</th>
                                        <th>NO KTP</th>
                                        <th>ALAMAT LENGKAP</th>
                                        <th>KECAMATAN</th>
                                        <th>KELURAHAN</th>
                                        <th>RT/RW</th>
                                        <th>KOTA</th>
                                        <th>NO. TELEPON / HP</th>
                                        <th>TEMPAT, TANGGAL LAHIR</th>
                                        <th>ASAL SEKOLAH</th>
                                        <th>ANGKATAN MASUK KULIAH</th>
                                        <th>UNIVERSITAS</th>
                                        <th>FAKULTAS</th>
                                        <th>JURUSAN</th>
                                        <th>REKOMENDASI</th>
                                        <th>NAMA AYAH</th>
                                        <th>NAMA IBU</th>
                                        <th>PEKERJAAN AYAH</th>
                                        <th>PEKERJAAN IBU</th>
                                        <th>NO. TELEPON/HP ORANG TUA /WALI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($unreg)) : ?>
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
                                    foreach ($unreg as $m) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $m['email']; ?></td>
                                            <td><?= $m['nama']; ?></td>
                                            <td><?= $m['noktp']; ?></td>
                                            <td><?= $m['alamat']; ?></td>
                                            <td><?= $m['namakec']; ?></td>
                                            <td><?= $m['namakel']; ?></td>
                                            <td><?= $m['rtrw']; ?></td>
                                            <td><?= $m['kota']; ?></td>
                                            <td><?= $m['nohp']; ?></td>
                                            <td><?= $m['ttl']; ?></td>
                                            <td><?= $m['asalsekolah']; ?></td>
                                            <td><?= $m['angkatan']; ?></td>
                                            <td><?= $m['universitas']; ?></td>
                                            <td><?= $m['fakultas']; ?></td>
                                            <td><?= $m['jurusan']; ?></td>
                                            <td><?= $m['rekomendasi']; ?></td>
                                            <td><?= $m['ayah']; ?></td>
                                            <td><?= $m['ibu']; ?></td>
                                            <td><?= $m['kerjaayah']; ?></td>
                                            <td><?= $m['kerjaibu']; ?></td>
                                            <td><?= $m['nohportu']; ?></td>
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
            <br><a href="<?= base_url('potensi/dtdc/unreg'); ?>">
                <i class="fas fa-arrow-left"></i> Kembali<a>
        </div>
        <!-- /.container-fluid -->
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
<!-- AdminLTE App -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->
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

<!-- "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"] -->