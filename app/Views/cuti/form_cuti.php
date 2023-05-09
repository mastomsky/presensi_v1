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
        <form action="<?= site_url('karyawan/cuti/process' . $form) ?>" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label for="">Keperluan Cuti</label>
                <select name="keperluan" id="" class="form-control">
                    <option value="">Pilih Keperluan</option>
                    <option value="1" <?= ($row->keperluan == 1 ? 'selected' : null) ?>>Izin</option>
                    <option value="2" <?= ($row->keperluan == 2 ? 'selected' : null) ?>>Sakit</option>
                </select>
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['tgl_mulai']) == isset($errors['tgl_mulai']) ? validation_show_error('tgl_mulai') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" id="" value="<?= $row->tgl_mulai ?>" class="form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['tgl_mulai']) == isset($errors['tgl_mulai']) ? validation_show_error('tgl_mulai') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" id="" value="<?= $row->tgl_selesai ?>" class="form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['tgl_selesai']) == isset($errors['tgl_selesai']) ? validation_show_error('tgl_selesai') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">Mulai Kerja</label>
                <input type="date" name="mulai_kerja" id="" value="<?= $row->mulai_kerja ?>" class="form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['mulai_kerja']) == isset($errors['mulai_kerja']) ? validation_show_error('mulai_kerja') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">File Bukti Cuti</label>
                <?php if ($page == 'edit') {
                    if ($row->berkas != null) { ?>
                        <img src="<?= base_url('uploads/berkas_cuti/' . $row->berkas) ?>" alt="" width="330px">
                <?php  }
                } ?>
            </div>
            <div class="form-group">
                <label for=""></label>
                <input type="file" name="berkas" id="" class="form-control">
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['berkas']) == isset($errors['berkas']) ? validation_show_error('berkas') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" id="" class="form-control" rows="5"><?= ucfirst($row->keterangan) ?></textarea>
                <strong>
                    <p class="text text-danger">
                        <?= isset($errors['keterangan']) == isset($errors['keterangan']) ? validation_show_error('keterangan') : '' ?>
                    </p>
                </strong>
            </div>
            <div class="form-group">
                <button type="submit" name="<?= $form ?>" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

</div>