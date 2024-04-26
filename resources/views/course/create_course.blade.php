@extends('layouts/layout')

@section('title', 'Create Course')

@section('main')
    <h1>Create New Course</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Course Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="course_number" class="form-label">Course Number</label>
            <input type="text" name="course_number" id="course_number" class="form-control" value="{{ old('course_number') }}">
            @error('course_number')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="units" class="form-label">Units</label>
            <input type="number" name="units" id="units" class="form-control" value="{{ old('units') }}">
            @error('units')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="instructor" class="form-label">Instructor Name</label>
            <input type="text" name="instructor" id="instructor" class="form-control" value="{{ old('instructor') }}">
            @error('instructor')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Course</button>
    </form>
@endsection
