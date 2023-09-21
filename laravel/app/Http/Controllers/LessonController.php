<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Classe;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function show(): View{
        $lessons = Lesson::with('teacher')->orderBy('label')->get();
        $teachers = User::where('role','teacher')->orderBy('first_name')->get();
        $classes = Classe::orderBy('name')->get();
        return view('lesson-creator', ['lessons' => $lessons,'teachers' =>$teachers ,'classes' => $classes]);
    }

    public function future(Request $request): string
    {
        $now = new \DateTime();
        $now->setTimezone(new \DateTimeZone('Europe/Paris'));
        $lessonStudents = LessonStudent::where('user_id', '=', $request->user()->id)->get();
        $lessonIds = [];
        foreach ($lessonStudents as $lessonStudent) {
            $lessonIds[] = $lessonStudent->lesson_id;
        }
        return Lesson::with('teacher')->whereDate('start_at', '>', $now->format('Y-m-d'))->orderBy('start_at', 'desc')->findMany($lessonIds)->toJson();
    }

    public function getItem(Request $request, $id): string
    {
        $lesson = Lesson::find($id);
        if(!$lesson) {
            return response()->json([
                'message' => 'Lesson not found'
            ], 404);
        }
        $classe = Classe::find($lesson->classe_id);
        $teacher = User::find($lesson->teacher_id);
        $signed = LessonStudent::where('lesson_id', '=', $lesson->id)->where('user_id', '=', $request->user()->id)->first()->signed;
        $lesson->teacher = $teacher;
        $lesson->classe = $classe;
        $lesson->signed = $signed;
        return $lesson->toJson();
    }

    public function today(Request $request): string
    {
        $now = new \DateTime();
        $now->setTimezone(new \DateTimeZone('Europe/Paris'));

        $lessonStudents = LessonStudent::where('user_id', '=', $request->user()->id)->get();
        $lessonIds = [];
        foreach ($lessonStudents as $lessonStudent) {
            $lessonIds[] = $lessonStudent->lesson_id;
        }
        return Lesson::with('teacher')->whereDate('start_at', '=', $now->format('Y-m-d'))->orderBy('start_at', 'desc')->findMany($lessonIds)->toJson();

    }

    public function destroy(Request $request): View{
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $lesson_to_delete = Lesson::find($request->id);
        $lesson_to_delete->delete();
        $lessons = Lesson::with('teacher')->orderBy('label')->get();
        $teachers = User::where('role','teacher')->orderBy('first_name')->get();
        $classes = Classe::orderBy('name')->get();
        return view('lesson-creator', ['lessons' => $lessons,'teachers' =>$teachers ,'classes' => $classes]);
    }
    public function update(Request $request): View{

        $request->validateWithBag('lessonUpdate', [
            'password' => ['required', 'current_password'],
        ]);

        $class_id_to_associate = $request->classe_id;
      //  dd($class_id_to_associate);
        $users_associated_to_class = User::where('classe_id',$class_id_to_associate)->get();
       // dd($users_associated_to_class);
        foreach ($users_associated_to_class as $user_associated_to_class){
         $user_lesson_students = LessonStudent::where('user_id',$user_associated_to_class->id)->get();
            //dd($user_lesson_students);
         if( $user_lesson_students->isNotEmpty()){

            foreach ($user_lesson_students as $user_lesson_student){
                //dd($user_lesson_student);
                $user_lesson_student->update(['lesson_id' => $request->id]);

            }

         }else{

             $user_lesson_student = LessonStudent::create([
                 'signed' => false,
                 'user_id' => $user_associated_to_class->id,
                 'lesson_id' => $request->id,
                 'created_at' => now(),
                 'updated_at' => now(),
             ]);
         }
        }

        $lesson_to_update = Lesson::find($request->id);
        $lesson_to_update->update(['label' => $request->label, 'start_at' => $request->start_at,'end_at' => $request->end_at,'room' => $request->room,'teacher_id' => $request->teacher_id, 'updated_at' => now()]);
        $lesson_to_update->save();
        $lessons = Lesson::with('teacher')->orderBy('label')->get();
        $teachers = User::where('role','teacher')->orderBy('first_name')->get();
        $classes = Classe::orderBy('name')->get();
        return view('lesson-creator', ['lessons' => $lessons,'teachers' =>$teachers ,'classes' => $classes]);
    }
    public function create(Request $request){
        $request->validateWithBag('lessonCreation', [
            'password' => ['required', 'current_password'],
            'user_id' => ['required']
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
        $classes = Classe::orderBy('name')->get();
        return view('lesson-creator', ['lessons' => $lessons,'teachers' =>$teachers ,'classes' => $classes]);

    }
}
