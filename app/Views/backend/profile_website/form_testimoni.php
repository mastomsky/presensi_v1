<div class="col-md-12">
    <div class="card card-primary shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>

        </div>
        <!-- /.card-header -->
        <?php $errors = validation_errors();
        if (session()->get('pesan')) {
            echo '<div class="alert alert-danger">';
            echo session()->get('pesan');
            echo '</div>';
        }
        ?>
        <div class="card-body offset-3 col-lg-4">
            <?= form_open('panel/website/profile/testimoni/process') ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_testi">Nama</label>
                    <input type="hidden" name="id_testimoni" value="">
                    <input type="text" name="nama_testi" value="" id="nama_testi" class="form-control" placeholder="Nama">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['nama_testi']) == isset($user['nama_testi']) ? validation_show_error('nama_testi') : '' ?>
                        </p>
                    </strong>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" id="" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="gambar">Foto</label>
                    <input type="file" name="foto" value="" id="foto" class="form-control">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['foto']) == isset($user['foto']) ? validation_show_error('foto') : '' ?>
                        </p>
                    </strong>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" name="<?= $form ?>" class="btn btn-success">Save</button>
                <a href="<?= site_url('panel/website/profile/gambar-slide') ?>" class="btn btn-secondary">Kembali</a>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>