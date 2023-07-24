@extends('template.main')

@section('content')

    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Gaji Karyawan</h1>
    </div>

    <div class="table-responsive col-lg-12">
       
            <a class="btn btn-primary mb-3 cool-button" href="{{ route('gajiAjax.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
        

    
       
        <table class="table table-bordered data-table" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Gapok</th>
                    <th>Lembur</th>
                    <th>Transport</th>
                    <th>Medical CLaim</th>
                    <th>Meals</th>
                    <th>Total</th>
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
                ajax: "{{ route('gajiAjax.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'hrd.name', name: 'hrd.name' },
                    { data: 'salary', name: 'salary' },
                    { data: 'lembur', name: 'lembur' },
                    { data: 'transport', name: 'transport' },
                    { data: 'medical_claim', name: 'medical_claim' },
                    { data: 'meals', name: 'meals' },
                    { data: 'total', name: 'total' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ]
            });
        });
    </script>
@endsection
