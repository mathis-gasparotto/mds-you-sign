<?php

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
            $table->date('start_at');
            $table->date('end_at');
            $table->string('label');
            $table->string('room');
            $table->integer('signed_code');
            $table->timestamps();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
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
