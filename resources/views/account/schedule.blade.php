@extends('layouts/layout')

@section('title', 'Schedule')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (!$defaultSemester)
        <h1>No semesters added yet.</h1>
        <div class="alert alert-info">
            No semesters added yet.
            You can manage and add new semesters at
            <a href="{{ route('schedule.semesters') }}">Semesters Page</a>
        </div>
    @else
        <h1>Schedule of {{ $defaultSemester->title }} semester</h1>

        <div>
            @if ($courses->count() === 0)
                <div class="alert alert-info">
                    There aren't any courses scheduled for current semester.
                    Browse new coures at <a href="{{ route('courses.index') }}">Course lists</a>
                </div>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course name</th>
                            <th>Instructor name</th>
                            <th>Units</th>
                            <th>Delete</th>
                            <th>View Comments</th>
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
                                <form action="{{ route('schedule.deleteCourse', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('courses.viewComments', $course->id) }}" method="GET">
                                    <button type="submit" class="btn btn-info">Comments</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endif
@endsection
