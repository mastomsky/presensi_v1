<div class="col-md-12">
    <div class="card card-primary shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php $errors = validation_errors();
            if (session()->get('pesan')) {
                echo '<div class="alert alert-danger">';
                echo session()->get('pesan');
                echo '</div>';
            }
            ?>
            <?= form_open('shift/process') ?>
            <div class="card-body">
                <div class="form-group col-md-4">
                    <label for="nama_shift">Nama Shift</label>
                    <input type="hidden" name="id_shift" id="" value="<?= $row->id_shift ?>">
                    <input type="text" name="nama_shift" value="<?= $row->nama_shift ?>" id="nama_shift" class="form-control" placeholder="Nama Shift">
                </div>
                <strong>
                    <p class="text text-danger">
                        <?= isset($user['nama_shift']) == isset($user['nama_shift']) ? validation_show_error('nama_shift') : '' ?>
                    </p>
                </strong>
                <div class="form-group col-md-4">
                    <label for="start_in">Jam Masuk</label>
                    <input type="time" name="start_in" id="start_in" value="<?= $row->start_in ?>" class="form-control" placeholder="Jam Masuk">
                </div>
                <strong>
                    <p class="text text-danger">
                        <?= isset($user['start_in']) == isset($user['start_in']) ? validation_show_error('start_in') : '' ?>
                    </p>
                </strong>
                <div class="form-group col-md-4">
                    <label for="end_out">Jam Keluar</label>
                    <input type="time" name="end_out" id="end_out" value="<?= $row->end_out ?>" class="form-control" placeholder="Jam Keluar">

                </div>
                <strong>
                    <p class="text text-danger">
                        <?= isset($user['end_out']) == isset($user['end_out']) ? validation_show_error('end_out') : '' ?>
                    </p>
                </strong>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" name="<?= ($form) ?>" class="btn btn-success">Save</button>
                <a href="<?= site_url('shift') ?>" class="btn btn-secondary">Kembali</a>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>