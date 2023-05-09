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
            <?= form_open('panel/website/profile/gambar-slide/process') ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_carousel">Nama</label>
                    <input type="hidden" name="id_carousel" value="">
                    <input type="text" name="nama_carousel" value="" id="nama_carousel" class="form-control" placeholder="Nama">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['nama_carousel']) == isset($user['nama_carousel']) ? validation_show_error('nama_carousel') : '' ?>
                        </p>
                    </strong>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" value="" id="gambar" class="form-control">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['gambar']) == isset($user['gambar']) ? validation_show_error('gambar') : '' ?>
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