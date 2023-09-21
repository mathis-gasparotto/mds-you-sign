<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('label');
            $table->string('room');
            $table->integer('signed_code');
            $table->timestamps();
            $table->foreignIdFor(User::class, 'teacher_id')->constrained()->cascadeOnDelete()->references('id')->on('users');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::create('lesson_students', function (Blueprint $table) {
            $table->id();
            $table->boolean('signed')->default(false);
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Lesson::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('lesson_student');
    }
};
