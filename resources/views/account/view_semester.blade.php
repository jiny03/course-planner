@extends('layouts/layout')

@section('title')
    Schedule of {{ $semester->title }} semester
@endsection

@section('main')
    <h1>Schedule of {{ $semester->title }} semester</h1>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
