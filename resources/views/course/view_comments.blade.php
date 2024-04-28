@extends('layouts/layout')

@section('title')
    Comments of {{ $course->course_number }} course
@endsection

@section('main')
    <h1>Comments of {{ $course->course_number }} course</h1>

    @if($comments->count() === 0)
        <div class="alert alert-info">
            There aren't any comments for this course yet.
        </div>
        <div class="mb-3">
            <form method="POST" action="{{ route('courses.addComment', $course->id) }}">
                @csrf
                <label for="comment" class="form-label"></label>
                <textarea class="form-control @if($errors->has('comment')) is-invalid @endif" id="comment" name="comment" rows="3" placeholder="Leave comment" value="{{ old('comment') }}"></textarea>
                    @if ($errors->has('comment'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                <button type="submit" class="btn btn-primary mt-2">Leave Comment</button>
            </form>
        </div>
    @else
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-3">
            <form method="POST"  action="{{ route('courses.addComment', $course->id) }}">
                @csrf
                @if ($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <label for="comment" class="form-label"></label>
                <textarea class="form-control @if($errors->has('comment')) is-invalid @endif" id="comment" name="comment" rows="3" placeholder="Leave comment"></textarea>
                    @if ($errors->has('comment'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                <button type="submit" class="btn btn-primary mt-2">Leave Comment</button>
            </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Commenter</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->username }}</td>
                    <td>{{ $comment->body }}</td>
                    <td><?php echo date_format($comment->created_at, 'n/j/Y')?> at
                        <?php echo date_format($comment->created_at, 'g:i A') ?></td>
                    <td>
                        @if (auth()->id() === $comment->user_id)
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('comments.delete', $comment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @else
                            <span class="badge bg-warning">Cannot modify</span>

                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
