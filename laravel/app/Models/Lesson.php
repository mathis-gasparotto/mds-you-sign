<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_at',
        'end_at',
        'label',
        'room',
        'signed_code',
        'user_id'

    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'lesson_students', 'lesson_id','user_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }
}
