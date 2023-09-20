<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CoursesController extends Controller
{
    public function show(): View
    {
        $id_user = session()->get('id');
        $user = User::find($id_user);
        //dd($id_user);
        $lessons = Lesson::where('user_id', $id_user)->with('users')->get();

        return view('dashboard', ['user' => $user, 'lessons' => $lessons]);
    }
    public function showCourse(Request $request): View
    {
        $lesson_id = $request->id;
        $id_user = session()->get('id');
        $user = User::find($id_user);
        $user_lesson = LessonStudent::where('lesson_id', $lesson_id)->with('user','lesson')->get();


        //  $lessons = Lesson::where('user_id', $id_user)->with('user')->get();

        return view('course', ['users' => $user_lesson]);
    }
}
