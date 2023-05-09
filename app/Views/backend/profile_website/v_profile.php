<div class="col-md-12">
    <div class="card card-primary shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Profile Website</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?= form_open('panel/website/profile/process') ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <img src="<?= base_url('uploads/img/') ?>" alt="" width="200px">
                </div>
                <div class="form-group">
                    <input type="file" name="logo" id="logo" class="form-control" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="judul">Judul Page</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul page" value="">
                </div>
                <div class="form-group">
                    <label for="nama_kantor">Nama</label>
                    <input type="text" name="nama" id="nama" value="" class="form-control" placeholder="Nama Kantor">
                </div>
                <div class="form-group">
                    <label for="domain">Domain</label>
                    <input type="text" name="domain" id="domain" value="" class="form-control" placeholder="Domain">
                </div>
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" value="" class="form-control" placeholder="Lokasi">
                </div>
                <div class="form-group">
                    <label for="tentang">Tentang</label>
                    <input type="text" name="tentang" value="" class="form-control" placeholder="tentang">
                </div>
                <hr>
                <h6>Sosial Media</h6>
                <hr>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="" class="form-control" placeholder="email">
                </div>
                <div class="form-group">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" name="whatsapp" value="" class="form-control" placeholder="whatsapp">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" value="" class="form-control" placeholder="facebook">
                </div>
                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" name="youtube" value="" class="form-control" placeholder="youtube">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" value="" class="form-control" placeholder="instagram">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" value="" class="form-control" placeholder="twitter">
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