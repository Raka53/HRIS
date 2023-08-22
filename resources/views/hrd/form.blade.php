@extends('template.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Data Karyawan') }} <a href="{{ route('datakaryawanAjax.index') }}" class="btn btn-secondary float-right">{{ __('Kembali') }}</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('datakaryawanAjax.store') }}" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="photo" class="form-label">{{ __('foto') }}</label>
                                <input type="file" class="form-control" name="foto" id="foto">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="NIK" class="form-label">{{ __('NIK') }}</label>
                            <input type="text" class="form-control" name="NIK" id="NIK" value="{{ old('NIK') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">{{ __('Gender') }}</label>
                            <select class="form-control select2" name="gender" id="gender" value="{{ old('gender') }}">
                                <option value="Female">{{ __('Female') }}</option>
                                <option value="Male">{{ __('Male') }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="joindate" class="form-label">{{ __('Join Date') }}</label>
                            <input type="date" class="form-control" name="joindate" id="joindate" value="{{ old('joindate') }}">
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">{{ __('Location') }}</label>
                            <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}">
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">{{ __('Department') }}</label>
                            <select class="form-control select2" name="department" id="department" value="{{ old('department') }}">
                                <option value="IT">{{ __('IT') }}</option>
                                <option value="Finance">{{ __('Finance') }}</option>
                                <option value="Marketing">{{ __('Marketing') }}</option>
                                <option value="Sales">{{ __('Sales') }}</option>
                                <option value="Technik">{{ __('Technik') }}</option>
                                <option value="Office">{{ __('Office') }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="joblevel" class="form-label">{{ __('Job Level') }}</label>
                            <input type="text" class="form-control" name="joblevel" id="joblevel" value="{{ old('joblevel') }}">
                        </div>

                        <div class="mb-3">
                            <label for="jobtitle" class="form-label">{{ __('Job Title') }}</label>
                            <select class="form-control select2" name="jobtitle" id="jobtitle" value="{{ old('jobtitle') }}">
                                <option value="manager">{{ __('Manager') }}</option>
                                <option value="staff">{{ __('Staff') }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status_id" class="form-label">{{ __('Status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id" value="{{ old('status') }}">
                                <option value="">Pilih Status</option>
    
                                    <option value="1">Tetap</option>
                                    <option value="2">Probahation</option>
                                    <option value="3">Resign</option>
                               
                            </select>
                            @error('hrd_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
