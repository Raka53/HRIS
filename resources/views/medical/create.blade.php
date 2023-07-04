@extends('template.main')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Create Medical Claim</div>
            <div class="card-body">
                <form action="{{ route('medical-claims.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Form fields for Medical Claim -->
                    <div class="form-group">
                        <label for="hrd_id">Karyawan</label>
                        <select name="hrd_id" id="hrd_id" class="form-control">
                            <option value="">Select Karyawan</option>
                            @foreach ($karyawan as $k)
                                <option value="{{ $k->id }}">{{ $k->name }}</option>
                            @endforeach
                        </select>
                        @error('hrd_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Form fields for Medical Claim Details -->
                    <div id="medical-claim-details-container">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date_patient_1">Date Patient</label>
                                <input type="date" name="details[0][date_patient]" id="date_patient_1" class="form-control">
                                @error('details.0.date_patient')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="patient_name_1">Patient Name</label>
                                <input type="text" name="details[0][patient_name]" id="patient_name_1" class="form-control">
                                @error('details.0.patient_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="doctor_fee_1">Doctor Fee</label>
                            <input type="number" name="details[0][doctor_fee]" id="doctor_fee_1" class="form-control">
                            @error('details.0.doctor_fee')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="obat_1">Obat</label>
                            <input type="number" name="details[0][obat]" id="obat_1" class="form-control">
                            @error('details.0.obat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kacamata_1">Kacamata</label>
                            <input type="number" name="details[0][kacamata]" id="kacamata_1" class="form-control">
                            @error('details.0.kacamata')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="remarks_1">Remarks</label>
                            <textarea name="details[0][remarks]" id="remarks_1" class="form-control"></textarea>
                            @error('details.0.remarks')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="total_1">Total</label>
                            <input type="number" name="details[0][total]" id="total_1" class="form-control">
                            @error('details.0.total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="foto_1">Foto</label>
                            <input type="file" name="details[0][foto]" id="foto_1" class="form-control">
                            @error('details.0.foto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" id="add-medical-claim-detail">Add More</button>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let index = 1;

            $('#add-medical-claim-detail').click(function() {
                const container = $('#medical-claim-details-container');
                const template = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date_patient_${index}">Date Patient</label>
                            <input type="date" name="details[${index}][date_patient]" id="date_patient_${index}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="patient_name_${index}">Patient Name</label>
                            <input type="text" name="details[${index}][patient_name]" id="patient_name_${index}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="doctor_fee_${index}">Doctor Fee</label>
                            <input type="number" name="details[${index}][doctor_fee]" id="doctor_fee_${index}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="obat_${index}">Obat</label>
                            <input type="number" name="details[${index}][obat]" id="obat_${index}" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kacamata_${index}">Kacamata</label>
                            <input type="number" name="details[${index}][kacamata]" id="kacamata_${index}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="remarks_${index}">Remarks</label>
                            <textarea name="details[${index}][remarks]" id="remarks_${index}" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="total_${index}">Total</label>
                            <input type="number" name="details[${index}][total]" id="total_${index}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="foto_${index}">Foto</label>
                            <input type="file" name="details[${index}][foto]" id="foto_${index}" class="form-control">
                        </div>
                    </div>
                `;

                container.append(template);
                index++;
            });
        });
    </script>
@endsection



