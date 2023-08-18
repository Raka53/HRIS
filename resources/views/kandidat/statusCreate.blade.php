@extends('template.main')

@section('content')

<div class="container">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('statuskandidat.status') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <h1>Tambah Status</h1>
    <form action="{{ route('tambahStatus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Kandidat </label>
            <select name="nama" id="nama" class="form-control" required>
                <option value="">-- Pilih Nama Kandidat --</option>
            </select>
        </div>
        <div class="form-group">
             
            <input type="hidden" name="kandidat_id" id="kandidat_id" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label for="interview_user" class="form-label">{{ __('Interview User') }}</label>
            <select class="form-control select2" name="interview_user" id="interview_user" value="{{ old('penampilan') }}">
                <option value="Belum">{{ __('Belum') }}</option>
                <option value="Yes">{{ __('Yes') }}</option>
                <option value="No">{{ __('No') }}</option>
            </select>
        </div>
       
        <div class="mb-3">
            <label for="interview_MR" class="form-label">{{ __('Interview MR') }}</label>
            <select class="form-control select2" name="interview_MR" id="interview_MR" value="{{ old('penampilan') }}">
                <option value="Belum">{{ __('Belum') }}</option>
                <option value="Yes">{{ __('Yes') }}</option>
                <option value="No">{{ __('No') }}</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="interview_FG" class="form-label">{{ __('Interview FG') }}</label>
            <select class="form-control select2" name="interview_FG" id="interview_FG" value="{{ old('penampilan') }}">
                <option value="Belum">{{ __('Belum') }}</option>
                <option value="Yes">{{ __('Yes') }}</option>
                <option value="No">{{ __('No') }}</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="posisi_usulan" class="form-label">{{ __('Posisi Usulan') }}</label>
            <input type="text" class="form-control" name="posisi_usulan" id="posisi_usulan" value="{{ old('posisi_usulan') }}">
        </div>

        <div class="mb-3">
            <label for="status_hasil" class="form-label">{{ __('Status Hasil') }}</label>
            <select class="form-control select2" name="status_hasil" id="status_hasil" value="{{ old('penampilan') }}">
                <option value="Belum">{{ __('Belum') }}</option>
                <option value="Drop">{{ __('Drop') }}</option>
                <option value="Terima">{{ __('Terima') }}</option>
            </select>
        </div>

        <!-- ... Other form fields ... -->
        <button type="submit" class="btn btn-primary">Tambah Status</button>
        
    </form>
</div>
<script>
    const kandidatSelect = document.getElementById('nama');
    const kandidat_idInput = document.getElementById('kandidat_id');
    let data = [];

    fetch('{{ route('datakaryawan.dataStatus') }}')
        .then(response => response.json())
        .then(responseData => {
            data = responseData;
            kandidatSelect.innerHTML = '<option value="">-- Pilih Nama Kandidat --</option>';

            // Populate the select element with HRD data
            data.forEach(kandidat => {
                const option = document.createElement('option');
                option.value = kandidat.nama; // Use kandidat's name as the value
                option.text = kandidat.nama;
                kandidatSelect.appendChild(option);
            });
        });

    kandidatSelect.addEventListener('change', function () {
        // Get the selected option's value (kandidat's name)
        const selectedkandidatName = this.value;

        // Find the kandidat object with the matching name from the data array
        const selectedkandidat = data.find(kandidat => kandidat.nama === selectedkandidatName);
        kandidat_idInput.value = selectedkandidat ? selectedkandidat.id : '';
    });
</script>
@endsection
