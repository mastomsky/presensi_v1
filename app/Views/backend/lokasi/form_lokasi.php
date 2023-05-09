<div class="col-md-12">
    <div class="card card-primary shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= site_url('panel/lokasi') ?>" class="btn btn-secondary"><i
                        class="fa fa-arrow-left mr-1"></i>Kembali</a>
            </div>
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
            <?= form_open('panel/lokasi/process') ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_lokasi">Nama lokasi</label>
                    <input type="hidden" name="id_lokasi" value="<?= $row->id_lokasi ?>">
                    <input type="text" name="nama_lokasi" value="<?= $row->nama_lokasi ?>" id="nama_lokasi"
                        class="form-control" placeholder="Nama lokasi">
                    <strong>
                        <p class="text text-danger">
                            <?= isset($user['nama_lokasi']) == isset($user['nama_lokasi']) ? validation_show_error('nama_lokasi') : '' ?>
                        </p>
                    </strong>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat_lokasi" id="alamat" value="<?= $row->alamat_lokasi ?>"
                        class="form-control" placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label for="lokasi_latlng">Lokasi <span class="text-sm"> ( latitude dan longitude )</span> </label>
                    <input type="text" name="lokasi_latlng" value="<?= $row->lokasi_latlng ?>" id="lokasi_latlng"
                        class="form-control" placeholder="Lokasi">
                </div>
                <div class="form-group">
                    <label for="radius_lokasi">Radius</label>
                    <input type="text" name="radius_lokasi" value="<?= $row->radius_lokasi ?>" id="radius_lokasi"
                        class="form-control" placeholder="radius">
                </div>
                <?php if ($form == 'edit') { ?>
                <div id="map" style="width: 100%; height: 350px;"></div>
                <?php } ?>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" name="<?= $form
                                            ?>" class="btn btn-primary">Submit</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<script>
var map = L.map('map').setView([<?= $row->lokasi_latlng ?>], 19);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);
// radius kantor
var circle = L.circle([<?= $row->lokasi_latlng ?>], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: <?= $row->radius_lokasi ?>, // radius dalam meter
}).addTo(map);
var outletIcon = L.icon({
    iconUrl: '<?= base_url('front') ?>/assets/img/icon/outlet.png',
    iconSize: [38, 95], // size of the icon
    shadowSize: [50, 64], // size of the shadow
    iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});
L.marker([<?= $row->lokasi_latlng ?>], {
    icon: outletIcon
}).addTo(map).bindPopup("<?= $row->nama_lokasi ?>.").openPopup();
</script>