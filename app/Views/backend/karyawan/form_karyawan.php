<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <?php if ($form == 'add') { ?>
            <div class="card-tools">
                <a type="button" data-toggle="modal" data-target="#modal-import" class="btn btn-success"><i
                        class="fas fa-upload mr-1"></i>Import
                    Excel</a>
            </div>
            <?php } else { ?>
            <div class="card-tools">
                <a href="<?=site_url('panel/karyawan')?>" class="btn btn-secondary"><i
                        class="fa fa-arrow-left mr-1"></i>Kembali</a>
            </div>
            <?php } ?>
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
            <?= form_open('panel/karyawan/process' . $form) ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="hidden" name="id_karyawan" value="<?= $row->id_karyawan ?>" id="id_karyawan">
                    <input type="text" name="nip" value="<?= $row->nip ?>" id="nip" class="form-control" readonly>
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['nip']) == isset($user['nip']) ? validation_show_error('nip') : '' ?>
                        </p>
                    </strong>
                </div>
                <div class="form-group">
                    <label for="nama_karyawan">Nama karyawan</label>
                    <input type="text" name="nama_karyawan" value="<?= $row->nama_karyawan ?>" id="nama_karyawan"
                        class="form-control" placeholder="Nama karyawan">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['nama_karyawan']) == isset($user['nama_karyawan']) ? validation_show_error('nama_karyawan') : '' ?>
                        </p>
                    </strong>
                </div>
                <div class="form-group">
                    <label for="telpon">Telpon</label>
                    <br>
                    <input type="tel" name="telpon" id="mobile-number" value="<?= $row->telpon ?>" class="form-control"
                        placeholder="">
                    <strong>
                        <span class="hide" id="valid-msg"></span>
                        <span class="hide" id="error-msg"></span>
                        <p class="text text-danger">
                            <?= isset($user['telpon']) == isset($user['telpon']) ? validation_show_error('telpon') : '' ?>
                        </p>
                    </strong>
                </div>

                <div class="form-group">
                    <label for="alamat">Jabatan</label>
                    <select name="id_jabatan" id="" class="form-control">
                        <option value="">Pilih Jabatan</option>
                        <?php
                        foreach ($jabatan as $jab) { ?>
                        <option value="<?= $jab->id_jabatan ?>"
                            <?= ($jab->id_jabatan == $row->id_jabatan ? 'selected' : null) ?>>
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
                    <label for="alamat">Lokasi</label>
                    <select name="id_lokasi" id="id_lokasi" class="form-control">
                        <option value="">Pilih Lokasi</option>
                        <?php
                        foreach ($lokasi as $cab) { ?>
                        <option value="<?= $cab->id_lokasi ?>"
                            <?= ($cab->id_lokasi == $row->id_lokasi ? 'selected' : null) ?>>
                            <?= ucfirst($cab->nama_lokasi) ?></option>
                        <?php }
                        ?>
                    </select>
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['id_lokasi']) == isset($user['id_lokasi']) ? validation_show_error('id_lokasi') : '' ?>
                        </p>
                    </strong>
                </div>
                <div class="form-group">
                    <label for="alamat">Shift</label>
                    <select name="id_shift" id="id_shift" class="form-control">
                        <option value="">Pilih Shift</option>
                        <?php
                        foreach ($shift as $sf) { ?>
                        <option value="<?= $sf->id_shift ?>"
                            <?= ($sf->id_shift == $row->id_shift ? 'selected' : null) ?>>
                            <?= ucfirst($sf->nama_shift) ?>
                        </option>
                        <?php }
                        ?>
                    </select>
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['id_shift']) == isset($user['id_shift']) ? validation_show_error('id_shift') : '' ?>
                        </p>
                    </strong>
                </div>


                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?= $row->username ?>" id="username" class="form-control"
                        placeholder="Username">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['username']) == isset($user['username']) ? validation_show_error('username') : '' ?>
                        </p>
                    </strong>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="" id="password" class="form-control"
                        placeholder="Password">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['password']) == isset($user['password']) ? validation_show_error('password') : '' ?>
                        </p>
                    </strong>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="hidden" name="" id="page" value="<?= $form ?>">
                <button type="submit" value="<?= $form ?>" class="btn btn-success">Save</button>
                <a href="<?= site_url('karyawan') ?>" class="btn btn-secondary">Kembali</a>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Excel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Template Excel</h4>
                <div class="row justify-content-center">
                    <a href="<?= base_url('example/example.xlsx') ?>" class="btn btn-success" download="">Download
                        Template</a>
                </div>
                <form id="cetak_karyawan" action="<?= site_url('karyawan/importData') ?>" enctype="multipart/form-data"
                    method="POST">
                    <div class="form-group">
                        <label for="importFile">File Excel</label>
                        <input type="file" name="importFile" value="" id="importFile" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary btn-sm"><i
                                class="fas fa-upload mr-1"></i>Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function get_nip() {
    var page = $('#page').val();
    var nip = $('#nip').val();
    if (page == 'add') {
        $.ajax({
            url: '<?php echo base_url(); ?>karyawan/get_nip',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                $('#nip').val(data); //output the returned html into #some-div
                console.log(data); //view the returned json in the console
            },
            error: function(data) {
                console.log('error');
            }
        });
    } else {
        return false;
    }
};
$(document).ready(function() {
    get_nip();
    setInterval(get_nip, 10000);
});
</script>