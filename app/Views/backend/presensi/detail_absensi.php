<div class="col-md-12">
    <div class="card card-info shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Absensi <?= tgl_indo($row->tgl_presensi) ?></h3>
            <div class="card-tools">
                <a href="<?= site_url('panel/absensi') ?>" class="btn btn-secondary"><i
                        class="fa fa-arrow-left mr-1"></i>Kembali</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="card-body">
                <div class="row justify-content-center pb-2">
                    <img style="width: 200px;" src="<?= base_url('uploads/karyawan/' . $row->foto_karyawan) ?>" alt=""
                        class="img-thumbnail"><br>
                </div>
                <div class="row justify-content-center">

                    <div class=" col-md-4 text-center">
                        <table class="table">
                            <tr>
                                <th>NIP</th>
                                <td><?= $karyawan->nip ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td><?= ucfirst($karyawan->nama_karyawan) ?></td>
                            </tr>
                            <tr>
                                <th>Tempat</th>
                                <td><?= $karyawan->nama_lokasi ?></td>
                            </tr>
                            <tr>
                                <th>Jam Kerja</th>
                                <td><?= $karyawan->nama_shift ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <h5>Masuk</h5>
                        <table class="table">
                            <tr>
                                <th>Foto</th>
                                <td><img width="200px" src="<?= base_url('uploads/presensi/' . $row->foto_in) ?>"
                                        alt=""></td>
                            </tr>
                            <tr>
                                <th>Jam</th>
                                <td><?= jam_in($row->start_in, $row->jam_in) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Pulang</h5>
                        <table class="table">
                            <tr>
                                <th>Foto</th>
                                <td><img width="200px" src="<?= base_url('uploads/presensi/' . $row->foto_out) ?>"
                                        alt=""></td>
                            </tr>
                            <tr>
                                <th>Jam</th>
                                <td><?= date($row->jam_out) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>