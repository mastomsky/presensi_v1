<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= base_url('home') ?>" class="headerButton goBack">
            <i class="fas fa-arrow-left fa-2x"></i>
        </a>
    </div>
    <div class="pageTitle"><?= ucfirst($judul) ?></div>
    <div class="right"></div>
</div>
<div class="row" style="margin-top: 70px;">
    <div class="col ">

        <div class="preview">
            <video src="" id="preview" width="100%"></video>
        </div>
        <button id="Take" class="btn btn-primary btn-block btn-flat"><i class="fas fa-camera-retro mr-1"></i> Absen
            Masuk</button>
        <input type="text" name="" id="qrcode">
        <input type="hidden" name="lokasi" id="lokasi">
        <input type="hidden" name="id_shift" id="id_shift" value="<?= $karyawan['id_shift'] ?>">
        <div class="map" id="map" style="width: 100%; height: 400px;"></div>
        <audio id="presensi_in">
            <source src="<?= base_url('front') ?>/assets/sound/presensi_in.mp3" type="audio/mpeg">
        </audio>
    </div>

</div>
<script>
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
    scanner.addListener('scan', function(c) {
        document.getElementById('qrcode').value = c;
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {
        var x = document.getElementById("lokasi");

        x.value = position.coords.latitude + "," + position.coords.longitude;
        var userLocation = L.latLng(position.coords.latitude, position.coords.longitude);
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 19);
        // posisi
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        // Radius 
        var circle = L.circle([<?= $karyawan['lokasi_latlng'] ?>], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: <?= $karyawan['radius_lokasi'] ?>,
        }).addTo(map);
        // Kantor
        var outletIcon = L.icon({
            iconUrl: '<?= base_url('front') ?>/assets/img/icon/outlet.png',
            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        L.marker([<?= $karyawan['lokasi_latlng'] ?>], {
            icon: outletIcon
        }).addTo(map).bindPopup("<?= $karyawan['nama_lokasi'] ?>.").openPopup();
        // hitung jarak antara posisi kantor
        var distance = userLocation.distanceTo(circle.getLatLng());
        if (distance > circle.getRadius()) {
            Swal.fire({
                icon: 'error',
                title: 'Peringatan !!',
                text: 'Lokasi Anda Terlalu Jauh Dari Kantor!!',
                showConfirmButton: true,
            });
            document.getElementsByTagName("button")[0].disabled = true;

        }
    }
</script>