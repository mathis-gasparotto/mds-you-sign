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
        'sign_code',
        'id_user_teacher'
    ];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
