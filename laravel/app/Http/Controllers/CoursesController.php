<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\JsonResponse;

class CoursesController extends Controller
{
    public function show(): View
    {
        $id_user = session()->get('id');
        $user = User::find($id_user);
        //dd($id_user);
        $lessons = Lesson::where('teacher_id', $id_user)->with('users')->get();

        return view('dashboard', ['user' => $user, 'lessons' => $lessons]);
    }
    public function showCourse(Request $request): View
    {

        $lesson_id = $request->id;
        $id_user = session()->get('id');
        $user = User::find($id_user);
        $user_lesson = LessonStudent::where('lesson_id', $lesson_id)->with('user','lesson')->get();
        $signed_code = Str::uuid();
        $qrcode = QrCode::size(600)
            ->format('svg')
            ->generate($signed_code);
        $lesson = Lesson::find($lesson_id);
        $lesson->update(['signed_code' => $signed_code]);
        return view('course', ['users' => $user_lesson,'lesson' => $lesson],compact('qrcode'));
    }
    public  function  qrCode(Request $request):\Illuminate\Http\JsonResponse{
        $lesson_id = $request->id;
        $id_user = session()->get('id');
        $user = User::find($id_user);
        $user_lesson = LessonStudent::where('lesson_id', $lesson_id)->with('user','lesson')->get();
        $signed_code = Str::uuid();
        $qrcode = QrCode::size(600)
            ->format('svg')
            ->generate($signed_code);
        $qrcodeSvg = (string)$qrcode;
        $lesson = Lesson::find($lesson_id);
        $lesson->update(['signed_code' => $signed_code]);

        return response()->json($qrcodeSvg);
    }

}
