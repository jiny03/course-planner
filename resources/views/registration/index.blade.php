@extends('layouts/layout')

@section('title', 'Register')

@section('main')
<h1>Register</h1>
<form method="POST" action="{{ route('registration.create') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{ old('name') }}">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" id="username" name="username" value="{{ old('username') }}">
        @if ($errors->has('username'))
            <div class="invalid-feedback">
                {{ $errors->first('username') }}
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" value="{{ old('email') }}">
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>


    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @if($errors->has('email')) is-invalid @endif" id="password" name="password">
        @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>
@endsection
