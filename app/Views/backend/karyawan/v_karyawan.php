<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">

                <a href="<?= site_url('panel/karyawan/add') ?>" class="btn btn-primary"><i class="fas fa-plus mr-1"></i>Add</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel_karyawan" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Telpon</th>
                        <th>Penempatan</th>
                        <th>Jabatan</th>
                        <th>Shift</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Telpon</th>
                        <th>Penempatan</th>
                        <th>Jabatan</th>
                        <th>Shift</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="modal fade" id="modal-qrcode">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Qr Code</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="qrcode" src="" alt="" width="400px">
            </div>
        </div>
    </div>
</div>

<script>
    function dataKaryawan() {
        let tabel = $('#tabel_karyawan').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": base_url + "Serverside/get_karyawan",
                "type": "POST",

            },
            "columnDefs": [{
                "targets": [0],
                "className": 'text-center'
            }, {
                "targets": [1],
                "orderable": false
            }],
            "order": []
        })
    };
    $(document).ready(function() {
        dataKaryawan();
    })


    $(document).on('click', '#qrCodeNip', function() {
        var qrcode = $(this).data('qrcode');
        document.getElementById('qrcode').src = "<?= base_url() ?>uploads/karyawan/qrcode/" + qrcode + ".png";
        $('#modal-qrcode').modal('show');
    });

    $(document).on('click', '#blokir', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>karyawan/blokir",
            dataType: 'json',
            data: {
                id: id,
            },

            success: function(res) {
                if (res.hasil == 'true') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: nama + " Berhasil Di Blokir",
                        showConfirmButton: true,

                    }, );
                    var oTable = $('#tabel_karyawan').DataTable();
                    oTable.ajax.reload();
                    $(
                        "#blokir").removeAttr("disabled");
                }
                if (res.hasil == 'false') {
                    Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: nama + 'Gagal Di Blokir!!'
                        },
                        function() {

                        });
                }
            }
        });
    });
    $(document).on('click', '#buka_blokir', function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>karyawan/buka_blokir",
            dataType: 'json',
            data: {
                id: id,
            },

            success: function(res) {
                if (res.hasil == 'true') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: nama + " Berhasil Di Buka",
                        showConfirmButton: true,

                    }, );
                    var oTable = $('#tabel_karyawan').DataTable();
                    oTable.ajax.reload();
                    $(
                        "#buka_blokir").removeAttr("disabled");
                }
                if (res.hasil == 'false') {
                    Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: nama + 'Gagal Di Buka!!'
                        },
                        function() {

                        });
                }
            }
        });
    });
    $(document).on('click', '#whatsapp', function(event) {
        event.preventDefault();
        var telpon = $(this).data('telpon');
        window.open("wa.me/" + telpon, '_blank');
    });
</script>