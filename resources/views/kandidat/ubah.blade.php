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
                                    <h5>Dokumen {{ $data->nama }}</h5>
                                    <br>
                                    <div class="form-group row">
                                        <label for="dokumen" class="col-md-4 col-form-label text-md-right"></label>
                                        <div class="col-md-8">
                                            <a href="{{ asset('storage/dokumenkdt/'.$data->posisiKdt->dokumen) }}" target="_blank">
                                                <img src="{{ asset('storage/images/pdf.png') }}" alt="Dokumen" class="img-thumbnail" style="display: block; margin: 0 auto; margin-left: -40px;">
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <label for="dokumen" class="btn btn-primary">{{ __('Upload dokumen') }}</label>
                                    <input id="dokumen" type="file" class="d-none @error('dokumen') is-invalid @enderror" name="dokumen">
                                    @error('dokumen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="Tanggal_cv" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal cv') }}</label>
                                        <div class="col-md-8">
                                            <input id="Tanggal_cv" type="date" class="form-control" name="Tanggal_cv" value="{{ $data->Tanggal_cv }}">
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
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
                                        <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>
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
                                        <label for="pengalaman_terakhir" class="col-md-4 col-form-label text-md-right">{{ __('Pengalaman Terakhir') }}</label>
                                        <div class="col-md-8">
                                            <input id="pengalaman_terakhir" type="text" class="form-control" name="pengalaman_terakhir" value="{{ $data->posisiKdt->pengalaman_terakhir }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tempat_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir') }}</label>
                                        <div class="col-md-8">
                                            <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>
                                        <div class="col-md-8">
                                            <input id="tanggal_lahir" type="date" class="form-control" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>
                                        <div class="col-md-8">
                                            <input id="age" type="number" class="form-control" name="age" value="{{ $data->age }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="status" id="status">
                                                
                                               
                                                <option value="Single" {{ $data->status == 'Single' ? 'selected' : '' }}>Single</option>
                                                <option value="Married" {{ $data->status == 'Married' ? 'selected' : '' }}>Married</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                                        <div class="col-md-8">
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $data->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                        <div class="col-md-8">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $data->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pendidikan" class="col-md-4 col-form-label text-md-right">{{ __('Pendidikan') }}</label>
                                        <div class="col-md-8">
                                            <input id="pendidikan" type="text" class="form-control" name="pendidikan" value="{{ $data->pendidikan }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="universitas" class="col-md-4 col-form-label text-md-right">{{ __('Universitas') }}</label>
                                        <div class="col-md-8">
                                            <input id="universitas" type="text" class="form-control" name="universitas" value="{{ $data->universitas }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ipk" class="col-md-4 col-form-label text-md-right">{{ __('Ipk') }}</label>
                                        <div class="col-md-8">
                                            <input id="ipk" type="text" class="form-control" name="ipk" value="{{ $data->ipk }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="posisi_terakhir" class="col-md-4 col-form-label text-md-right">{{ __('Posisi Terakhir') }}</label>
                                        <div class="col-md-8">
                                            <input id="posisi_terakhir" type="text" class="form-control" name="posisi_terakhir" value="{{ $data->posisiKdt->posisi_terakhir }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="posisi1" class="col-md-4 col-form-label text-md-right">{{ __('Posisi1') }}</label>
                                        <div class="col-md-8">
                                            <input id="posisi1" type="text" class="form-control" name="posisi1" value="{{ $data->posisiKdt->posisi1 }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="posisi2" class="col-md-4 col-form-label text-md-right">{{ __('Posisi2') }}</label>
                                        <div class="col-md-8">
                                            <input id="posisi2" type="text" class="form-control" name="posisi2" value="{{ $data->posisiKdt->posisi2 }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="penampilan" class="col-md-4 col-form-label text-md-right">{{ __('penampilan') }}</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="penampilan" id="penampilan">
                                                
                                               
                                                <option value="OK" {{ $data->posisiKdt->penampilan == 'OK' ? 'selected' : '' }}>OK</option>
                                                <option value="NotOK" {{ $data->posisiKdt->penampilan == 'NotOK' ? 'selected' : '' }}>Not OK</option>
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
