@extends('layouts/layout')

@section('title')
    Schedule of {{ $semester->title }} semester
@endsection

@section('main')
    <h1>Schedule of {{ $semester->title }} semester</h1>
    <div>
        @if ($userCourses->count() === 0)
            <div class="alert alert-info">
                There aren't any courses scheduled for current semester.
                Browse new coures at <a href="{{ route('courses.index') }}">Course lists</a>
            </div>
        @else
            <h2>
                Total units: {{ $userCourses->sum('units') }}
            </h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course name</th>
                        <th>Instructor name</th>
                        <th>Units</th>
                        <th>Delete</th>
                        <th>View Comments</th>
                        <th>Add to favorites</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userCourses as $userCourse)
                    <tr>
                        <td>{{ $userCourse->course_number }}</td>
                        <td>{{ $userCourse->title }}</td>
                        <td>{{ $userCourse->instructor }}</td>
                        <td>{{ $userCourse->units }}</td>
                        <td>
                            <form action="{{ route('schedule.deleteCourse', $userCourse) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>

                        <td>
                            <form action="{{ route('courses.viewComments', $userCourse->course_id) }}" method="GET">
                                <button type="submit" class="btn btn-info">Comments</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('account.addFavorites', $userCourse->course_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Favorite</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
