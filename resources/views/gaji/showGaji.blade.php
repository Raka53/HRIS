@extends('template.main')

@section('content')
    <h1>Data Gaji {{ $gaji->name }}</h1>



    <table class="table table-bordered data-table" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Sewa Kendaraan</th>
                <th>Gaji Pokok</th>
                <th>Total Medical</th>
                <th>Lembur</th>
                <th>Transport</th>
                <th>Meals</th>
                <th>Total</th>
                <th>Tanggal Input</th>



                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script src="{{ asset('js/jquery2.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{{ route('gaji.related-data', $gaji->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'harga_sewa',
                        name: 'harga_sewa'
                    },
                    {
                        data: 'salary',
                        name: 'salary'
                    },
                    {
                        data: 'total_medical_claim',
                        name: 'total_medical_claim'
                    },
                    {
                        data: 'lembur',
                        name: 'lembur'
                    },
                    {
                        data: 'transport',
                        name: 'transport'
                    },
                    {
                        data: 'meals',
                        name: 'meals'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
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
    </script>
@endsection
