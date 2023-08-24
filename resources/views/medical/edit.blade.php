@extends('template.main')

@section('content')
    <div class="container">
        <h1>Update Medical</h1>

        <form action="{{ route('medical.update', $medical->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="hidden" name="hrd_id" id="hrd_id" class="form-control" value="{{ $medical->hrd_id }}" readonly>
            </div>
            <div class="form-group">
                <input type="hidden" name="status_id" id="status_id" class="form-control" value="{{ $medical->status_id }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="patient">Patient Name</label>
                <input type="text" name="patient" id="patient" class="form-control" value="{{ $medical->patient }}"
                    required pattern="[A-Za-z\s]+" title="Patient name tidak boelh ada angka">
            </div>
            <div class="form-group">
                <label for="date_claim">Claim Date</label>
                <input type="date" name="date_claim" id="date_claim" class="form-control"
                    value="{{ $medical->date_claim }}" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $medical->date }}"
                    required>
            </div>
            <div class="form-group">
                <label for="doctor_fee">Doctor Fee</label>
                <input type="number" name="doctor_fee" id="doctor_fee" class="form-control"
                    value="{{ $medical->doctor_fee }}" required>
            </div>
            <div class="form-group">
                <label for="obat">Obat</label>
                <input type="number" name="obat" id="obat" class="form-control" value="{{ $medical->obat }}"
                    required>
            </div>
            <div class="form-group">
                <label for="kacamata">Kacamata</label>
                <input type="number" name="kacamata" id="kacamata" class="form-control" value="{{ $medical->kacamata }}"
                    required>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" name="total" id="total" class="form-control" value="{{ $medical->Total }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="foto">Upload Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div class="form-group">
                <label for="current_foto">Current Foto</label>
                @if ($medical->foto)
                    <div>
                        <img src="{{ asset('storage/' . $medical->foto) }}" alt="Current Foto" style="max-width: 300px;">
                    </div>
                @else
                    <p>No photo available</p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Medical Claim</button>
            <a href="{{ route('medical.show', $medical->hrd_id) }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
    <script>
        // Calculate and apply 20% reduction to doctor_fee, obat, and kacamata fields
        const doctorFeeField = document.getElementById('doctor_fee');
        const obatField = document.getElementById('obat');
        const kacamataField = document.getElementById('kacamata');
        const totalField = document.getElementById('total');

        doctorFeeField.addEventListener('input', calculateTotal);
        obatField.addEventListener('input', calculateTotal);
        kacamataField.addEventListener('input', calculateTotal);

        // Calculate and populate the total field on page load
        calculateTotal();

        function calculateTotal() {
            const doctorFee = parseFloat(doctorFeeField.value) || 0;
            const obat = parseFloat(obatField.value) || 0;
            const kacamata = parseFloat(kacamataField.value) || 0;

            // Calculate the total after 20% reduction
            let total = (doctorFee + obat + kacamata) * 0.8;

            // Round the total to two decimal places
            total = total;

            // Update the total field value
            totalField.value = total;
        }
    </script>
@endsection
