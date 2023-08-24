@extends('template.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Gaji Karyawan</h1>
        <button id="export-button" class="btn btn-secondary ml-auto">Export to Excel</button>
    </div>



    <div class="table-responsive col-lg-12">

        <a class="btn btn-primary mb-3 cool-button" href="{{ route('gajiAjax.create') }}" class="btn btn-primary btn-sm">Tambah
            Data</a>




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
                    <th>Tanggal Update</th>

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
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'hrd.name',
                        name: 'hrd.name'
                    },
                    {
                        data: 'salary',
                        name: 'salary',
                        render: $.fn.dataTable.render.number('.', '.')
                    },
                    {
                        data: 'lembur',
                        name: 'lembur',
                        render: $.fn.dataTable.render.number('.', '.')
                    },
                    {
                        data: 'transport',
                        name: 'transport',
                        render: $.fn.dataTable.render.number('.', '.')
                    },
                    {
                        data: 'total_medical_claim',
                        name: 'total_medical_claim',
                        render: $.fn.dataTable.render.number('.', '.')
                    },
                    {
                        data: 'meals',
                        name: 'meals',
                        render: $.fn.dataTable.render.number('.', '.')
                    },
                    {
                        data: 'total',
                        name: 'total',
                        render: $.fn.dataTable.render.number('.', '.')
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data) {
                            return new Date(data).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
            });


        });
        $('#export-button').on('click', function() {
            window.location.href = '{{ route('export.gaji') }}';
        });
    </script>
@endsection
