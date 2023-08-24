@extends('template.main')

@section('content')
    <div class="container">
        <h1>Edit Gaji</h1>
        <form action="{{ route('gajiAjax.update', $gaji->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="nama_karyawan">Nama Karyawan</label>
                <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" value="{{ $gaji->hrd->name }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="status">Status Karyawan</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $gaji->hrd->statusKry }}"
                    readonly>
            </div>
            <div class="form-group">
                <input type="hidden" name="hrd_id" id="hrd_id" class="form-control" value="{{ $gaji->hrd_id }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="sewa">Sewa Kendaraan</label>
                <input type="number" name="sewa" id="sewa" class="form-control"
                    value="{{ $gaji->hrd->sewa->harga_sewa }}" readonly>
            </div>
            <div class="form-group">
                <label for="start_date_medical">Start Date Medical</label>
                <input type="date" name="start_date_medical" id="start_date_medical" class="form-control"
                    value="{{ $gaji->start_date_medical }}" required>
            </div>
            <div class="form-group">
                <label for="end_date_medical">End Date Medical</label>
                <input type="date" name="end_date_medical" id="end_date_medical" class="form-control"
                    value="{{ $gaji->end_date_medical }}" required>
            </div>
            <div class="form-group">
                <button type="button" id="calculateTotalMedicalClaim" class="btn btn-primary">Hitung Medical Claim</button>
            </div>
            <div class="form-group">
                <label for="total_medical_claim">Total Medical Claim</label>
                <input type="number" name="total_medical_claim" id="total_medical_claim" class="form-control"
                    value="{{ $gaji->total_medical_claim }}" readonly>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" name="salary" id="salary" class="form-control" value="{{ $gaji->salary }}">
            </div>
            <div class="form-group">
                <label for="lembur">Lembur</label>
                <input type="number" name="lembur" id="lembur" class="form-control" value="{{ $gaji->lembur }}">
            </div>
            <div class="form-group">
                <label for="transport">Transport</label>
                <input type="number" name="transport" id="transport" class="form-control" value="{{ $gaji->transport }}">
            </div>
            <div class="form-group">
                <label for="meals">Meals</label>
                <input type="number" name="meals" id="meals" class="form-control" value="{{ $gaji->meals }}">
            </div>
            <div class="form-group">

                <input type="number" name="total" id="total" class="form-control" readonly
                    value="{{ $gaji->total }}" hidden>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="text" name="totalCurrent" id="totalCurrent" class="form-control" readonly
                    value="{{ $gaji->total }}">
            </div>


            <!-- ... Other form fields ... -->
            <button type="submit" class="btn btn-primary" id="updateButton">Update Gaji</button>
            <a href="{{ route('gajiAjax.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        // Fetch HRD data as JSON using AJAX
        fetch('/hrdJsonEdit/{{ $gaji->hrd->id }}')
            .then(response => response.json())
            .then(hrdData => {
                const hrdSelect = document.getElementById('nama_karyawan');
                const statusInput = document.getElementById('status');
                const sewaInput = document.getElementById('sewa');
                const startDateMedicalInput = document.getElementById('start_date_medical');
                const endDateMedicalInput = document.getElementById('end_date_medical');
                const totalMedicalClaimInput = document.getElementById('total_medical_claim');

                // Set the selected HRD based on the existing data
                if (hrdData.statusKry === '1') {
                    statusInput.value = 'Tetap';
                } else if (hrdData.statusKry === '2') {
                    statusInput.value = 'Probation';
                } else if (hrdData.statusKry === '3') {
                    statusInput.value = 'Resign';
                } else {
                    statusInput.value = '';
                }

                function formatCurrency(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(value);
                }
                // Function to calculate the total based on the entered values in the form
                function calculateTotal() {
                    const salary = parseFloat(document.getElementById('salary').value);
                    const lembur = parseFloat(document.getElementById('lembur').value);
                    const transport = parseFloat(document.getElementById('transport').value);
                    const meals = parseFloat(document.getElementById('meals').value);
                    const totalMedicalClaim = parseFloat(document.getElementById('total_medical_claim').value);
                    const sewa = parseFloat(document.getElementById('sewa').value); // Include Sewa in the calculation
                    const status = document.getElementById('status').value;

                    let total = salary + lembur + transport + meals + totalMedicalClaim + sewa;
                    let totalCurrent = salary + lembur + transport + meals + totalMedicalClaim + sewa;

                    // Adjust the salary if status_id is 2
                    if (status === 'Probation') {
                        total -= salary * 0.1; // Reduce the total by 10% of the salary
                        totalCurrent -= salary * 0.1; // Reduce the total by 10% of the salary
                    }

                    // Set the value of the total and salary input fields to the calculated values
                    document.getElementById('totalCurrent').value = formatCurrency(total);
                    document.getElementById('total').value = total;
                }

                // Add event listeners to the form fields to recalculate the total when any of them are changed
                const formFields = ['salary', 'lembur', 'transport', 'meals', 'total_medical_claim', 'sewa'];
                formFields.forEach(fieldName => {
                    const inputField = document.getElementById(fieldName);
                    inputField.addEventListener('input', calculateTotal);
                });

                // Calculate the total medical claim on page load
                document.addEventListener('DOMContentLoaded', function() {
                    calculateTotal();
                });

                // Add event listener to calculateButton
                const calculateButton = document.getElementById('calculateTotalMedicalClaim');
                calculateButton.addEventListener('click', function() {
                    // Calculate and set the total medical claim for the selected date range and HRD's name
                    const startDateMedical = startDateMedicalInput.value;
                    const endDateMedical = endDateMedicalInput.value;

                    // Find the medical data for the selected HRD and date range
                    const medicalData = hrdData.medical.filter(item => {
                        const itemDateClaim = new Date(item
                            .date_claim); // Convert date_claim to Date object
                        return itemDateClaim >= new Date(startDateMedical) && itemDateClaim <= new Date(
                            endDateMedical);
                    });

                    // Calculate the total medical claim by summing up the 'Total' property in each data object
                    const totalMedicalClaim = medicalData.reduce((total, item) => total + parseFloat(item
                        .Total), 0);

                    // Set the value of the total_medical_claim input to the calculated total
                    totalMedicalClaimInput.value = totalMedicalClaim;

                    // Recalculate the total based on the entered values in the form
                    calculateTotal();
                });
            })
            .catch(error => {
                console.error('Error fetching HRD data:', error);
            });
    </script>
@endsection
