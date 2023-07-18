@extends('template.main')

@section('content')
    <div class="container">
        <h1>Medical Claim Detail {{ $medicalClaim->hrd->name }}</h1>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Patient Name</th>
                            <th>Claim Date</th>
                            <th>Doctor Fee</th>
                            <th>Obat</th>
                            <th>Kacamata</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicalClaim->patients as $index => $patient)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $patient->patient }}</td>
                                <td>{{ $patient->date }}</td>
                                <td>{{ $patient->doctor_fee }}</td>
                                <td>{{ $patient->obat }}</td>
                                <td>{{ $patient->kacamata }}</td>
                                <td>{{ $patient->doctor_fee + $patient->obat + $patient->kacamata }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="deletePatient({{ $patient->id }})">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('medical.create_patient', ['id' => $medicalClaim->id]) }}" class="btn btn-primary">Add Patient</a>

        </div>
    </div>

    <!-- Script for handling the delete patient -->
    <script>
        function deletePatient(patientId) {
            // You can implement the delete functionality using AJAX here.
            // For now, let's just show an alert.
            alert('Delete patient with ID: ' + patientId);
        }
    </script>
@endsection
