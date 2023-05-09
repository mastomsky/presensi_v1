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
            <?= form_open('panel/jabatan/process') ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_jabatan">Nama Jabatan</label>
                    <input type="hidden" name="id_jabatan" value="<?= $row->id_jabatan ?>">
                    <input type="text" name="nama_jabatan" value="<?= $row->nama_jabatan ?>" id="nama_jabatan"
                        class="form-control" placeholder="Nama jabatan">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['nama_jabatan']) == isset($user['nama_jabatan']) ? validation_show_error('nama_jabatan') : '' ?>
                        </p>
                    </strong>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" name="<?= $form ?>" class="btn btn-success">Save</button>
                <a href="<?= site_url('panel/jabatan') ?>" class="btn btn-secondary">Kembali</a>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>