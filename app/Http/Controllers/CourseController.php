<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Comment;
use Auth;

class CourseController extends Controller
{
    public function index()
    {
        return view('course/course_list', [
            'courses' => Course::all()
                ->sortBy('title')
        ]);
    }
    public function create()
    {
        if (Auth::check()) {
            return view('course/create_course');
        }
        else {
            return redirect()
                ->route('login')
                ->with('error', "You must be logged in to upload a course.");
        }
    }

    public function store(Request $request)
    {
        $title = ucfirst(strtolower($request->input('title')));
        $courseNumber = strtoupper($request->input('course_number'));

        $request->merge([
            'title' => $title,
            'course_number' => $courseNumber,
        ]);

        $request->validate([
            'title' => 'required|min:3|max:100|unique:courses,title',
            'course_number' => 'required|min:2|max:10|unique:courses,course_number',
            'units' => 'required|integer|min:1|max:16',
            'instructor' => 'required|string|max:100'
        ]);

        $course = new Course();
        $course->title = $request->title;
        $course->course_number = $request->course_number;
        $course->units = $request->units;
        $course->instructor = $request->instructor;
        $course->save();

        return redirect()
            ->route('courses.index')
            ->with('success', "Course {$request->course_number} was successfully uploaded.");
    }

    public function viewComments($courseId) {
        $course = Course::find($courseId);
        $comments = Comment::where('course_id', $courseId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('course/view_comments',[
            'course' => $course,
            'comments' => $comments
        ]);
    }

    public function addComment(Request $request, $courseId) {
        $request->validate([
            'comment' => 'required|min:3',
        ]);

        $user = Auth::user();
        $comment = new Comment();
        $comment->body = $request->comment;
        $comment->course_id = $courseId;
        $comment->username = $user->username;
        $comment->user_id = $user->id;
        $comment->save();

        return back()
            ->with('success', 'Comment successfully added.');
    }

    public function editComment($commentId) {
        $user = Auth::user();
        $comment = Comment::where('id', $commentId)
            ->where('user_id', $user->id)->firstOrFail();

        if($comment->user_id !== $user->id) {
            return back()
                ->with('error', 'You can only edit your comment.');
        }
        else {
            $course = Course::find($comment->course_id);
            return view('account/edit_comments', [
                'comment' => $comment,
                'course' => $course
            ]);
        }
    }

    public function updateComment(Request $request, $commentId) {
        $user = Auth::user();
        $comment = Comment::where('id', $commentId)
            ->where('user_id', $user->id)->firstOrFail();

        if($comment->user_id !== $user->id) {
            return back()
                ->with('error', 'You can only edit your comment.');
        }

        $request->validate([
            'comment' => 'required|string|min:3'
        ]);

        $comment->body = $request['comment'];
        $comment->save();

        return redirect()->route('courses.viewComments', $comment->course_id) // Assuming you have this route to go back to the course comments page
            ->with('success', 'Comment updated successfully.');
    }

    public function deleteComment($commentId) {
        $user = Auth::user();
        $comment = Comment::where('id', $commentId)
            ->where('user_id', $user->id)->firstOrFail();

        if($comment->user_id !== $user->id) {
            return back()
                ->with('error', 'You can only delete your comment.');
        }

        $comment->delete();
        return back()
            ->with('success', 'Comment deleted successfully.');
    }
}
