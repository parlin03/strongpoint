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
                <div class="col-12">

                    <div class="card">
                        <div class="card-header " style="justify-content: center;">
                            <h3 class="card-title">Evaluasi Dukungan Tiap Kelurahan Di Kecamatan <?= ucfirst($kec); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">TPS</th>
                                        <?php $i = 0; ?>
                                        <?php foreach ($kelurahan as $kel) : ?>
                                            <th class="text-center"><?= $kel['namakel'] . ' <br><font size="2">(DTDC)</font>'; ?></th>
                                            <th class="text-center"><?= $kel['namakel'] . ' <br><font size="2">(RPS)</font>'; ?></th>
                                            <?php $i++; ?>
                                            <?php $j[] = $kel['namakel']; ?>
                                            <?php $m[] = $kel['jtps']; ?>
                                        <?php endforeach; ?>
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

                                    <?php for ($l = 0; $l < $i; ++$l) {
                                        $total[$l] = 0;
                                    } ?>
                                    <!-- <?php $total[1] = 0; ?> -->
                                    <?php foreach ($export as $row) : ?>
                                        <tr>
                                            <th class="text-center"><?= $row['tps']; ?></th>
                                            <?php for ($k = 0; $k < $i; ++$k) {
                                                echo "<td class='text-center'><a href='" . base_url('potensi/dtdc/tps/' . $kec . "/" . strtolower($j[$k]) . "/" . $row['tps']) . "'>" . ($m[$k] >= $row['tps']   ? $row['C' . $k] : null)  . "</td>";
                                                echo "<td class='text-center " . ($row['D' . $k] == 0 & $row['D' . $k] != null ? "bg-red" : "") . "'>" . ($m[$k] >= $row['tps']   ? $row['D' . $k] : null)  . "</td>";
                                                // $total[$k] += $row['C' . $k];
                                            } ?>
                                        </tr>
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
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts-more.js"></script>
<!-- end load library -->


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
            // "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", {
                extend: 'pdf',
                orientation: 'landscape'
            }, "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>