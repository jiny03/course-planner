<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Semester;

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
            return redirect()->route('login')->with('error', 'Invalid credentials.');
        }
    }

    public function schedule()
    {
        $user = Auth::user();
        $defaultSemester = Semester::find($user->default_semester_id);
        if(!$defaultSemester) {
            return view('account.schedule', [
                'defaultSemester' => null,
                'courses' => null,
            ]);
        }

        $courses = $defaultSemester->userCourses()->get();

        if ($courses->count() === 0) {
            return view('account.schedule', [
                'defaultSemester' => $defaultSemester,
                'courses' => $courses
            ])->with('error', 'No courses scheduled for this semester. Add some courses.');
        }
        return view('account.schedule', [
            'user' => Auth::user(),
            'defaultSemester' => $defaultSemester,
            'courses' => $courses,
        ]);
    }

    public function favorites() {
        $user = Auth::user();
        
        return view('account/favorites', [

        ]);
    }

}
