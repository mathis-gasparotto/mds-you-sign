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
    Route::get('/', 'show')->name('dashboard')->middleware(['auth','verified','teacher']);
    Route::get('/course', 'showCourse')->middleware(['auth','verified','teacher'])->name('course');
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


