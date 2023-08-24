@extends('template.main')
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Data Gaji</h1>
    </div>

    <div class="table-responsive col-lg-12">



        <table class="table table-bordered data-table" id="myTable">
            <thead>
                <tr>
                    <th>no</th>
                    <th>name</th>

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
                ajax: "{{ route('hasil.cari-gaji') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
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
                            url: '{{ route('datakaryawanAjax.destroy', ':id') }}'.replace(
                                ':id', id),
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
