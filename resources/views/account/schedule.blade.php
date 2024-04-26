@extends('layouts/layout')

@section('title', 'Schedule')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <h1>Schedule for 2024 Fall semester</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Course name</th>
                    <th>Course ID</th>
                    <th>Instructor name</th>
                    <th>Units</th>
                </tr>
                </thead>
            <tbody>
                <tr>
                    <td>scheduled course name</td>
                    <td>scheduled course ID</td>
                    <td>scheduled course instructor</td>
                    <td>scheduled course units</td>
                </tr>
            </tbody>
        </table>
    </div>


@endsection
