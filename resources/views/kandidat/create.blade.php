@extends('template.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Data Kandidat') }} <a href="/kandidat" class="btn btn-secondary float-right">{{ __('Kembali') }}</a>
                </div>
               

                <div class="card-body">
                    <form method="POST" action="{{ route('kandidat.store') }}" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="photo" class="form-label">{{ __('dokumen') }}</label>
                                <input type="file" class="form-control" name="dokumen" id="dokumen">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="sumberlamaran" class="form-label">{{ __('Sumber Lamaran') }}</label>
                            <input type="text" class="form-control" name="sumber_lamaran" id="sumber_lamaran" value="{{ old('sumber_lamaran') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggalcv" class="form-label">{{ __('Tanggal CV') }}</label>
                            <input type="date" class="form-control" name="Tanggal_cv" id="Tanggal_cv" value="{{ old('Tanggal_cv') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">{{ __('Gender') }}</label>
                            <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                                <option value="Female">{{ __('Female') }}</option>
                                <option value="Male">{{ __('Male') }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">{{ __('Tempat Lahir') }}</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">{{ __('Tanggal Lahir') }}</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">{{ __('Age') }}</label>
                            <input type="number" class="form-control" name="age" id="age" value="{{ old('age') }}">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select class="form-control select2" name="status" id="status" value="{{ old('status') }}">
                                <option value=""></option>
                                <option value="Single">{{ __('Single') }}</option>
                                <option value="Married">{{ __('Married') }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('Phone') }}</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">{{ __('Pendidikan Terakhir') }}</label>
                            <input type="text" class="form-control" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}">
                        </div>

                        <div class="mb-3">
                            <label for="universitas" class="form-label">{{ __('Universitas') }}</label>
                            <input type="text" class="form-control" name="universitas" id="universitas" value="{{ old('universitas') }}">
                        </div>
                       

                        <div class="mb-3">
                            <label for="ipk" class="form-label">{{ __('IPK') }}</label>
                            <input type="number" class="form-control" name="ipk" id="ipk" value="{{ old('ipk') }}">
                        </div>

                        <div class="mb-3">
                            <label for="pengalaman_terakhir" class="form-label">{{ __('Pengalaman Terakhir') }}</label>
                            <input type="text" class="form-control" name="pengalaman_terakhir" id="pengalaman_terakhir" value="{{ old('pengalaman_terakhir') }}">
                        </div>

                        <div class="mb-3">
                            <label for="poisis_terakhir" class="form-label">{{ __('Pengalaman Terakhir Posisi') }}</label>
                            <input type="text" class="form-control" name="posisi_terakhir" id="posisi_terakhir" value="{{ old('posisi_terakhir') }}">
                        </div>

                        <div class="mb-3">
                            <label for="posisi1" class="form-label">{{ __('Posisi Pilihan 1') }}</label>
                            <input type="text" class="form-control" name="posisi1" id="posisi1" value="{{ old('posisi1') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="posisi2" class="form-label">{{ __('Posisi Pilihan 2') }}</label>
                            <input type="text" class="form-control" name="posisi2" id="posisi2" value="{{ old('posisi2') }}">
                        </div>

                        <div class="mb-3">
                            <label for="penampilan" class="form-label">{{ __('Penampilan') }}</label>
                            <select class="form-control select2" name="penampilan" id="penampilan" value="{{ old('penampilan') }}">
                                <option value="OK">{{ __('OK') }}</option>
                                <option value="No">{{ __('No') }}</option>
                            </select>
                        </div>
                        
                        
                     

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('Tambah Data') }}</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
@endsection
