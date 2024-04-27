@extends('layouts/layout')

@section('title', 'Course lists')

@section('main')

@if (session('error'))
<div class="alert alert-danger mt-3" role="alert">
    {{ session('error') }}
</div>
@endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>Course lists</h1>
    @if ($courses->count() === 0)
        <div class="alert alert-info">
            There aren't any courses uploaded on the website. You can upload one through
            <a href="{{ route('courses.create') }}">Upload course page</a>
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course name</th>
                    <th>Instructor name</th>
                    <th>Units</th>
                    <th>Add to current semester</th>
                </tr>
                </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->course_number }}</td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->instructor }}</td>
                        <td>{{ $course->units }}</td>
                        <td>
                            <form action="{{ route('schedule.addCourse', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
