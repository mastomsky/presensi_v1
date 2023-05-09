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

            <table id="tabel_histori" class="table table-bordered table-striped display nowrap responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
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
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<script>
    function datahistori() {
        let tabel = $('#tabel_histori').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url() ?>Serverside/get_presensi_byId",
                "type": "POST",

            },
            "columnDefs": [{
                "targets": [0, 2],
                "className": 'text-center'
            }, {
                "targets": [0, 1],
                "orderable": false
            }],
            "order": []
        })
    };
    $(document).ready(function() {
        datahistori();
    })
</script>