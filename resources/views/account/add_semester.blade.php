@extends('layouts/layout')

@section('title', 'Add Semester')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        <h1>Add New Semester</h1>
        <form action="{{ route('schedule.storeSemester') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <select name="year" id="year" class="form-select">
                    <option value="">-- Select Year --</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="term" class="form-label">Term</label>
                <select name="term" id="term" class="form-select">
                    <option value="">-- Select Term --</option>
                    <option value="1">Fall</option>
                    <option value="2">Spring</option>
                    <option value="3">Summer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Semester</button>
        </form>
    </div>
@endsection
