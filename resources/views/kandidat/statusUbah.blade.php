@extends('template.main')

@section('content')

<div class="container">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('statuskandidat.status') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <h1>Edit Status</h1>
    <form action="{{ route('updateKdt.update', $status->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <h1>

                <label for="nama">Kandidat {{ $status->kandidat->nama }}</label>
            </h1>
            
        </div>
        <div class="form-group">
            <input type="hidden" name="kandidat_id" id="kandidat_id" class="form-control" value="{{ $status->kandidat_id }}" readonly>
        </div>
        <div class="mb-3">
            <label for="interview_user" class="form-label">{{ __('Interview User') }}</label>
            <select class="form-control select2" name="interview_user" id="interview_user">
                <option value="Belum" {{ $status->interview_user === 'Belum' ? 'selected' : '' }}>{{ __('Belum') }}</option>
                <option value="Yes" {{ $status->interview_user === 'Yes' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                <option value="No" {{ $status->interview_user === 'No' ? 'selected' : '' }}>{{ __('No') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="interview_MR" class="form-label">{{ __('Interview User') }}</label>
            <select class="form-control select2" name="interview_MR" id="interview_MR">
                <option value="Belum" {{ $status->interview_MR === 'Belum' ? 'selected' : '' }}>{{ __('Belum') }}</option>
                <option value="Yes" {{ $status->interview_MR === 'Yes' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                <option value="No" {{ $status->interview_MR === 'No' ? 'selected' : '' }}>{{ __('No') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="interview_FG" class="form-label">{{ __('Interview User') }}</label>
            <select class="form-control select2" name="interview_FG" id="interview_FG">
                <option value="Belum" {{ $status->interview_FG === 'Belum' ? 'selected' : '' }}>{{ __('Belum') }}</option>
                <option value="Yes" {{ $status->interview_FG === 'Yes' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                <option value="No" {{ $status->interview_FG === 'No' ? 'selected' : '' }}>{{ __('No') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="posisi_usulan" class="form-label">{{ __('posisi_usulan') }}</label>
            <input type="text" class="form-control" name="posisi_usulan" id="posisi_usulan" value="{{ $status->posisi_usulan }}">
        </div>
        <div class="mb-3">
            <label for="status_hasil" class="form-label">{{ __('Interview User') }}</label>
            <select class="form-control select2" name="status_hasil" id="status_hasil">
                <option value="Belum" {{ $status->status_hasil === 'Belum' ? 'selected' : '' }}>{{ __('Belum') }}</option>
                <option value="Yes" {{ $status->status_hasil === 'Yes' ? 'selected' : '' }}>{{ __('Yes') }}</option>
                <option value="No" {{ $status->status_hasil === 'No' ? 'selected' : '' }}>{{ __('No') }}</option>
            </select>
        </div>
       
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>

@endsection
