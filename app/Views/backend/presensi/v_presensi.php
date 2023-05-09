<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Presensi Hari Ini</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel_presensi_harian" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Foto Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Foto Keluar</th>
                        <th>Jam Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Foto Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Foto Keluar</th>
                        <th>Jam Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title">Riwayat Absensi</h3>
            <div class="card-tools">
                <button type="button" data-toggle="modal" data-target="#modal-cetak-all" class="btn btn-sm btn-info"><i
                        class="fas fa-print mr-1"></i>Cetak Semua</button>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel_presensi" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Foto Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Foto Keluar</th>
                        <th>Jam Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Foto Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Foto Keluar</th>
                        <th>Jam Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="modal fade" id="modal-cetak">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cetak Berdasarkan Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cetak_karyawan" action="<?= site_url('panel/laporan/cetak_data') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tgl_mulai">Tanggal Mulai</label>
                        <input type="hidden" name="id_karyawan" id="id_karyawan">
                        <input type="date" name="tgl_mulai" value="" id="tgl_mulai" class="form-control"
                            placeholder="Nama jabatan">

                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" value="" id="tgl_selesai" class="form-control"
                            placeholder="Nama jabatan">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary" name="get_print" id="get_print"><i
                            class="fas fa-print mr-1"></i>PRINT</button>
                    <button type="submit" class="btn btn-success" name="get_excel" id="get_excel"><i
                            class="fas fa-print mr-1"></i>EXCEL</button>
                    <!-- <button type="submit" class="btn btn-danger" name="get_pdf" id="get_pdf"><i
                            class="fas fa-print mr-1"></i>PDF</button>
                    <button type="submit" class="btn btn-secondary" name=" get_csv" id="get_csv"><i
                            class="fas fa-print mr-1"></i>CSV</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-cetak-all">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cetak Absensi Periode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cetak_karyawan" action="<?= site_url('panel/laporan/cetak') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tgl_mulai">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" value="" id="tgl_mulai" class="form-control"
                            placeholder="Nama jabatan">

                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" value="" id="tgl_selesai" class="form-control"
                            placeholder="Nama jabatan">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary" name="get_print" id="get_print"><i
                            class="fas fa-print mr-1"></i>PRINT</button>
                    <button type="submit" class="btn btn-success" name="get_excel" id="get_excel"><i
                            class="fas fa-print mr-1"></i>EXCEL</button>
                    <!-- <button type="submit" class="btn btn-danger" name="get_pdf" id="get_pdf"><i
                            class="fas fa-print mr-1"></i>PDF</button>
                    <button type="submit" class="btn btn-secondary" name="get_csv" id="get_csv"><i
                            class="fas fa-print mr-1"></i>CSV</button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function selectNama(id) {
    var selec = $('#select_karyawan').select2(id);

};

function datapresensi() {
    let tabel = $('#tabel_presensi').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,

        "order": [],
        "ajax": {
            "url": base_url + "Serverside/get_presensi",
            "type": "POST",

        },
        "columnDefs": [{
            "targets": [0],
            "className": 'text-center'
        }, {
            "targets": [1],
            "orderable": false
        }],
        "order": [],
    })
};

function datapresensiharian() {
    let tabel = $('#tabel_presensi_harian').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            "url": base_url + "Serverside/get_presensi_harian",
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
    datapresensi();
    datapresensiharian();
})
$(document).on('click', '#cetak_id', function() {
    var id = $(this).data('id');
    $('#id_karyawan').val(id);
    $('#modal-cetak').modal('show');
});
$(document).on('click', 'button', ['#get_cetak, #get_excel'], function() {
    $('#modal-cetak').modal('hide');
});
</script>