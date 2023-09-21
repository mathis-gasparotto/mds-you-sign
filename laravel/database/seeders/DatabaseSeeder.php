<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Classe;
use App\Models\Lesson;
use App\Models\LessonStudent;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Classe::factory(3)->create();
//        User::factory(30)->create();
        User::factory(1)->admin()->create();
        User::factory(10)->teacher()->create();
        User::factory(50)->student()->create();
        Lesson::factory(15)->create();
        LessonStudent::factory(30)->create();

    }
}
