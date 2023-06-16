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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    @endif
</script>

  <script>
      $(document).ready(function() {
     $('#myTable').DataTable({
       severSide: true,
       processing: true,
       ajax: "{{ url('datakaryawanAjax') }}",
       columns: [
         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
         { data: 'NIK', name: 'NIK' },
         { data: 'name', name: 'name' },
         { data: 'gender', name: 'gender' },
         { data: 'department', name: 'department' },
         { data: 'jobtitle', name: 'jobtitle' },
         { data: 'status', name: 'status' },
         { data: 'aksi', name: 'aksi' }
       ]
     });
   //DELETE
   $('body').on('click','.tombol-del', function(){
    if(confirm('Yakin Mau Hapus')== true){
      var id = $(this).data('id');
      $.ajax({
    url: 'datakaryawanAjax/' + id,
    type: 'DELETE',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        // Handle success response
        $('#myTable').DataTable().ajax.reload();
        Swal.fire({
        icon: 'success',
        title: 'Data berhasil dihapus!',
        showConfirmButton: false,
        timer: 1500
    });
    },
    error: function(xhr) {
        // Handle error response
        console.log(xhr.responseText);
    }
});
      $('#myTable').DataTable().ajax.reload();
    }
   });
   
    
   });
   
  </script>
@endsection