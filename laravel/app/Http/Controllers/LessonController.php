<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function show(): View{
        $lessons = Lesson::with('teacher')->orderBy('label')->get();
        $teachers = User::where('role','teacher')->orderBy('first_name')->get();
        return view('lesson-creator', ['lessons' => $lessons,'teachers' =>$teachers ]);
    }

    public function index(): string
    {
        return Lesson::with('teacher')->orderBy('startAt')->get()->toJson(JSON_PRETTY_PRINT);
    }

    public function meToday(): string
    {
        $userClasse = auth()->user()->getClasse();
        return Lesson::with('teacher')->where()->orderBy('startAt')->get()->toJson(JSON_PRETTY_PRINT);
    }

    public function destroy(Request $request): View{
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $lesson_to_delete = Lesson::find($request->id);
        $lesson_to_delete->delete();
        $lessons = Lesson::with('teacher')->orderBy('label')->get();
        $teachers = User::where('role','teacher')->orderBy('first_name')->get();
        return view('lesson-creator', ['lessons' => $lessons,'teachers' =>$teachers ]);
    }
    public function update(Request $request): View{
        $request->validateWithBag('lessonUpdate', [
            'password' => ['required', 'current_password'],
        ]);
        $lesson_to_update = Lesson::find($request->id);
        $lesson_to_update->update(['label' => $request->label, 'start_at' => $request->start_at,'end_at' => $request->end_at,'room' => $request->room,'teacher_id' => $request->teacher_id, 'updated_at' => now()]);
        $lesson_to_update->save();
        $lessons = Lesson::with('teacher')->orderBy('label')->get();
        $teachers = User::where('role','teacher')->orderBy('first_name')->get();
        return view('lesson-creator', ['lessons' => $lessons,'teachers' =>$teachers ]);
    }
    public function create(Request $request){
        $request->validateWithBag('lessonCreation', [
            'password' => ['required', 'current_password'],
        ]);
        $newLesson = new Lesson;

            $newLesson->label = $request->label;
            $newLesson->start_at = $request->start_at;
            $newLesson->end_at = $request->end_at;
            $newLesson->room = $request->room;
            $newLesson->teacher_id = $request->user_id;
            $newLesson->signed_code = false;
            $newLesson->created_at = now();
            $newLesson->updated_at = now();
            $newLesson->save();

        $lessons = Lesson::with('teacher')->orderBy('label')->get();
        $teachers = User::where('role','teacher')->orderBy('first_name')->get();
        return view('lesson-creator', ['lessons' => $lessons,'teachers' =>$teachers ]);

    }
}
