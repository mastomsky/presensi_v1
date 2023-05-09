<div class="col-md-12">
    <div class="card card-primary shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Permohonan cuti ini di input pada hari <?= tgl_indo($row->created_at) ?></h3>
            <div class="card-tools">
                <a href="<?= site_url('panel/cuti') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left mr-1"></i>Kembali</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body ">
            <div class="card-body">
                <form class="form-horizontal" id="form_approve">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id_cuti" id="id_cuti" value="<?= $row->id_cuti ?>">
                                <input type="text" class="form-control" id="nama_karyawan" value="<?= ucfirst($row->nama_karyawan) ?> " readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tgl_mulai" value="<?= tgl_indo($row->tgl_mulai) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_selesai" class="col-sm-2 col-form-label">Tanggal selesai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tgl_selesai" value="<?= tgl_indo($row->tgl_selesai) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mulai_kerja" class="col-sm-2 col-form-label">Masuk Kerja</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mulai_kerja" value="<?= tgl_indo($row->mulai_kerja) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_mulai" class="col-sm-2 col-form-label">File Bukti</label>
                            <div class="col-sm-10">
                                <img src="<?= base_url('uploads/berkas_cuti/' . $row->berkas) ?>" width="220px" height="140px" alt="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_mulai" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <a class="btn btn-sm btn-info" href="<?= base_url('uploads/berkas_cuti/' . $row->berkas) ?>" target="_blank"><i class="fas fa-download mr-1"></i>Lihat
                                    Berkas</a>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-10">
                                <textarea name="" id="" class="form-control" readonly rows="5"><?= ucfirst($row->keterangan) ?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer offset-2">

                        <?php if ($row->status_cuti == null) {  ?>
                            <button type="submit" class="btn btn-success" id="setujui" name="setujui"><i class="fas fa-thumbs-up mr-1"></i>Setujui</button>
                            <button type="submit" class="btn btn-danger" id="tolak" name="tolak"><i class="fas fa-thumbs-down mr-1"></i>Tolak</button>
                        <?php } ?>
                        <?php if ($row->status_cuti == 1) { ?>
                            <button type="submit" class="btn btn-danger" id="tolak" name="tolak"><i class="fas fa-thumbs-down mr-1"></i>Tolak</button>
                        <?php } ?>
                        <?php if ($row->status_cuti == 2) { ?>
                            <button type="submit" class="btn btn-success" id="setujui" name="setujui"><i class="fas fa-thumbs-up mr-1"></i>Setujui</button>
                        <?php } ?>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<script>
    $(document).on('click', '#setujui', function(event) {
        event.preventDefault();
        var id = $('#id_cuti').val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url() ?>cuti/cuti_setujui",
            dataType: 'json',
            data: {
                id: id,
            },
            success: function(res) {
                if (res.hasil == 'true') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Permohonan Cuti Berhasil Di Setujui !!',
                        showConfirmButton: false,
                        footer: '<a class="btn btn-success btn-flat" href="<?= site_url('panel/cuti') ?>">OK</a>'
                    }, );

                }
                if (res.hasil == 'false') {
                    Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Permohonan Cuti Gagal Di Setujui !!'
                        },
                        function() {

                        });
                }
            }
        });
    });
    $(document).on('click', '#tolak', function(event) {
        event.preventDefault();
        var id = $('#id_cuti').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>cuti/cuti_tolak",
            dataType: 'json',
            data: {
                id: id,
            },

            success: function(res) {
                if (res.hasil == 'true') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Permohonan Cuti Berhasil Di Tolak !!',
                        showConfirmButton: false,
                        footer: '<a class="btn btn-success btn-flat" href="<?= site_url('panel/cuti') ?>">OK</a>'

                    }, );
                }
                if (res.hasil == 'false') {
                    Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Permohonan Cuti Gagal Di Tolak !!'
                        },
                        function() {

                        });
                }
            }
        });
    });
</script>