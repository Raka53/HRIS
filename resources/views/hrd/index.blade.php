@extends('template.main')
@section('content')
<div class="d-flex justify-content-center align-items-center">
  <h1 class="text-center cool-title">Test table</h1>
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

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
 $(document).ready(function() {
  var table = $('#myTable').DataTable({
    serverSide: true,
    processing: true,
    ajax: "{{ route('datakaryawanAjax.index') }}",
    columns: [
      { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
      { data: 'NIK', name: 'NIK' },
      { data: 'name', name: 'name' },
      { data: 'gender', name: 'gender' },
      { data: 'department', name: 'department' },
      { data: 'jobtitle', name: 'jobtitle' },
      { data: 'status', name: 'status' },
      { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
    ]
  });

  // DELETE
  $('body').on('click', '.tombol-del', function() {
    var id = $(this).data('id');
    Swal.fire({
      title: 'Yakin Mau Hapus?',
      text: "Data yang dihapus tidak dapat dikembalikan!",
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

</script>
@endsection
