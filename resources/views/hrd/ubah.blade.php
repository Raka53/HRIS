@extends('template.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit Data {{ $datakaryawan->name }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('datakaryawanAjax.update', $datakaryawan) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <div class="form-group row">
                                <div class="col-md-4 text-center">
                                    <h5>Foto {{ $datakaryawan->name }}</h5>
                                    <br>
                                    <div class="rounded overflow-hidden d-inline-block" style="width: 200px; height: 200px;">
                                        <img src="{{ asset('storage/fotos/'.$datakaryawan->foto) }}" alt="Foto Profil" class="img-thumbnail h-100 w-100">
                                    </div>
                                    <br>
                                    <br>
                                    <label for="foto" class="btn btn-primary">{{ __('Upload Foto') }}</label>
                                    <input id="foto" type="file" class="d-none @error('foto') is-invalid @enderror" name="foto">
                                    @error('foto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="NIK" class="col-md-4 col-form-label text-md-right">{{ __('NIK') }}</label>
                                        <div class="col-md-8">
                                            <input id="NIK" type="text" class="form-control" name="NIK" value="{{ $datakaryawan->NIK }}" readonly>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $datakaryawan->name }}" required autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <!-- Tambahkan elemen form untuk field lainnya -->
                                    
                                    <div class="form-group row">
                                        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="Male" {{ $datakaryawan->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $datakaryawan->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="joindate" class="col-md-4 col-form-label text-md-right">{{ __('Join Date') }}</label>
                                        <div class="col-md-8">
                                            <input id="joindate" type="date" class="form-control" name="joindate" value="{{ $datakaryawan->joindate }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                                        <div class="col-md-8">
                                            <input id="location" type="text" class="form-control" name="location" value="{{ $datakaryawan->location }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="department" id="department">
                                                <option value="IT" {{ $datakaryawan->department == 'IT' ? 'selected' : '' }}>IT</option>
                                                <option value="Finance" {{ $datakaryawan->department == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                <option value="Marketing" {{ $datakaryawan->department == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                                <option value="Sales" {{ $datakaryawan->department == 'Sales' ? 'selected' : '' }}>Sales</option>
                                                <option value="Technik" {{ $datakaryawan->department == 'Technik' ? 'selected' : '' }}>Technik</option>
                                                <option value="Office" {{ $datakaryawan->department == 'Office' ? 'selected' : '' }}>Office</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="joblevel" class="col-md-4 col-form-label text-md-right">{{ __('Job Level') }}</label>
                                        <div class="col-md-8">
                                            <input id="joblevel" type="text" class="form-control" name="joblevel" value="{{ $datakaryawan->joblevel }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="jobtitle" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="jobtitle" id="jobtitle">
                                                <option value="manager" {{ $datakaryawan->jobtitle == 'manager' ? 'selected' : '' }}>Manager</option>
                                                <option value="staf" {{ $datakaryawan->jobtitle == 'staf' ? 'selected' : '' }}>Staff</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="status" id="status">
                                                <option value="tetap" {{ $datakaryawan->status_kry->status == 'tetap' ? 'selected' : '' }}>Tetap</option>
                                                <option value="Probation" {{ $datakaryawan->status_kry->status == 'Probation' ? 'selected' : '' }}>Probation</option>
                                                <option value="Probation" {{ $datakaryawan->status_kry->status == 'resign' ? 'selected' : '' }}>Resign</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    @role('it')
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Data') }}
                                    </button>
                                    @endrole
                                    <a href="{{ route('datakaryawanAjax.index') }}" class="btn btn-secondary">
                                        {{ __('Kembali') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection
