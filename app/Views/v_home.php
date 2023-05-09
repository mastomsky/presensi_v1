<div class="section bg-primary" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            <img src="<?= base_url('uploads//karyawan/' . $karyawan['foto_karyawan']) ?>" alt="avatar" class="imaged w64 rounded" />
        </div>
        <div id="user-info">
            <h2 id="user-name"><?= ucfirst($karyawan['nama_karyawan']) ?></h2>
            <span id="user-role"><?= ucfirst($karyawan['nama_jabatan']) ?></span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="<?= site_url('karyawan/profile') ?>" class="green" style="font-size: 40px"><i class="fas fa-user"></i>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="<?= site_url('karyawan/cuti') ?>" class="danger" style="font-size: 40px">
                            <i class="fas fa-calendar-alt"></i>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Cuti</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="<?= site_url('karyawan/histori') ?>" class="warning" style="font-size: 40px">
                            <i class="fas fa-file-alt"></i>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="#" class="orange" style="font-size: 40px">
                            <i class="fas fa-book"></i>
                        </a>
                    </div>
                    <div class="menu-name">Form Izin</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="tab-content2">
            <span class="badge badge-info btn-block"><i class="fas fa-sign-in-alt">
                    <?= strtoupper($karyawan['nama_shift']) ?></i></span>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="presencedetail">
                                <?php if ($presensi == null) { ?>
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span><?php
                                            $t = strtotime($karyawan['start_in']);
                                            echo date('H:i a', $t) ?></span>
                                <?php } ?>
                                <?php if ($presensi != null) { ?>
                                    <h4 class="presencetitle">Absen Masuk</h4>
                                    <span><?php
                                            $t = strtotime($karyawan['jam_in']);
                                            echo date('H:i a', $t) ?></span>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="presencedetail">
                                <?php if ($presensi == null) { ?>
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span><?php
                                            $t = strtotime($karyawan['end_out']);
                                            echo date('H:i a', $t) ?></span>
                                <?php } ?>
                                <?php if ($presensi != null) { ?>
                                    <h4 class="presencetitle">Absen Pulang</h4>
                                    <span><?php
                                            $t = strtotime($karyawan['jam_out']);
                                            echo date('H:i a', $t) ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="rekappresence mt-1">
        <div class="col">
            <canvas id="myChart" style="min-height: 460px; height: 460px; max-height: 460px; max-width: 100%;"></canvas>
        </div>
    </div> -->

    <div class="rekappresence mt-1">

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence primary">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Hadir</h4>
                                <span class="rekappresencedetail"><?= $countpresensi ?> Hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence green">
                                <i class="fas fa-info"></i>
                            </div>
                            <div class="presencedetail">

                                <h4 class="rekappresencetitle">Izin</h4>
                                <span class="rekappresencedetail"><?= $countizin ?> Hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence danger">
                                <i class="fas fa-sad-tear"></i>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Sakit</h4>
                                <span class="rekappresencedetail"><?= $countsakit ?> Hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence warning">
                                <i class="fa fa-clock"></i>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Terlambat</h4>
                                <span class="rekappresencedetail"><?= $countterlambat ?> Hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content mt-2" style="margin-bottom: 100px">
        <a href="<?= site_url('Auth/logoutKaryawan') ?>" class="btn btn-danger btn-sm btn-block"><i class="fas fa-sign-out-alt"> Log out</i></a>
    </div>
</div>