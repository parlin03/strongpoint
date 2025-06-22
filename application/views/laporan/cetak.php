<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Nik</th>
        <th>Nama</th>
        <th>Kecamatan</th>
        <th>Keluraha</th>
        <th>Alamat</th>
    </tr>
    <?php $no = 1;
    foreach ($dpt as $row) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row->noktp; ?></td>
            <td><?= $row->nama; ?></td>
            <td><?= $row->namakec; ?></td>
            <td><?= $row->namakel; ?></td>
            <td><?= $row->alamat; ?></td>
        </tr>
    <?php endforeach ?>
</table>
<script>
    window.print();
</script>