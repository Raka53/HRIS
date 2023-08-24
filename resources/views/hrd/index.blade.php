@extends('template.main')
@section('content')
<div class="d-flex justify-content-between align-items-center">
  <h1 class="text-center cool-title">Data Karyawan</h1>
  <button id="export-button" class="btn btn-secondary ml-auto">Export to Excel</button>
</div>



<div class="table-responsive col-lg-12">
  
  <a class="btn btn-primary mb-3 cool-button" href="{{ route('datakaryawanAjax.create') }}">Tambah Data</a>
 

  <table class="table table-bordered data-table" id="myTable">
    <thead>
      <tr>
        <th>no</th>
        <th>NIK</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Department</th>
        <th>JobTitle</th>
        <th>Status</th>
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
    ajax: "{{ route('datakaryawan.datakry') }}",
    columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
      { data: 'NIK', name: 'NIK' },
      { data: 'name', name: 'name' },
      { data: 'gender', name: 'gender' },
      { data: 'department', name: 'department' },
      { data: 'jobtitle', name: 'jobtitle' },
      { 
        data: 'statusKry', 
        name: 'statusKry', 
        render: function(data, type, row) {
          if (data === '1') {
            return 'Tetap';
          } else if (data === '2') {
            return 'Probation';
          } else if (data === '3') {
            return 'Resign';
          } else {
            return 'Unknown';
          }
        }
      },
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
          url: '{{ route('datakaryawanAjax.destroy', ':id') }}'.replace(':id', id),
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

$('#export-button').on('click', function () {
        window.location.href = '{{ route("export.kry") }}';
    });

</script>
@endsection
