<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= site_url('user/add') ?>" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel_user" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
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
<script>
    function datauser() {
        let tabel = $('#tabel_user').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": base_url + "Serverside/get_user",
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
        datauser();
    })
</script>