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
                                    <TH>#</th>
                                    <TH>NIK</th>
                                    <TH>Nama</th>
                                    <TH>Alamat</th>
                                    <TH>RT</th>
                                    <TH>RW</th>
                                    <TH>Kelurahan</th>
                                    <TH>Domisili</th>
                                    <TH>Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($simpul as $row) {
                                    echo "<tr>";
                                    echo "<th>" . $i . "</th>";
                                    echo "<td>" . $row->noktp . "</td>";
                                    echo "<td>" . $row->nama . "</td>";
                                    echo "<td>" . $row->alamat . "</td>";
                                    echo "<td>" . $row->rt . "</td>";
                                    echo "<td>" . $row->rw . "</td>";
                                    echo "<td>" . $row->namakel  . "</td>";
                                    echo "<td>" . $row->domisili . "</td>";
                                    echo "<td>" . $row->nohp . "</td>";
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