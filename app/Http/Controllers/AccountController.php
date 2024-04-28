<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Semester;
use App\Models\Favorite;
use App\Models\Course;

class AccountController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()
            ->route('login');
    }

    public function loginForm()
    {
        // automatically redirect to profile page if user tried access /login page after the user logged in
        if (Auth::check()) {
            return redirect()->route('account.schedule');
        }
        else {
            return view('account.login');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:20',
            'password' => 'required|string|min:3'
        ]);

        $loginWasSuccessful = Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        if ($loginWasSuccessful) {
            return redirect()
                ->route('account.schedule')
                ->with('success', "Succesfully logged in account as '{$request->input('username')}'.");
        }
        else {
            return redirect()
                ->route('login')
                ->with('error', 'Invalid credentials.');
        }
    }

    public function schedule()
    {
        $user = Auth::user();
        $defaultSemester = Semester::find($user->default_semester_id);
        if(!$defaultSemester) {
            return view('account.schedule', [
                'defaultSemester' => null,
                'userCourses' => null,
            ]);
        }

        $userCourses = $defaultSemester->userCourses()->get();

        if ($userCourses->count() === 0) {
            return view('account.schedule', [
                'defaultSemester' => $defaultSemester,
                'userCourses' => $userCourses
            ])->with('error', 'No courses scheduled for this semester. Add some courses.');
        }
        return view('account.schedule', [
            'user' => Auth::user(),
            'defaultSemester' => $defaultSemester,
            'userCourses' => $userCourses,
        ]);
    }
    public function favorites() {
        $user = Auth::user();
        return view('account/favorites', [
            'favorites' => $user->favorites()->get()
        ]);
    }
    public function addFavorites($courseId) {
        $user = Auth::user();

        $course = Course::find($courseId);
        if (!$course) {
            return redirect()
                ->route('courses.index')
                ->with('error', 'Course not found.');
        }

        $duplicateFavorite = Favorite::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($duplicateFavorite) {
            return back()
                ->with('error', "Course {$course->course_number} already exists in your favorites list.");
            }
        else {
            $newFavorite = new Favorite([
                'user_id' => $user->id,
                'course_id' => $courseId,
                'title' => $course->title,
                'course_number' => $course->course_number,
                'instructor' => $course->instructor,
                'units' => $course->units,
            ]);
            $newFavorite->save();

            return back()
                ->with('success', "Course {$course->course_number} succesfully added to Favorites list.");
        }
    }

    public function deleteFavorite($favoriteId) {
        $user = Auth::user();
        $favorite = Favorite::find($favoriteId);

        if (!$favorite) {
            return back()
                ->with('error', "Favorite doesn't exist.");
        }

        $course = Course::find($favorite->course_id);
        if ($user->id !== $favorite->user_id) {
            return back()
                ->with('error', 'You can only modify your favorites list.');
        }
        else {
            $favorite->delete();
            return back()
                ->with('success', "Course {$course->course_number} succesfully deleted from Favorites list.");
        }

    }
}
