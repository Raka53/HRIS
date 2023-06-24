@extends('template.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Data Gaji') }}
                    <a href="{{ route('gajiAjax.index') }}" class="btn btn-secondary float-right">{{ __('Kembali') }}</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gajiAjax.update', $gaji->id) }}">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Tampilkan SweetAlert di sini -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="hrd_id" class="form-label">{{ __('Nama') }}</label>
                            <input type="text" class="form-control" value="{{ $gaji->hrd->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="salary" class="form-label">{{ __('Salary') }}</label>
                            <input type="number" class="form-control" name="salary" id="salary" value="{{ $gaji->salary }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="lembur" class="form-label">{{ __('Lembur') }}</label>
                            <input type="number" class="form-control" name="lembur" id="lembur" value="{{ $gaji->lembur }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="transport" class="form-label">{{ __('Transport') }}</label>
                            <input type="number" class="form-control" name="transport" id="transport" value="{{ $gaji->transport }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="meals" class="form-label">{{ __('Meals') }}</label>
                            <input type="number" class="form-control" name="meals" id="meals" value="{{ $gaji->meals }}" required>
                        </div>

                        <!-- Tambahkan field lain yang diperlukan untuk update data gaji -->

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('Update Data') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
