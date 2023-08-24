@extends('template.main')

@section('content')
    <div class="container">
        <h1>Add Patient to Medical Claim {{ $id->name }}"</h1>

        <form action="{{ route('medical.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" name="hrd_id" id="hrd_id" class="form-control" value="{{ $id->id }}" readonly>
            </div>

            <div class="form-group">
                <label for="date_claim">Claim Date</label>
                <input type="date" name="date_claim" id="date_claim" class="form-control" required
                    value="{{ old('date_claim') }}">
                @error('date_claim')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="patient">Patient Name</label>
                <input type="text" name="patient" id="patient" class="form-control" required pattern="[A-Za-z\s]+"
                    title="Patient name tidak boelh ada angka" value="{{ old('patient') }}">
                @error('patient')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" required
                    value="{{ old('date') }}">
                @error('date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="doctor_fee">Doctor Fee</label>
                <input type="number" name="doctor_fee" id="doctor_fee" class="form-control" required
                    value="{{ old('doctor_fee') }}">
                @error('doctor_fee')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="obat">Obat</label>
                <input type="number" name="obat" id="obat" class="form-control" required
                    value="{{ old('obat') }}">
                @error('obat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="kacamata">Kacamata</label>
                <input type="number" name="kacamata" id="kacamata" class="form-control" required
                    value="{{ old('kacamata') }}">
                @error('kacamata')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Display the total field -->
            <div class="form-group">
                <label for="total">Total</label>
                <input type="text" name="totalCR" id="totalCR" class="form-control" readonly
                    value="{{ old('total') }}">
            </div>
            <div class="form-group">

                <input type="number" name="total" id="total" class="form-control" readonly
                    value="{{ old('total') }}" hidden>
            </div>

            <div class="form-group">
                <label for="foto">Upload Bukti Medical Max 2MB</label>
                <input type="file" name="foto" id="foto" class="form-control-file" required>
                @error('foto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Patient</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </form>
    </div>

    <script>
        // Calculate and apply 20% reduction to doctor_fee, obat, and kacamata fields
        const doctorFeeField = document.getElementById('doctor_fee');
        const obatField = document.getElementById('obat');
        const kacamataField = document.getElementById('kacamata');
        const totalField = document.getElementById('totalCR');
        const totalFix = document.getElementById('total');

        doctorFeeField.addEventListener('input', calculateTotal);
        obatField.addEventListener('input', calculateTotal);
        kacamataField.addEventListener('input', calculateTotal);


        function calculateTotal() {
            const doctorFee = parseFloat(doctorFeeField.value) || 0;
            const obat = parseFloat(obatField.value) || 0;
            const kacamata = parseFloat(kacamataField.value) || 0;

            // Calculate the total after 20% reduction
            let total = (doctorFee + obat + kacamata) * 0.8;

            // Round the total to two decimal places
            total = total;

            // Format the total as currency
            const currencyFormatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            const formattedTotal = currencyFormatter.format(total);

            // Update the total field value
            totalField.value = formattedTotal;
            totalFix.value = total;
        }
    </script>
@endsection
