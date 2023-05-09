

(function ($) {
    'use strict'

var base_url = 'http://localhost:8080/'
function dataCuti(){
 var tabel = $('#tbl_cuti').DataTable({
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "order": [],
      "ajax": {
          "url": base_url + "Serverside/get_berkas_byid",
          "type": "POST",

      },
      "columnDefs": [{
        "targets": [3, 2],
        "className": 'text-center'
    }, {
        "targets": [0, 2],
        "orderable": false
    }],
    "order": []
  })    
};
  $('#get_cuti').DataTable({
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "order": [],
      "ajax": {
          "url": base_url + "Serverside/get_cuti",
          "type": "POST",

      },
      "columnDefs": [{
        "targets": [3, 2],
        "className": 'text-center'
    }, {
        "targets": [0, 2],
        "orderable": false
    }],
    "order": []
  });
    $('#tbl_presensi').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
             "url": base_url + "Serverside/get_presensi",
             "type": "POST",
   
         },
         "columnDefs": [{
             "targets": [2, 2],
             "className": 'text-center'
         }, {
             "targets": [0, 2, 2],
             "orderable": false
         }],
         "order": []
     });
    $('#tbl_presensi_harian').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
             "url": base_url + "Serverside/get_presensi_harian",
             "type": "POST",
   
         },
         "columnDefs": [{
             "targets": [2, 2],
             "className": 'text-center'
         }, {
             "targets": [0, 2, 2],
             "orderable": false
         }],
         "order": []
     });
    $('#tabel_histori').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
             "url": base_url + "Serverside/get_presensi_byId",
             "type": "POST",
   
         },
         "columnDefs": [{
             "targets": [2, 2],
             "className": 'text-center'
         }, {
             "targets": [0, 2, 2],
             "orderable": false
         }],
         "order": []
     });
     $('#tabel_data_foto').DataTable({
        "processing": true, 
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            "url": base_url + "Serverside/get_foto_album",
            "type": "POST",

        },
        "columnDefs": [{
            "targets": [0, 2],
            "className": 'text-center'
        }, {
            "targets": [0, 1, 4, 5],
            "orderable": false
        }],
        "order": []
    });
    $('#tabel_jabatan').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            "url": base_url + "Serverside/get_jabatan",
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
    });
    $('#tabel_shift').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            "url": base_url + "Serverside/get_shift",
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
    });
    $('#tabel_lokasi').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            "url": base_url + "Serverside/get_lokasi",
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
    });
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
           "targets": [0,2 ],
           "className": 'text-center'
       }, {
           "targets": [0, 1, 4,5],
           "orderable": false
       }],
         "order": []
     })
    };
    $('#tabel_user').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "order": [],
         "ajax": {
             "url": base_url + "Serverside/get_user",
             "type": "POST",
   
         },
         "columnDefs": [{
           "targets": [0,2 ],
           "className": 'text-center'
       }, {
           "targets": [0, 1],
           "orderable": false
       }],
         "order": []
     });
    
     // END DataTable AJAX
   
    
        $(document).on('click', '#btn_hapus', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        
        Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Anda ingin menghapus data ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#bcbcbc',
          confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = link;
          }
        })
        });
        $(document).on('click', '#btn_konfirmasi_data', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        
        Swal.fire({
          title: 'Apakah anda yakin?',
          text: "Jika ya anda tidak bisa mengubah data anda!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#00a65a',
          cancelButtonColor: '#bcbcbc',
          confirmButtonText: 'Ya, Konfirmasi!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = link;
          }
        })
        });

})(jQuery)