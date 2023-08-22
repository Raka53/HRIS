
@extends('template.main')
@section('content')
<div class="d-flex justify-content-center align-items-center">
  <h1 class="text-center cool-title">Data Kandidat</h1>
</div>
 
        @if(session('refresh'))
            <script>
                setTimeout(function () {
                    location.reload();
                }, 1000); // Setelah 1 detik, halaman akan direfresh
            </script>
        @endif
    

<div class="table-responsive col-lg-12">
  
  <a class="btn btn-primary mb-3 cool-button" href="{{ route('datakandidat.create') }}">Tambah Data</a>

  <table class="table table-bordered data-table" id="myTable">
    <thead>
      <tr>
        <th>no</th>
        <th>Name</th>
        <th>Tanggal CV</th>
        <th>Pendidikan Terakhir</th>
        <th>Gender</th>
        <th>age</th>
        <th>Posisi</th>
      
        <th>No Tlp</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>



<script src="{{ asset('js/jquery2.js') }}"></script>

<script>
 $(document).ready(function() {
  var table = $('#myTable').DataTable({
    serverSide: true,
    processing: true,
    ajax: "{{ route('datakaryawan.datakdt') }}",
    columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
      { data: 'nama', name: 'nama' },
      { data: 'Tanggal_cv', name: 'Tanggal_cv' },
      { data: 'pendidikan', name: 'pendidikan' },
      { data: 'jenis_kelamin', name: 'jenis_kelamin' },
      { data: 'age', name: 'age' },
      { data: 'posisi_kdt.posisi1', name: 'posisi_kdt.posisi1' },

      { data: 'phone', name: 'phone' },
      { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
    ]
  });

  // DELETE
  $('body').on('click', '.tombol-del', function() {
    var id = $(this).data('id');
    Swal.fire({
      title: 'Yakin Mau Hapus?',
      text: "Data ini mencangkup data sewa kendaraan, medical, dan gaji!!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          // url: '{{ route('datakaryawanAjax.destroy', ':id') }}'.replace(':id', id),
          type: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            table.ajax.reload();
            Swal.fire({
              icon: 'success',
              title: 'Data berhasil dihapus!',
              showConfirmButton: false,
              timer: 1500
            });
          },
          error: function(xhr) {
            console.log(xhr.responseText);
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Terjadi kesalahan!',
            });
          }
        });
      }
    });
  });
});

</script>
@endsection
