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
                    <th>Meals</th>
                    <th>Total</th>
                    <th class="text-center">Aksi</th>
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
                ajax: "{{ route('gajiAjax.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'hrd.name', name: 'hrd.name' },
                    { data: 'salary', name: 'salary' },
                    { data: 'lembur', name: 'lembur' },
                    { data: 'transport', name: 'transport' },
                    { data: 'meals', name: 'meals' },
                    { data: 'total', name: 'total' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ]
            });
        });
    </script>
@endsection
