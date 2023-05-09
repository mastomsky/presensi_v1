<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= base_url('home') ?>" class="headerButton goBack">
            <i class="fas fa-arrow-left fa-2x"></i>
        </a>
    </div>
    <div class="pageTitle"><?= ucfirst($judul) ?></div>
    <div class="right"></div>
</div>
<div class="section full mt-5">
    <div class="section-title"></div>
    <div class="wide-block pt-2 pb-2">
        <div class="col-sm-12 text-center ">
            <i class="far fa-check-circle fa-7x text-success"></i>
        </div>
        <div class="col-sm-12 text-center mt-2">
            <h2>Anda Sudah Absen Hari Ini</h2>
            <h5><?= date('d F Y', strtotime($presensi['tgl_presensi'])) ?></h5>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <table class="table table-bordered table-striped text-center">
                    <tr>

                        <th>Masuk</th>
                        <th>Pulang</th>
                    </tr>
                    <tr>
                        <td><?= date('H:i a', strtotime($presensi['jam_in'])) ?></td>
                        <td><?= date('H:i a', strtotime($presensi['jam_out'])) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-sm-12 text-center mt-2">
            <h1 class="bg-info" style=" border-radius: 10px;">Selamat Beristirahat </h1>
        </div>
    </div>

</div>