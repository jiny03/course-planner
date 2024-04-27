@extends('registration/layout')

@section('title', 'Profile')

@section('main')
    <p>Successfully logged in as {{ $user->username }}.</p>
@endsection
