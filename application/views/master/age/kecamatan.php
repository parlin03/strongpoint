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
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered table-striped table-hover text-dark text-center ">

                            <thead class="text-center text-light">
                                <tr class="bg-primary">
                                    <TH class="align-middle" rowspan="2">No</th>
                                    <TH class="align-middle" rowspan="2">Kelurahan
                                    <TH class="align-middle" rowspan="2" width="50">Jumlah RW
                                    <TH class="align-middle" rowspan="2" width="50">Jumlah RT
                                    <TH class="align-middle" rowspan="2" width="50">Jumlah DPT
                                    <TH colspan="2">
                                        < 17 Tahun </th>
                                    <TH colspan="2">17-25 Tahun</th>
                                    <TH colspan="2">26-35 Tahun
                                    <TH colspan="2">36-45 Tahun
                                    <TH colspan="2">46-55 Tahun
                                    <TH colspan="2">> 56 Tahun
                                </tr>
                                <tr class="bg-primary">
                                    <TH>Jumlah
                                    <TH>%
                                    <TH>Jumlah
                                    <TH>%
                                    <TH>Jumlah
                                    <TH>%
                                    <TH>Jumlah
                                    <TH>%
                                    <TH>Jumlah
                                    <TH>%
                                    <TH>Jumlah
                                    <TH>%
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($age as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $row->namakel . "</td>";
                                    echo "<td>" . $row->jrw . "</td>";
                                    echo "<td>" . $row->jrt . "</td>";
                                    echo "<td>" . $row->total . "</td>";
                                    echo "<td>" . $row->age0 . "</td>";
                                    echo "<td>" . round($row->age0 / $row->total * 100, 2) . "</td>";
                                    echo "<td>" . $row->age1 . "</td>";
                                    echo "<td>" . round($row->age1 / $row->total * 100, 2) . "</td>";
                                    echo "<td>" . $row->age2 . "</td>";
                                    echo "<td>" . round($row->age2 / $row->total * 100, 2) . "</td>";
                                    echo "<td>" . $row->age3 . "</td>";
                                    echo "<td>" . round($row->age3 / $row->total * 100, 2) . "</td>";
                                    echo "<td>" . $row->age4 . "</td>";
                                    echo "<td>" . round($row->age4 / $row->total * 100, 2) . "</td>";
                                    echo "<td>" . $row->age5 . "</td>";
                                    echo "<td>" . round($row->age5 / $row->total * 100, 2) . "</td>";
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