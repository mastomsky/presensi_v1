<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">

                <a href="<?= site_url('karyawan/add') ?>" class="btn btn-primary"><i
                        class="fas fa-plus mr-1"></i>Add</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <img src="<?= base_url('uploads/karyawan/qrcode/' . $nip) ?>" alt="">
        </div>
        <!-- /.card -->
    </div>
</div>