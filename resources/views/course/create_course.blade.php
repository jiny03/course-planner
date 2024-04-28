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
            <input type="text" name="title" id="title" class="form-control @if($errors->has('title')) is-invalid @endif" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="course_number" class="form-label">Course Number</label>
            <input type="text" name="course_number" id="course_number" class="form-control @if($errors->has('course_number')) is-invalid @endif" value="{{ old('course_number') }}">
            @if ($errors->has('course_number'))
                <div class="invalid-feedback">
                    {{ $errors->first('course_number') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="units" class="form-label">Units</label>
            <input type="number" name="units" id="units"  class="form-control @if($errors->has('units')) is-invalid @endif" value="{{ old('units') }}">
            @if ($errors->has('units'))
                <div class="invalid-feedback">
                    {{ $errors->first('units') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="instructor" class="form-label">Instructor Name</label>
            <input type="text" name="instructor" id="instructor" class="form-control @if($errors->has('units')) is-invalid @endif" value="{{ old('instructor') }}">
            @if ($errors->has('instructor'))
                <div class="invalid-feedback">
                    {{ $errors->first('instructor') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Add Course</button>
    </form>
@endsection
