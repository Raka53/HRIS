@extends('template.main')

@section('content')
    <div class="container">
        <h1>Add Patient to Medical Claim</h1>

        <form action="{{ route('medical.store_patient', $medicalClaim->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" name="patient_name" id="patient_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="doctor_fee">Doctor Fee</label>
                <input type="number" name="doctor_fee" id="doctor_fee" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="obat">Obat</label>
                <input type="number" name="obat" id="obat" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kacamata">Kacamata</label>
                <input type="number" name="kacamata" id="kacamata" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Patient</button>
        </form>
    </div>
   

@endsection
