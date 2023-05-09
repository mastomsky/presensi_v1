<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= site_url('jabatan/add') ?>" class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel_jabatan" class="table table-bordered table-striped text-center" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<script>
function datajabatan() {
    let tabel = $('#tabel_jabatan').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            "url": base_url + "Serverside/get_jabatan",
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
    datajabatan();
})
</script>