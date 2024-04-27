@extends('layouts/layout')

@section('title', 'Planned Semesters')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        <h1>Manage Your Semesters</h1>
        <a href="{{ route('schedule.addSemester') }}" class="btn btn-success mb-3">Add New Semester</a>
        @if ($semesters->isEmpty())
            <div class="alert alert-info">No semesters added yet.</div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Current schedule</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($semesters as $semester)
                    <tr>
                        <td>
                            <a href="{{ route('schedule.viewSemester', $semester) }}">{{ $semester->title }}</a>
                        </td>
                        <td>
                            @if ($semester->id != Auth::user()->default_semester_id)
                                <form action="{{ route('schedule.setDefaultSemester', $semester) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Set as current schedule</button>
                                </form>
                            @else
                                <span class="badge bg-success">Current</span>
                            @endif
                        </td>
                        <td>
                            @if ($semester->id != Auth::user()->default_semester_id)
                                <form action="{{ route('schedule.deleteSemester', $semester) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @else
                                <span class="badge bg-warning">Cannot delete current semester</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
