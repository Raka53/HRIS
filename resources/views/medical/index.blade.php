@extends('template.main')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Medical Claims</div>
            <div class="card-body">
                <a href="{{ route('medical-claims.create') }}" class="btn btn-primary mb-3">Add Medical Claim</a>

                <table class="table table-striped" id="medical-claims-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Karyawan</th>
                            <th>Date</th>
                            <th>Month</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('scripts')
<script>
    $(document).ready(function() {
        let index = 1;

        $('#add-medical-claim-detail').click(function() {
            const container = $('#medical-claim-details-container');
            const template = `
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date_patient_${index}">Date</label>
                        <input type="date" name="details[${index}][date_patient]" id="date_patient_${index}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="patient_name_${index}">Patient Name</label>
                        <input type="text" name="details[${index}][patient_name]" id="patient_name_${index}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="doctor_fee_${index}">Doctor Fee</label>
                        <input type="number" name="details[${index}][doctor_fee]" id="doctor_fee_${index}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="obat_${index}">Obat</label>
                        <input type="number" name="details[${index}][obat]" id="obat_${index}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="kacamata_${index}">Kacamata</label>
                        <input type="number" name="details[${index}][kacamata]" id="kacamata_${index}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="remarks_${index}">Remarks</label>
                        <textarea name="details[${index}][remarks]" id="remarks_${index}" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="total_${index}">Total</label>
                        <input type="number" name="details[${index}][total]" id="total_${index}" class="form-control">
                    </div>
                </div>
            `;

            container.append(template);
            index++;
        });
    });
</script>
@endsection




