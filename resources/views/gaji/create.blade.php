@extends('template.main')

@section('content')

<div class="container">
    <h1>Tambah Gaji</h1>
    <form action="{{ route('gajiAjax.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="hrd.nama">Nama Karyawan</label>
            <select name="hrd.nama" id="hrd.nama" class="form-control" required>
                <option value="">-- Pilih Nama Karyawan --</option>
            </select>
        </div>
        <div class="form-group">
             
            <input type="hidden" name="hrd_id" id="hrd_id" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="status">Status Karyawan</label>
            <input type="text" name="status" id="status" class="form-control" readonly>
        </div>
        <div class="form-group">    
            <input type="hidden" name="status_id" id="status_id" class="form-control" readonly>
        </div>
        
        <div class="form-group">
            <label for="start_date_medical">Start Date Medical</label>
            <input type="date" name="start_date_medical" id="start_date_medical" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date_medical">End Date Medical</label>
            <input type="date" name="end_date_medical" id="end_date_medical" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="button" id="calculateTotalMedicalClaim" class="btn btn-primary">Hitung Medical Claim</button>
        </div>
        <div class="form-group">
            <label for="total_medical_claim">Total Medical Claim</label>
            <input type="number" name="total_medical_claim" id="total_medical_claim" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="sewa_id">Sewa Kendaraan</label>
            <input type="number" name="sewa" id="sewa" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" name="salary" id="salary" class="form-control" value="0">
        </div>
        <div class="form-group">
            <label for="lembur">Lembur</label>
            <input type="number" name="lembur" id="lembur" class="form-control" value="0">
        </div>
        <div class="form-group">
            <label for="transport">Transport</label>
            <input type="number" name="transport" id="transport" class="form-control" value="0">
        </div>
        <div class="form-group">
            <label for="meals">Meals</label>
            <input type="number" name="meals" id="meals" class="form-control" value="0">
        </div>
        <div class="form-group">
            <label for="total">total</label>
            <input type="number" name="total" id="total" class="form-control" readonly value="0">
        </div>
       
        <!-- ... Other form fields ... -->
        <button type="submit" class="btn btn-primary">Tambah Gaji</button>
        <a href="{{ route('gajiAjax.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    // Fetch HRD data as JSON using AJAX
    fetch('{{ route('hrdJson') }}')
        .then(response => response.json())
        .then(data => {
            const hrdSelect = document.getElementById('hrd.nama');
            const hrd_idInput = document.getElementById('hrd_id');
            const statusInput = document.getElementById('status');
            const status_idInput = document.getElementById('status_id');
            const sewaInput = document.getElementById('sewa');
            const startDateMedicalInput = document.getElementById('start_date_medical');
            const endDateMedicalInput = document.getElementById('end_date_medical');
            const totalMedicalClaimInput = document.getElementById('total_medical_claim');

            hrdSelect.innerHTML = '<option value="">-- Pilih Nama Karyawan --</option>';

            // Populate the select element with HRD data
            data.forEach(hrd => {
                const option = document.createElement('option');
                option.value = hrd.name; // Use HRD's name as the value
                option.text = hrd.name;
                hrdSelect.appendChild(option);
            });

            // Add event listener to hrdSelect
            hrdSelect.addEventListener('change', function () {
                // Get the selected option's value (HRD's name)
                const selectedHrdName = this.value;

                // Find the HRD object with the matching name from the data array
                const selectedHrd = data.find(hrd => hrd.name === selectedHrdName);
                hrd_idInput.value = selectedHrd ? selectedHrd.id : '';
                // Set the value of the status input to the status of the selected HRD
                
                statusInput.value = selectedHrd ? selectedHrd.status_kry.status : '';

                status_idInput.value = selectedHrd ? selectedHrd.status_kry.id : '';

                const sewaValue = selectedHrd && selectedHrd.sewa ? parseFloat(selectedHrd.sewa.harga_sewa) : 0;
                sewaInput.value = isNaN(sewaValue) ? 0 : sewaValue;

                // Set the value of the total_medical_claim input to 0 (default)
                totalMedicalClaimInput.value = '0';

                // Calculate and set the total medical claim for the selected date range and HRD's name
                const startDateMedical = startDateMedicalInput.value;
                const endDateMedical = endDateMedicalInput.value;

         
        // Find the medical data for the selected HRD and date range
        const medicalData = selectedHrd.medical.filter(item => {
            const itemDateClaim = new Date(item.date_claim); // Convert date_claim to Date object
            return itemDateClaim >= new Date(startDateMedical) && itemDateClaim <= new Date(endDateMedical);
        });


       

        // Calculate the total medical claim by summing up the 'Total' property in each data object
        const totalMedicalClaim = medicalData.reduce((total, item) => total + parseFloat(item.Total), 0);

        // Set the value of the total_medical_claim input to the calculated total
        totalMedicalClaimInput.value = totalMedicalClaim.toFixed(2);



        const calculateButton = document.getElementById('calculateTotalMedicalClaim');



            calculateButton.addEventListener('click', function () {
                // Get the selected HRD name and date range
                const selectedHrdName = hrdSelect.value;
                const startDateMedical = startDateMedicalInput.value;
                const endDateMedical = endDateMedicalInput.value;
                
                    
                // Find the HRD object with the matching name from the data array
                const selectedHrd = data.find(hrd => hrd.name === selectedHrdName);

                // Find the medical data for the selected HRD and date range
                const medicalData = selectedHrd.medical.filter(item => {
                    const itemDateClaim = new Date(item.date_claim); // Convert date_claim to Date object
                    return itemDateClaim >= new Date(startDateMedical) && itemDateClaim <= new Date(endDateMedical);
                });

                // Calculate the total medical claim by summing up the 'Total' property in each data object
                const totalMedicalClaim = medicalData.reduce((total, item) => total + parseFloat(item.Total), 0);

                // Set the value of the total_medical_claim input to the calculated total
                totalMedicalClaimInput.value = totalMedicalClaim.toFixed(2);
                // Check if the status is 2 and adjust the salary and total

            
            
            });

                
            function calculateTotal() {
                const salary = parseFloat(document.getElementById('salary').value);
                const lembur = parseFloat(document.getElementById('lembur').value);
                const transport = parseFloat(document.getElementById('transport').value);
                const meals = parseFloat(document.getElementById('meals').value);
                const totalMedicalClaim = parseFloat(document.getElementById('total_medical_claim').value);
                const sewa = parseFloat(document.getElementById('sewa').value); // Include Sewa in the calculation
                const status_id = document.getElementById('status_id').value;

                let total = salary + lembur + transport + meals + totalMedicalClaim + sewa;

                    // Adjust the salary if status_id is 2
                    if (status_id === '2') {
                        total -= salary * 0.1; // Reduce the total by 10% of the salary
                    }

               
               

              

            

                // Set the value of the total and salary input fields to the calculated values
                document.getElementById('total').value = total.toFixed(2);
                
            }
               
            
            
            

                

                // Add event listener to hrdSelect
                hrdSelect.addEventListener('change', function () {
                    const selectedHrdName = this.value;

                                        // Find the HRD object with the matching name from the data array
                                        const selectedHrd = data.find(hrd => hrd.name === selectedHrdName);

                                        // Set the value of the status input to the status of the selected HRD
                                        statusInput.value = selectedHrd ? selectedHrd.status_kry.status : '';

                                        status_idInput.value = selectedHrd ? selectedHrd.status_kry.id : '';

                                        // Set the value of the sewa input to the initial sewa value if sewa is available, otherwise set to 0
                                        const sewaValue = selectedHrd && selectedHrd.sewa ? parseFloat(selectedHrd.sewa.harga_sewa) : 0;
                                        document.getElementById('sewa').value = isNaN(sewaValue) ? initialSewaValue : sewaValue;


                                        // Calculate the total based on the entered values in the form
                                        calculateTotal();
                });


                // Add event listeners to the form fields to recalculate the total when any of them are changed
                const formFields = ['salary', 'lembur', 'transport', 'meals', 'total_medical_claim', 'sewa'];
                formFields.forEach(fieldName => {
                    const inputField = document.getElementById(fieldName);
                    inputField.addEventListener('input', calculateTotal);
                });
            });
        })




        .catch(error => {
            console.error('Error fetching HRD data:', error);
        });


        
</script>

@endsection
