<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= site_url('home') ?>" class="headerButton goBack">
            <i class="fas fa-arrow-left fa-2x"></i>
        </a>
    </div>
    <div class="right">
        <a href="<?= site_url('karyawan/profile/edit') ?>" class="btn btn-primary ">
            <i class="fas fa-cog fa-2x"></i>
        </a>
    </div>
    <div class="pageTitle"><?= ucfirst($judul) ?></div>
    <div class="right"></div>
</div>
<div class="section full mt-5">
    <div class="section-title">

    </div>
    <div class="wide-block pt-2 pb-2">
        <div class="col-sm-12 text-center ">

            <div class="id-card-tag"></div>
            <div class="id-card-tag-strip"></div>
            <div class="id-card-hook"></div>
            <div class="id-card-holder">
                <div class="id-card">
                    <div class="header">
                        <img src="<?= base_url('uploads/karyawan/' . $karyawan['foto_karyawan']) ?>">
                    </div>
                    <div class="photo">
                        <img src="<?= base_url('uploads/karyawan/qrcode/' . $karyawan['nip']) ?>.png">
                    </div>
                    <h2><?= strtoupper($karyawan['nama_karyawan']) ?></h2>
                    <div class="qr-code">

                    </div>
                    <h3><?= ucfirst($karyawan['nama_jabatan']) ?></h3>
                    <h3>Join <?= tgl_indo($karyawan['created_at']) ?></h3>
                    <hr>
                    <p><strong>PT. Senantiasa Sabar Selalu</strong>
                        <p>
                            <p>Manyar, Gresik <strong>61151</strong></p>
                            <p>Phone: 01494-660600, 7073222393</p>

                </div>
            </div>
        </div>
    </div>

</div>