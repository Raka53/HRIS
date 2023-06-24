@extends('template.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center cool-title">Tambah Data Gaji</h1>
    </div>

    <div class="container mt-4">
        <form action="{{ route('gajiAjax.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="hrd_id">Nama Karyawan</label>
                <select name="hrd_id" id="hrd_id" class="form-control">
                    <option value="">Pilih Karyawan</option>
                    @foreach ($karyawan as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('hrd_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="salary">Gaji Pokok</label>
                <input type="number" name="salary" id="salary" class="form-control" step="0.01" min="0">
                @error('salary')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="lembur">Lembur</label>
                <input type="number" name="lembur" id="lembur" class="form-control" step="0.01" min="0">
                @error('lembur')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="transport">Transport</label>
                <input type="number" name="transport" id="transport" class="form-control" step="0.01" min="0">
                @error('transport')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="meals">Meals</label>
                <input type="number" name="meals" id="meals" class="form-control" step="0.01" min="0">
                @error('meals')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('gajiAjax.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
