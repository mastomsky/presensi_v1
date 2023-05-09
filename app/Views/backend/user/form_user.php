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
        <div class="card-body">
            <?= form_open('user/process' . $form) ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_user">Nama</label>
                    <input type="hidden" name="id_user" value="<?= $row->id_user ?>" id="id_user">
                    <input type="text" name="nama_user" value="<?= $row->nama_user ?>" id="nama_user" class="form-control" placeholder="Nama">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['nama_user']) == isset($user['nama_user']) ? validation_show_error('nama_user') : '' ?>
                        </p>
                    </strong>
                </div>

                <div class="form-group">
                    <label for="alamat">Jabatan</label>
                    <select name="id_jabatan" id="" class="form-control">
                        <option value="">Pilih Jabatan</option>
                        <?php
                        foreach ($jabatan as $jab) { ?>
                            <option value="<?= $jab->id_jabatan ?>" <?= ($jab->id_jabatan == $row->id_jabatan ? 'selected' : null) ?>>
                                <?= ucfirst($jab->nama_jabatan) ?></option>
                        <?php }
                        ?>
                    </select>
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['id_jabatan']) == isset($user['id_jabatan']) ? validation_show_error('id_jabatan') : '' ?>
                        </p>
                    </strong>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?= $row->username ?>" id="username" class="form-control" placeholder="Username">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['username']) == isset($user['username']) ? validation_show_error('username') : '' ?>
                        </p>
                    </strong>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="" id="password" class="form-control" placeholder="Password">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['password']) == isset($user['password']) ? validation_show_error('password') : '' ?>
                        </p>
                    </strong>
                </div>
                <div class="form-group">
                    <label for="status_user">Status</label>
                    <select name="status_user" id="" class="form-control">
                        <option value="">Pilih Status</option>
                        <option value="1" <?= $row->status_user == 1 ? 'selected' : null ?>>Aktif</option>
                        <option value="2">Tidak Aktif</option>
                    </select>
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['status_user']) == isset($user['status_user']) ? validation_show_error('status_user') : '' ?>
                        </p>
                    </strong>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" value="<?= $form ?>" class="btn btn-success">Save</button>
                <a href="<?= site_url('panel/user') ?>" class="btn btn-secondary">Kembali</a>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>