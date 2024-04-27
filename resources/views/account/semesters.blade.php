@extends('layouts/layout')

@section('title', 'Planned Semesters')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="container mt-4">
        <div class="row mb-5">
            <h1 class="col-9">Planned Semesters</h1>
            <a href="{{ route('schedule.addSemester') }}" class="btn btn-primary col-3">Add New Semester</a>
        </div>

        @if ($semesters->isEmpty())
            <h2>You have not added any semesters yet.</h2>
        @else
            <ul>
                @foreach ($semesters as $semester)
                    <li>
                        {{ $semester->title }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
