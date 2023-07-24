@extends('template.main')

@section('content')
    <div class="container">
        <h1>Add New Salary Data for Employee {{ $hrd->name }}</h1>

        <form action="{{ route('gajiAjax.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="hrd_id">Employee Name</label>
                <input type="text" name="hrd_id" id="hrd_id" class="form-control" value="{{ $hrd->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="status_id">Status</label>
                <select name="status_id" id="status_id" class="form-control" required>
                    <option value="">Select Status</option>
                    @foreach ($statusList as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" name="salary" id="salary" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lembur">Overtime Pay</label>
                <input type="number" name="lembur" id="lembur" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="start_date_medical">Start Date Medical Claim</label>
                <input type="date" name="start_date_medical" id="start_date_medical" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date_medical">End Date Medical Claim</label>
                <input type="date" name="end_date_medical" id="end_date_medical" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="transport">Transport Allowance</label>
                <input type="number" name="transport" id="transport" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="meals">Meals Allowance</label>
                <input type="number" name="meals" id="meals" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Salary Data</button>
            <a href="{{ route('gajiAjax.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
