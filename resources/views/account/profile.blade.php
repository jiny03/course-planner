@extends('registration/layout')

@section('title', 'Profile')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
@endsection
