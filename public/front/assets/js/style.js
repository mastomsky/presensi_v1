var pesan = $('#pesan').data('pesan');
var pesanerror = $('#pesanerror').data('pesanerror');
if (pesan) {
  Swal.fire({
    icon: 'success',
    title: 'Success',
    text: pesan
  })
}
if (pesanerror) {
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: pesanerror
  })
}
$(document).on('click', '#btn_hapus', function(e) {
    e.preventDefault();
    var link = $(this).attr('href');
  
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Anda ingin menghapus data ini!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#00a65a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = link;
      }
    })
  })
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth'
    });
    calendar.render();
  });