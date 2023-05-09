<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= site_url('lokasi/add') ?>">Add</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel_lokasi" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama lokasi</th>
                        <th>Alamat</th>
                        <th>Lokasi</th>
                        <th>Radius</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama lokasi</th>
                        <th>Alamat</th>
                        <th>Lokasi</th>
                        <th>Radius</th>
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
    function datalokasi() {
        let tabel = $('#tabel_lokasi').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": base_url + "Serverside/get_lokasi",
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
        datalokasi();
    })
</script>