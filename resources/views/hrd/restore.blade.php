@extends('template.main')

@section('content')

    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Data Karyawan Terhapus</h1>
    </div>

    <div class="table-responsive col-lg-12">
        <table class="table table-bordered data-table" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Bergabung</th>
                    <th>Lokasi</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deletedHrds as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->NIK }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->joindate }}</td>
                        <td>{{ $item->location }}</td>
                        <td>{{ $item->department }}</td>
                        <td>{{ $item->jobtitle }}</td>
                        <td>{{ $item->status_kry->status }}</td>
                        <td class="text-center">
                            <button class="btn btn-success btn-sm btn-restore" data-url="{{ route('hrd.restore', $item->id) }}">Restore</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/jquery2.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#myTable').DataTable({
                // ...
            });

            // Restore Button Click Event
            $('body').on('click', '.btn-restore', function() {
                const restoreUrl = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to restore this data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, restore it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: restoreUrl,
                            type: 'PATCH', // Use PATCH method for restore
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                table.ajax.reload(); // Reload DataTable
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data has been restored!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection
