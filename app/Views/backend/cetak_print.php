<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="stylesheet" href="<?= base_url('back') ?>/dist/css/print.css">
</head>
<style>

</style>

<body onload="window.print(); window.close();">
    <page>

        <div class="section_body">
            <h1><?= $judul ?></h1>
            <table class="table " style="width: 100%;  background-color: #087f5b">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Penempatan</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>lokasi Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Lokasi Keluar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $no = 0;
                    foreach ($row as $ro) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $ro->nama_karyawan ?></td>
                            <td><?= $ro->nama_lokasi ?></td>
                            <td><?= tgl_indo($ro->tgl_presensi) ?></td>
                            <td><?php $t = strtotime($ro->start_in);
                                date('H:i a', $t) ?></td>
                            <td><?= $ro->lokasi_in ?></td>
                            <td><?php $o = strtotime($ro->end_out);
                                date('H:i a', $o) ?></td>
                            <td><?= $ro->lokasi_out ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </page>
</body>

</html>