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
        <style>
            .my_camera,
            .my_camera video {
                display: inline-block;
                width: 100% !important;
                height: auto !important;
                margin: auto;
                border-radius: 15px;
            }
        </style>
        <div class="my_camera">

        </div>
        <button id="Take" class="btn btn-danger btn-block btn-flat"><i class="fas fa-camera-retro mr-1"></i>
            Absen Pulang</button>
        <input type="hidden" name="lokasi" id="lokasi">
        <div class="map" id="map" style="width: 100%; height: 400px;"></div>
        <audio id="presensi_out">
            <source src="<?= base_url('front') ?>/assets/sound/presensi_out.mp3" type="audio/mpeg">
        </audio>
    </div>

</div>
<script>
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90,
    });
    Webcam.attach('.my_camera');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {
        var x = document.getElementById("lokasi");

        x.value = position.coords.latitude + "," + position.coords.longitude;
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 19);
        var userLocation = L.latLng(position.coords.latitude, position.coords.longitude);

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
            radius: <?= $karyawan['radius_lokasi'] ?>
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

<script>
    var notfikasi_out = document.getElementById('presensi_out');
    $('#Take').click(function(e) {
        Webcam.snap(function(data_uri) {
            image = data_uri;
        });
        notfikasi_out.play();
        var lokasi = $('#lokasi').val();
        if (lokasi != "") {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Presensi/insertPresensiOut') ?>",
                data: {
                    image: image,
                    lokasi: lokasi
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil !!',
                        text: 'Terima Kasih, Hati-Hati Di Jalan!',
                        showConfirmButton: false,
                        footer: '<a class="btn btn-success btn-flat" href="<?= site_url('Home') ?>">OK</a>'
                    })
                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oppss... !!',
                text: 'Silahkan Akftikan Lokasi Anda!!',
                showConfirmButton: true,
            })
        }

    })
</script>