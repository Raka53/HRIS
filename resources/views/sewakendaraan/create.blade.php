@extends('template.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Tambah Data Sewa Kendaraan</h1>
    </div>

    <div class="container mt-4">
        <form action="{{ route('SewaKendaraan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="hrd_id">Nama Karyawan</label>
                <select name="hrd_id" id="hrd_id" class="form-control">
                    <option value="">Pilih Karyawan</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('hrd_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control">
                    <option value="TidakAda">Tidak Ada</option>
                    <option value="Mobil">Mobil</option>
                    <option value="Motor">Motor</option>
                </select>
                @error('jenis_kendaraan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga_sewa">Harga Sewa</label>
                <input type="number" name="harga_sewa" id="harga_sewa" class="form-control" step="0.01" min="0" value="0">
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
