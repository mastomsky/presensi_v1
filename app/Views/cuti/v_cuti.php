<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= base_url('home') ?>" class="headerButton goBack">
            <i class="fas fa-arrow-left fa-2x"></i>
        </a>
    </div>
    <div class="pageTitle"><?= ucfirst($judul) ?></div>
    <div class="right"></div>
</div>
<div class="section full mt-5">
    <div class="section-title"></div>
    <div class="wide-block pt-2 pb-2">

        <div class="col-sm-12">

            <a href="<?= site_url('karyawan/cuti/add') ?>" class="btn btn-outline-primary">Tambah</a>
            <table id="tbl_cuti" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Di Buat</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Di Buat</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<script>
    function dataCuti() {
        var tabel = $('#tbl_cuti').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url() ?>Serverside/get_berkas_byid",
                "type": "POST",

            },
            "columnDefs": [{
                "targets": [1],
                "className": 'text-center'
            }, {
                "targets": [1],
                "orderable": false
            }],
            "order": []
        })
    };
    $(document).ready(function() {
        dataCuti();
    })
</script>