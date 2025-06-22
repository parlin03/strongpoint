<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ju">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $menu . $title; ?></h1>
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


            <div class="row  d-flex justify-content-center">
                <?php foreach ($hasil as $row) : ?>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="row d-flex justify-content-center">
                                            <h5 class="modal-title" id="editVerifikasiModalLabel">Edit Data <b><?= ' TPS ' . $row['tps']; ?></b></h5>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <?= 'Kecamatan ' . ucwords(strtolower($row['namakec'])) . ' Kelurahan ' . ucwords(strtolower($row['namakel'])); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <form action="<?= base_url('rekapitulasi/update/') . $row['id_tps']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="card-body ">
                                    <!-- <input type="hidden" readonly value="<?= $kel; ?>" name="iddesa" class="form-control">
                                                                <input type="hidden" readonly value="<?= $kec->idkec; ?>" name="idkec" class="form-control"> -->

                                    <input type="hidden" class="form-control" readonly value="<?= 'kec=' . strtolower($row['namakec']) . '&kel=' . strtolower($row['namakel']); ?>" id="link" name="link">
                                    <input type="hidden" class="form-control" readonly value="<?= $row['id_tps']; ?>" id="id_tps" name="id_tps">
                                    <!-- <div class="form-group row">
                                                                    <label for="tps" class="col-sm-9 col-form-label">TPS</label>
                                                                    <div class="col-sm-3">

                                                                        <select class="form-control" id="id_tps" name="id_tps">

                                                                            <option value="<?= $row['id_tps']; ?>"> <?= $row['head']; ?> </option>

                                                                        </select>
                                                                    </div>
                                                                </div> -->
                                    <!-- <hr> -->
                                    <div class="form-group row">
                                        <label for="jml_suara_00" class="col-sm-9 col-form-label">Suara Partai</label>
                                        <div class="col-sm-3">
                                            <input type="Number" class="form-control" id="jml_suara_00" onkeyup="sum();" onmouseup="sum();" name="jml_suara_00" value="<?= $row['jml_suara_00']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jml_suara_01" class="col-sm-9 col-form-label">1. H. ADAM MUHAMMAD, ST, M.SI</label>
                                        <div class="col-sm-3">
                                            <input type="Number" class="form-control" id="jml_suara_01" onkeyup="sum();" onmouseup="sum();" name="jml_suara_01" value="<?= $row['jml_suara_01']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jml_suara_02" class="col-sm-9 col-form-label">2. A M IRWAN PATAWARI, S.Si</label>
                                        <div class="col-sm-3">
                                            <input type="Number" class="form-control" id="jml_suara_02" onkeyup="sum();" onmouseup="sum();" name="jml_suara_02" value="<?= $row['jml_suara_02']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jml_suara_03" class="col-sm-9 col-form-label">3. Hj. NURIMBAYANI DASSIR, S.S</label>
                                        <div class="col-sm-3">
                                            <input type="Number" class="form-control" id="jml_suara_03" onkeyup="sum();" onmouseup="sum();" name="jml_suara_03" value="<?= $row['jml_suara_03']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jml_suara_04" class="col-sm-9 col-form-label">4. HENRY BATARA</label>
                                        <div class="col-sm-3">
                                            <input type="Number" class="form-control" id="jml_suara_04" onkeyup="sum();" onmouseup="sum();" name="jml_suara_04" value="<?= $row['jml_suara_04']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jml_suara_05" class="col-sm-9 col-form-label">5. RESKI AMELIA, S. Farm</label>
                                        <div class="col-sm-3">
                                            <input type="Number" class="form-control" id="jml_suara_05" onkeyup="sum();" onmouseup="sum();" name="jml_suara_05" value="<?= $row['jml_suara_05']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jml_suara_06" class="col-sm-9 col-form-label">6. Dr. SYAMSUDDIN NUR, SH, MH, CPM</label>
                                        <div class="col-sm-3">
                                            <input type="Number" class="form-control" id="jml_suara_06" onkeyup="sum();" onmouseup="sum();" name="jml_suara_06" value="<?= $row['jml_suara_06']; ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="jml_sah" class="col-sm-9 col-form-label">Jumlah Suara</label>
                                        <div class="col-sm-3">
                                            <input type="Number" class="form-control" id="jml_sah" name="jml_sah" value="<?= $row['jml_suara']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- /card-body -->

                                <div class="form-group card-footer">
                                    <div class="row">

                                        <div class="col-sm-6 d-flex justify-content-center mt-3 mb-3">
                                            <a href="<?= base_url() . 'rekapitulasi?kec=' . strtolower($row['namakec']) . '&kel=' . strtolower($row['namakel']); ?>" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</a>
                                        </div>
                                        <div class="col-sm-6 d-flex justify-content-center mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                <?php endforeach; ?>
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    function sum() {
        var jmlSuara0 = document.getElementById('jml_suara_00').value;
        var jmlSuara1 = document.getElementById('jml_suara_01').value;
        var jmlSuara2 = document.getElementById('jml_suara_02').value;
        var jmlSuara3 = document.getElementById('jml_suara_03').value;
        var jmlSuara4 = document.getElementById('jml_suara_04').value;
        var jmlSuara5 = document.getElementById('jml_suara_05').value;
        var jmlSuara6 = document.getElementById('jml_suara_06').value;
        var result = parseInt(jmlSuara0) + parseInt(jmlSuara1) +
            parseInt(jmlSuara2) + parseInt(jmlSuara3) + parseInt(jmlSuara4) +
            parseInt(jmlSuara5) + parseInt(jmlSuara6);
        console.log(result);
        if (!isNaN(result)) {
            document.getElementById('jml_sah').value = result;
        }
    }
</script>