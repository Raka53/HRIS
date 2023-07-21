@extends('template.main')

@section('content')
    <div class="container">
        <h1>Add Patient to Medical Claim {{ $id->name }}</h1>

        <form action="{{ route('medical.store') }}" method="POST">
            @csrf
            <div class="form-group">
              
                <input type="hidden" name="hrd_id" id="hrd_id" class="form-control"  value="{{ $id->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="patient">Patient Name</label>
                <input type="text" name="patient" id="patient" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date">Claim Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
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
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
