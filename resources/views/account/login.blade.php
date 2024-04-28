@extends('layouts/layout')

@section('title', 'Login')

@section('main')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <h1>Login</h1>

    <form method="post" action="{{ route('account.login') }}">
        @csrf
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
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @if($errors->has('email')) is-invalid @endif" id="password" name="password">
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
        <input type="submit" value="Login" class="btn btn-primary">
    </form>
@endsection
