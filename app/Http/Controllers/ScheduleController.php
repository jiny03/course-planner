<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use Auth;

use function PHPUnit\Framework\isNull;

class ScheduleController extends Controller
{

    public function semesters()
    {
        return view('account.semesters', [
            'semesters' => Auth::user()->semesters()->get(),
        ]);
    }

    public function addCourse($courseId) {
            
    }

    public function addSemester()
    {
        return view('account.add_semester');
    }

    public function storeSemester(Request $request)
    {
        $user = Auth::user();
        $title = ucfirst(strtolower($request->semester)) . ' ' . $request->year;
        $user_id = $user->id;

        $duplicateSemester = Semester::where('title', $title)
            ->where('user_id', $user_id)
            ->first();

        if($duplicateSemester) {
            return redirect()
            ->route('schedule.addSemester')
            ->with('error', "{$title} semester already exists.");
        }
        else {
            $request->validate([
                'year' => 'required|integer|between:2024,2030',
                'semester' => 'required|in:fall,spring,summer',
            ]);

            $semester = new Semester();
            $semester->title = $title;
            $semester->user_id = $user_id;
            if($semester->save()) {
                // if it is the first semester being added to the user, set it as the user's default semester
                if ($user->semesters()->count() === 1) {
                    $user->default_semester_id = $semester->id;
                    $user->save();
                }

                return redirect()
                    ->route('schedule.semesters')
                    ->with('success', "{$semester->title} semester was added successfully");
            }
        }
    }

    public function setDefault(Semester $semester) {
        $user = Auth::user();
        $user->default_semester_id = $semester->id;
        $user->save();
        return redirect()
            ->back()
            ->with('success', "Switched current semester to {$semester->title}.");

    }

    public function delete(Semester $semester) {
        $user = Auth::user();
        $title = $semester->title;
        if ($semester->id == $user->default_semester_id) {
            return redirect()
                ->back()
                ->with('error', "Cannot delete the default semester.");
        }
        else {
            if ($semester->courses()->count() > 0) {
                foreach ($semester->courses as $course) {
                    $course->delete();
                }
            }
            $semester->delete();
            return redirect()
                ->back()
                ->with('success', "Succesfully deleted {$title} semester.");
        }
    }
}
