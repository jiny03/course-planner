@extends('layouts/layout')

@section('title')
    Edit Comment of {{ $course->course_number }} course
@endsection

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h2>Edit Comment of {{ $course->course_number }} course</h2>
        <div class="mb-3">
            <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                @csrf
                <label for="comment" class="form-label">Leave Comment</label>
                <textarea class="form-control @if($errors->has('comment')) is-invalid @endif"  id="comment" name="comment" rows="5" required>{{ old('comment', $comment->body) }}</textarea>
                    @if ($errors->has('comment'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                <button type="submit" class="btn btn-primary mt-2">Leave Comment</button>
            </form>
        </div>
    </div>
@endsection
