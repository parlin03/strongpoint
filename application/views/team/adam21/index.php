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
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap" align="center">
                                    <thead class="text-center text-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">PIP</th>
                                            <th scope="col">KIP</th>
                                            <th scope="col">BPUM</th>
                                            <th scope="col">Bedah Rumah</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $jpip = 0;
                                        $jkip = 0;
                                        $jbpum = 0;
                                        $jbr = 0;
                                        ?>

                                        <?php foreach ($adam21 as $a) : ?>

                                            <tr>
                                                <th class="text-center" scope="row"><?= $i; ?>
                                                </th>
                                                <td><?= $a['username']; ?></td>
                                                <td class="text-center"><?= $a['pip']; ?></td>
                                                <td class="text-center"><?= $a['kip']; ?></td>
                                                <td class="text-center"><?= $a['bpum']; ?></td>
                                                <td class="text-center"><?= $a['br']; ?></td>
                                                <td class="text-center">
                                                    <?= $a['kip'] + $a['pip'] + $a['bpum'] + $a['br']; ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                            $jpip += $a['pip'];
                                            $jkip += $a['kip'];
                                            $jbpum += $a['bpum'];
                                            $jbr += $a['br'];
                                        endforeach;
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th class="border" colspan="2">Total</th>
                                            <th class="border"><?= $jpip; ?></th>
                                            <th class="border"><?= $jkip; ?></th>
                                            <th class="border"><?= $jbpum; ?></th>
                                            <th class="border"><?= $jbr; ?></th>
                                            <th class="border"><?= $jpip + $jkip + $jbpum + $jbr; ?></th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
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