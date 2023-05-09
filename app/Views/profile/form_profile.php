<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= base_url('karyawan/cuti') ?>" class="headerButton goBack">
            <i class="fas fa-arrow-left fa-2x"></i>
        </a>
    </div>
    <div class="pageTitle"><?= ucfirst($judul) ?></div>
    <div class="right"></div>
</div>
<div class="section full mt-5 mb-5">
    <div class="section-title"></div>
    <div class="wide-block pt-2 pb-2">
        <form action="<?= site_url('karyawan/profile/process') ?>" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label for="">Username</label>
                <input type="hidden" name="id_karyawan" id="" value="<?= $karyawan['id_karyawan'] ?>" class="form-control">
                <input type="text" name="username" id="" value="<?= $karyawan['username'] ?>" class="form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['username']) == isset($errors['username']) ? validation_show_error('username') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">Password Lama</label>
                <input type="password" name="passwordlama" id=""" class=" form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['passwordlama']) == isset($errors['passwordlama']) ? validation_show_error('passwordlama') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">Password Baru</label>
                <input type="password" name="password" id="" class="form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['password']) == isset($errors['password']) ? validation_show_error('password') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">Konfirmasi Password</label>
                <input type="password" name="passconf" id="" class="form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['passconf']) == isset($errors['passconf']) ? validation_show_error('passconf') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">Foto</label>
            </div>
            <div class="form-group">
                <label for=""></label>
                <input type="file" name="foto" id="" class="form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['foto']) == isset($errors['foto']) ? validation_show_error('foto') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

</div>