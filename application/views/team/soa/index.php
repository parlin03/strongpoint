<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h5 class="card-title">Monthly Recap Report</h5> -->
                            <div class="row">
                                <div class="col-md-5">
                                    <form action=" <?= base_url('team/soa/index')  ?>" method="POST">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Cari Nama/Sekolah..." name="keyword" autocomplete="off" autofocus>
                                            <div class="input-group-append">
                                                <input class="btn btn-primary" type="submit" name="submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5>Result: <?= $total_rows; ?></h5>
                            <div class="row justify-content-center">
                                <div class="info-box mb-10">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover text-dark  ">

                                            <thead class="text-center">
                                                <th class="border">#</th>
                                                <th class="border">NIK</th>
                                                <th class="border">NAMA LENGKAP</th>
                                                <th class="border">NAMA PANGGILAN</th>
                                                <!-- <th class="border">EMAIL</th> -->
                                                <th class="border">NO TELPON</th>
                                                <th class="border">Action</th>
                                            </thead>

                                            <tbody>
                                                <?php if (empty($soa)) : ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <div class="alert alert-danger" role="alert">
                                                                data not found!
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php
                                                foreach ($soa as $row) : ?>
                                                    <tr class="text-center">

                                                        <!-- Number -->
                                                        <td class="border"> <?= ++$start; ?></td>
                                                        <td class="border"><?= $row['noktp'] ?></td>
                                                        <td class="border"><?= $row['nama'] ?></td>
                                                        <td class="border"><?= $row['alias'] ?></td>
                                                        <!-- <td class="border"><?= $row['email'] ?></td> -->
                                                        <td class="border"><?= $row['nohp'] ?></td>

                                                        <td class="border text-center">
                                                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#detailModal<?= $row['id'] ?>">Details</a>
                                                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#dtdcModal<?= $row['id'] ?>">DTDC</a>
                                                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#VerifikasiModal<?= $row['id'] ?>">Verifikasi</a>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal detail -->
                                                    <div class="modal fade" id="detailModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog  modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detailModalLabel"><?= $row['nama'] ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="<?= base_url('menu'); ?>" method="POST">

                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">NIK</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['noktp'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Nama Panggilan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['alias'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Email</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['email'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Alamat</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['alamat'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Kecamatan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['namakec'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Kelurahan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['namakel'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">RT / RW</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['rtrw'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Kota</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['kota'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">No Telpon</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['nohp'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['ttl'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Asal Sekolah</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['sekolah'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Angkatan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['angkatan'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Universitas</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['universitas'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Fakultas</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['fakultas'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Jurusan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['jurusan'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Rekomendasi</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['rekomendasi'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Nama Ayah</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['ayah'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Nama Ibu</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['ibu'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Pekerjaan Ayah</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['kerja_ayah'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">Pekerjaan Ibu</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['kerja_ibu'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-4 col-form-label">No HP Orang Tua</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" placeholder="<?= $row['hp_ortu'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal Detail -->

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?= $this->pagination->create_links(); ?>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </div>
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