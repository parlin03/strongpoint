<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                    <br><a href="<?= base_url('potensi/dtdc/'); ?>">
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
                        <!-- <form id="form-filter">
                            <div class="card-header">
                                <div class="form-group row justify-content-end">
                                    <label for="filter" class="col-form-label col-md-2">Filter Program <?= $filter; ?></label>
                                    <div class="col-sm-3">


                                        <select id="filter" name="filter" class="form-control select2">
                                            <option value="" selected>Pilih Program</option>
                                            <option value="" <?= ($filter == '' ? 'selected' : ''); ?>>All Program</option>
                                            <option value="Beasiswa KIP" <?= ($filter == 'Beasiswa KIP' ? 'selected' : ''); ?>>Beasiswa KIP</option>
                                            <option value="Beasiswa PIP" <?= ($filter == 'Beasiswa PIP' ? 'selected' : ''); ?>>Beasiswa PIP</option>
                                            <option value="Bedah Rumah" <?= ($filter == 'Bedah Rumah' ? 'selected' : ''); ?>>Bedah Rumah</option>
                                            <option value="BPUM" <?= ($filter == 'BPUM' ? 'selected' : ''); ?>>BPUM</option>
                                            <option value="Pasukan Ayam Jantan" <?= ($filter == 'Pasukan Ayam Jantan' ? 'selected' : ''); ?>>Pasukan Ayam Jantan</option>
                                            <option value="Pasukan Timur" <?= ($filter == 'Pasukan Timur' ? 'selected' : ''); ?>>Pasukan Timur</option>
                                            <option value="Pelayanan" <?= ($filter == 'Pelayanan' ? 'selected' : ''); ?>>Pelayanan</option>
                                            <option value="Relawan Doa Ibu" <?= ($filter == 'Relawan Doa Ibu' ? 'selected' : ''); ?>>Relawan Doa Ibu</option>
                                            <option value="Tandem Paman" <?= ($filter == 'Tandem Paman' ? 'selected' : ''); ?>>Tandem Paman</option>
                                            <option value="Tandem Tabir" <?= ($filter == 'Tandem Tabir' ? 'selected' : ''); ?>>Tandem Tabir</option>
                                            <option value="Tim 10" <?= ($filter == 'Tim 10' ? 'selected' : ''); ?>>Tim 10</option>
                                            <option value="Tim 25" <?= ($filter == 'Tim 25' ? 'selected' : ''); ?>>Tim 25</option>
                                            <option value="Tim 50" <?= ($filter == 'Tim 50' ? 'selected' : ''); ?>>Tim 50</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="btn-reset" class="btn btn-sm elevation-1 btn-info"><i class="fas fa-sync-alt"></i> Reset</button>
                                        <button type="button" id="btn-filter" class="btn btn-sm elevation-1 btn-danger"><i class="fas fa-search"></i> Filter</button>
                                    </div>

                                </div>
                            </div>
                        </form> -->
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <TH>#</th>
                                        <TH>NIK</th>
                                        <TH>Nama</th>
                                        <TH>Alamat</th>
                                        <TH>Kelurahan</th>
                                        <TH>Kecamatan</th>
                                        <TH>TPS</th>
                                        <TH>Program</th>
                                        <TH>No. HP</th>
                                        <!-- <TH>Foto KTP</th> -->
                                        <th>PIC</th>
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

                                    <!-- <?php $i = 1; ?>
                                    <?php
                                    foreach ($export as $m) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $m['noktp']; ?></td>
                                            <td><b><?= $m['nama']; ?></b></td>
                                            <td>
                                                <?= $m['alamat']; ?> RT. <?= $m['rt']; ?> RW. <?= $m['rw']; ?>
                                            </td>
                                            <td>
                                                <?= ucwords(strtolower($m['namakel'])); ?>/<?= ucwords(strtolower($m['namakec'])); ?>
                                            </td>
                                            <td>
                                                <b><?= $m['tps']; ?></b>
                                            </td>
                                            <td> <?= $m['program']; ?></td>
                                            <td> <?= $m['nohp']; ?></td>

                                            <td><?= $m['name'] ?></td>
                                        </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?> -->

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
            <br><a href="<?= base_url('potensi/dtdc/'); ?>">
                <i class="fas fa-arrow-left"></i> Kembali<a>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- jQuery -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script>
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

<script type="text/javascript">
    var dataTable_;
    $(document).ready(function() {
        dataTable_ = $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,

            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": 'export_list',
                "type": "POST"
            },
            "buttons": [{
                "extend": 'copy',
                "action": newexportaction
            }, {
                "extend": 'csv',
                "action": newexportaction
            }, {
                "extend": 'excel',
                "text": 'Excel',
                "titleAttr": 'Excel',
                "action": newexportaction
            }, {
                "extend": 'pdf',
                "action": newexportaction,
                "orientation": 'landscape'
            }, {
                "extend": 'print',
                "text": 'Print',
                "titleAttr": 'Print',
                "action": newexportaction
            }],
            "dom": 'Bfrtip',
            "select": true,
            "serverSide": true

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        function newexportaction(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function(e, s, data) {
                // Just this once, load all data from the server...
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function(e, settings) {
                    // Call the original action function
                    if (button[0].className.indexOf('buttons-copy') >= 0) {
                        $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                        $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                        $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                        $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-print') >= 0) {
                        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                    }
                    dt.one('preXhr', function(e, s, data) {
                        // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                        // Set the property to what it was before exporting.
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                    setTimeout(dt.ajax.reload, 0);
                    // Prevent rendering of the full data to the DOM
                    return false;
                });
            });
            // Requery the server with the new one-time export settings
            dt.ajax.reload();
        }

    });
</script>