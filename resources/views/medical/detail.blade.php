@extends('template.main')

@section('content')
    <div class="container">
        <h1>Medical Claim Detail {{ $medical->name }}</h1>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="medicalClaimTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Patient Name</th>
                            <th>Claim Date</th>
                            <th>Date</th>
                            <th>Doctor Fee</th>
                            <th>Obat</th>
                            <th>Kacamata</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('medical.create_patient', ['id' => $medical->id]) }}" class="btn btn-primary">Add Patient</a>
            <a href="{{ route('medical.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <script src="{{ asset('js/jquery2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#medicalClaimTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('medical.detail.data', $medical->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'patient',
                        name: 'patient'
                    },
                    {
                        data: 'date_claim',
                        name: 'date_claim'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'doctor_fee',
                        name: 'doctor_fee',
                        render: $.fn.dataTable.render.number('.', '.', 2)
                    },
                    {
                        data: 'obat',
                        name: 'obat',
                        render: $.fn.dataTable.render.number('.', '.', 2)
                    },
                    {
                        data: 'kacamata',
                        name: 'kacamata',
                        render: $.fn.dataTable.render.number('.', '.', 2)
                    },
                    {
                        data: 'Total',
                        name: 'total',
                        render: $.fn.dataTable.render.number('.', '.', 2)
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            // Handling the delete button click using SweetAlert
            $('#medicalClaimTable').on('click', '.btn-danger', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('medical.destroy', ':id') }}".replace(':id', id),
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                $('#medicalClaimTable').DataTable().ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Data has been deleted!',
                                    showConfirmButton: false,
                                    timer: 1500 // Duration for the toast
                                });
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
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
