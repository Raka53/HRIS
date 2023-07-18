@extends('template.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Edit Data Sewa Kendaraan</h1>
    </div>

    <div class="container mt-4">
        <form action="{{ route('SewaKendaraan.update', $sewaKendaraan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="hrd_id" class="form-label">{{ __('Nama') }}</label>
                <input type="text" class="form-control" value="{{ $sewaKendaraan->hrd->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control">
                    <option value="Mobil" {{ $sewaKendaraan->jenis_kendaraan == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="Motor" {{ $sewaKendaraan->jenis_kendaraan == 'Motor' ? 'selected' : '' }}>Motor</option>
                </select>
                @error('jenis_kendaraan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga_sewa">Harga Sewa</label>
                <input type="number" name="harga_sewa" id="harga_sewa" class="form-control" step="0.01" min="0" value="{{ $sewaKendaraan->harga_sewa }}">
                @error('harga_sewa')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
           
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('SewaKendaraan.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
