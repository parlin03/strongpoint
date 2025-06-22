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
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="table table-responsive bg-white">
                        <table class="table table-bordered table-striped table-hover text-dark text-center ">
                            <thead class="text-center text-light">
                                <tr class="bg-primary">
                                    <TH class="align-middle" rowspan="2">No</th>
                                    <TH class="align-middle" rowspan="2">Kelurahan</th>
                                    <TH class="align-middle" rowspan="2" width="50">Jumlah RW</th>
                                    <TH class="align-middle" rowspan="2" width="50">Jumlah RT</th>
                                    <TH class="align-middle" rowspan="2" width="50">Jumlah DPT</th>
                                    <TH class="align-middle" rowspan="2" width="50">Jumlah KK</th>
                                    <TH colspan="2">1 Orang/KK</th>
                                    <TH colspan="2">2 Orang/KK</th>
                                    <TH colspan="2">3 Orang/KK</th>
                                    <TH colspan="2">4 Orang/KK</th>
                                    <TH colspan="2">5 Orang/KK</th>
                                    <TH colspan="2">>5 Orang/KK</th>
                                </tr>
                                <tr class="bg-primary">
                                    <TH>Jumlah</TH>
                                    <TH>%</TH>
                                    <TH>Jumlah</TH>
                                    <TH>%</TH>
                                    <TH>Jumlah</TH>
                                    <TH>%</TH>
                                    <TH>Jumlah</TH>
                                    <TH>%</TH>
                                    <TH>Jumlah</TH>
                                    <TH>%</TH>
                                    <TH>Jumlah</TH>
                                    <TH>%</TH>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($kk as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $row->namakela . "</td>";
                                    echo "<td>" . $row->jrw . "</td>";
                                    echo "<td>" . $row->jrt . "</td>";
                                    echo "<td>" . $row->total . "</td>";
                                    echo "<td>" . $row->tjnokk . "</td>";
                                    echo "<td>" . $row->kk1 . "</td>";
                                    echo "<td>" . round($row->kk1 / $row->tjnokk * 100, 2) . "</td>";
                                    echo "<td>" . $row->kk2 . "</td>";
                                    echo "<td>" . round($row->kk2 / $row->tjnokk * 100, 2) . "</td>";
                                    echo "<td>" . $row->kk3 . "</td>";
                                    echo "<td>" . round($row->kk3 / $row->tjnokk * 100, 2) . "</td>";
                                    echo "<td>" . $row->kk4 . "</td>";
                                    echo "<td>" . round($row->kk4 / $row->tjnokk * 100, 2) . "</td>";
                                    echo "<td>" . $row->kk5 . "</td>";
                                    echo "<td>" . round($row->kk5 / $row->tjnokk * 100, 2) . "</td>";
                                    echo "<td>" . $row->kk6 . "</td>";
                                    echo "<td>" . round($row->kk6 / $row->tjnokk * 100, 2) . "</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->