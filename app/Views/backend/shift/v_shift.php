<div class="col-md-12">
    <div class="card  shadow-lg">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn  btn-primary" href="<?= site_url('shift/add') ?>">Add</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel_shift" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jam Masuk</th>
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
                        <th>Jam Masuk</th>
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
<script>
    function datashift() {
        let tabel = $('#tabel_shift').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": base_url + "Serverside/get_shift",
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
        datashift();
    })
</script>