<table class="table table-striped">
    <tr>
        <TH>#</th>
        <TH>NIK</th>
        <TH>Nama</th>
        <TH>Alamat</th>
        <TH>RT</th>
        <TH>RW</th>
        <TH>Kelurahan</th>
    </tr>
    <?php $no = 1;
    foreach ($dpt as $row) : ?>
        <tr>
            <th class="text-right"> <?= ++$start; ?> </th>
            <td class="text-center"> <?= $row['noktp']; ?></td>
            <td> <?= $row['nama']; ?></td>
            <td> <?= $row['alamat']; ?></td>
            <td class="text-center"> <?= $row['rt']; ?></td>
            <td class="text-center"> <?= $row['rw']; ?></td>
            <td> <?= $row['namakel']; ?></td>
        </tr>
    <?php endforeach ?>
</table>
<?= $this->pagination->create_links(); ?>
<script>
    window.print();
</script>
<!-- <a href="<?= base_url('Cetak_Filter/cetak'); ?>"><i class="fa fa-print"></i>print</a> -->