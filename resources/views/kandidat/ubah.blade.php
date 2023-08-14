@extends('template.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit Data {{ $data->nama }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('datakandidat.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
    
                            <div class="form-group row">
                                <div class="col-md-4 text-center">
                                    <h5>Foto {{ $data->name }}</h5>
                                    <br>
                                    <div class="rounded overflow-hidden d-inline-block" style="width: 200px; height: 200px;">
                                        <img src="{{ asset('storage/fotos/'.$data->foto) }}" alt="Foto Profil" class="img-thumbnail h-100 w-100">
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
                                        <label for="Tanggal_cv" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal cv') }}</label>
                                        <div class="col-md-8">
                                            <input id="Tanggal_cv" type="text" class="form-control" name="Tanggal_cv" value="{{ $data->Tanggal_cv }}">
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('nama') }}</label>
                                        <div class="col-md-8">
                                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data->nama }}" required autofocus>
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <!-- Tambahkan elemen form untuk field lainnya -->
                                    
                                    <div class="form-group row">
                                        <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">{{ __('jenis_kelamin') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="Male" {{ $data->jenis_kelamin == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $data->jenis_kelamin == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="sumber_lamaran" class="col-md-4 col-form-label text-md-right">{{ __('Sumber Lamaran') }}</label>
                                        <div class="col-md-8">
                                            <input id="sumber_lamaran" type="text" class="form-control" name="sumber_lamaran" value="{{ $data->sumber_lamaran }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                                        <div class="col-md-8">
                                            <input id="location" type="text" class="form-control" name="location" value="{{ $data->location }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="department" id="department">
                                                <option value="IT" {{ $data->department == 'IT' ? 'selected' : '' }}>IT</option>
                                                <option value="Finance" {{ $data->department == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                <option value="Marketing" {{ $data->department == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                                <option value="Sales" {{ $data->department == 'Sales' ? 'selected' : '' }}>Sales</option>
                                                <option value="Technik" {{ $data->department == 'Technik' ? 'selected' : '' }}>Technik</option>
                                                <option value="Office" {{ $data->department == 'Office' ? 'selected' : '' }}>Office</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="joblevel" class="col-md-4 col-form-label text-md-right">{{ __('Job Level') }}</label>
                                        <div class="col-md-8">
                                            <input id="joblevel" type="text" class="form-control" name="joblevel" value="{{ $data->joblevel }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="jobtitle" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="jobtitle" id="jobtitle">
                                                <option value="manager" {{ $data->jobtitle == 'manager' ? 'selected' : '' }}>Manager</option>
                                                <option value="staf" {{ $data->jobtitle == 'staf' ? 'selected' : '' }}>Staff</option>
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
                                    <a href="{{ route('kandidat.index') }}" class="btn btn-secondary">
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
