<div class="col-md-12">
    <div class="card card-primary shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Setting</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?= form_open('Admin/settingKan') ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_kantor">Nama Kantor</label>
                    <input type="email" name="nama_kantor" id="nama_kantor" value="<?=$setting['nama_kantor']?>"
                        class="form-control" placeholder="Nama Kantor">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat"
                        value="<?=$setting['alamat']?>">
                </div>
                <div class="form-group">
                    <label for="lokasi_kantor">Lokasi</label>
                    <input type="text" name="lokasi_kantor" id="lokasi_kantor" value="<?=$setting['lokasi_kantor']?>"
                        class="form-control" placeholder="Lokasi">
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>