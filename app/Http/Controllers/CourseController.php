<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
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
            'title' => 'required|max:100|unique:courses,title',
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

}
