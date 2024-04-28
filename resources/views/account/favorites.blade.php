@extends('layouts/layout')
@section('title', 'Favorites')

@section('main')
    <h1>Favorites lists</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($favorites->count() === 0)
        <div class="alert alert-info">
            There aren't any favorites courses yet. You can favorite a course at
            <a href="{{ route('courses.index') }}">Course lists page</a>
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Instructor Name</th>
                    <th>Units</th>
                    <th>View Comments</th>
                    <th>Favorited time</th>
                    <th>Delete from favorites</th>
                </tr>
                </thead>
            <tbody>
                @foreach ($favorites as $favorite)
                    <tr>
                        <td>{{ $favorite->course_number }}</td>
                        <td>{{ $favorite->title }}</td>
                        <td>{{ $favorite->instructor }}</td>
                        <td>{{ $favorite->units }}</td>
                        <td>
                            <form action="{{ route('courses.viewComments', $favorite->course_id) }}" method="GET">
                                <button type="submit" class="btn btn-info">Comments</button>
                            </form>
                        </td>
                        <td>
                            <?php echo date_format($favorite->created_at, 'n/j/Y')?> at
                            <?php echo date_format($favorite->created_at, 'g:i A') ?>
                        </td>

                        <td>
                            <form action="{{ route('account.deleteFavorite', $favorite->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
