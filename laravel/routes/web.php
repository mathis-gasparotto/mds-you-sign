<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/dashboard')->controller(CoursesController::class)->group(function () {
    Route::get('/', 'show')->name('dashboard')->middleware(['auth','verified']);
    Route::get('/course', 'showCourse')->middleware(['auth','verified','teacher'])->name('course');
});

Route::prefix('/list-account')->middleware(['auth','verified','admin'])->controller(\App\Http\Controllers\ListController::class)->group(function (){
   Route::get('/','show')->name('list-account');
   //Route::put('/', 'create')->name('list-account.create');
   Route::patch('/',  'update')->name('list-account.update');
   Route::delete('/','destroy')->name('list-account.destroy');
});
Route::prefix('/class-creator')->middleware(['auth','verified','admin'])->controller(\App\Http\Controllers\ClassesController::class)->group(function (){
    Route::get('/','show')->name('class-creator');
    Route::put('/', 'create')->name('class-creator.create');
    Route::patch('/',  'update')->name('class-creator.update');
    Route::delete('/','destroy')->name('class-creator.destroy');
});
Route::prefix('/lesson-creator')->middleware(['auth','verified','admin'])->controller(\App\Http\Controllers\LessonController::class)->group(function (){
    Route::get('/','show')->name('lesson-creator');
    Route::put('/', 'create')->name('lesson-creator.create');
    Route::patch('/',  'update')->name('lesson-creator.update');
    Route::delete('/','destroy')->name('lesson-creator.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
Route::get('/register-account',function (){
    return view('register-account');
})->middleware(['auth', 'verified'])->name('register-account');

require __DIR__.'/auth.php';


