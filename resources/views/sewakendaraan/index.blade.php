@extends('template.main')

@section('content')

    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Sewa Kendaraan</h1>
    </div>

    <div class="table-responsive col-lg-12">
       
            <a class="btn btn-primary mb-3 cool-button" href="{{ route('SewaKendaraan.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
        

    
       
        <table class="table table-bordered data-table" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kendaraan</th>
                    <th>Harga Sewa</th>
                    <th class="text-center">Aksi</th>
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
                ajax: "{{ route('SewaKendaraan.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'hrd.name', name: 'hrd.name' },
                    { data: 'jenis_kendaraan', name: 'jenis_kendaraan' },
                    { data: 'harga_sewa', name: 'harga_sewa' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ]
            });
        });
    </script>
@endsection
