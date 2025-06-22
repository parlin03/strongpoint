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

                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="info-box mb-10">
                                    <div class="table table-responsive">
                                        <table class="table table-bordered table-striped table-hover ">
                                            <thead class="text-center text-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Jenis Program</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Capaian</th>
                                                    <th scope="col">Persentase(%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $jjumlah = 0;
                                                $jcapaian = 0;
                                                ?>

                                                <?php
                                                foreach ($capaian as $c) :
                                                ?>

                                                    <tr>
                                                        <th class="text-center" scope="row"><?= $i; ?>
                                                        </th>
                                                        <td class="text-center"><?= $c['program']; ?></td>
                                                        <td class="text-center"><?= $c['jumlah']; ?></td>
                                                        <td class="text-center"><?= $c['capaian']; ?></td>
                                                        <td class="text-center"><?= number_format((($c['capaian'] / $c['jumlah']) * 100), 2); ?></td>

                                                    </tr>
                                                <?php
                                                    $i++;
                                                    $jjumlah += $c['jumlah'];
                                                    $jcapaian += $c['capaian'];
                                                endforeach;
                                                ?>

                                            </tbody>
                                            <tfoot>
                                                <tr class="text-center">
                                                    <th class="border" colspan="2">Total</th>
                                                    <th class="border"><?= $jjumlah; ?></th>
                                                    <th class="border"><?= $jcapaian; ?></th>
                                                    <th class="border"><?= number_format((($jcapaian / $jjumlah) * 100), 2); ?></th>

                                                </tr>
                                            </tfoot>
                                        </table>
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