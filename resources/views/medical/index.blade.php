@extends('template.main')

@section('content')

    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Medical Claim</h1>
    </div>

    <div class="table-responsive col-lg-12">
       
    
        

    
       
        <table class="table table-bordered data-table" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Department</th>
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
                ajax: "{{ route('datakaryawan.datakry') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'NIK', name: 'NIK' },
                    { data: 'name', name: 'name' },
                    { data: 'gender', name: 'gender' },
                    { data: 'department', name: 'department' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ]
            });
        });
    </script>
@endsection
