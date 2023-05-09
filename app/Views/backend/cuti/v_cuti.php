<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tabel_cuti" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Di Buat</th>
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
                        <th>Di Buat</th>
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
<!-- Modal -->
<div class="modal fade" id="modal-cuti" tabindex="-1" aria-labelledby="modal-cutiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cuti_approve">
                    <div class="form-group">
                        <label for="Nama karyawan">Nama karyawan</label>
                        <input type="hidden" name="id" id="id" class="form-control" readonly>
                        <input type="text" name="nama" id="nama" class="form-control" readonly>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#show_cuti', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');

        $('#id').val(id);
        $('#nama').val(nama);

        //   $('#modal-item').modal('show');
    });

    function datacuti() {
        let tabel = $('#tabel_cuti').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": base_url + "Serverside/get_cuti",
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
        datacuti();
    })
</script>