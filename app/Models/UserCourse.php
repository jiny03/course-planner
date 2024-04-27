<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'units', 'instructor', 'course_number', 'user_id', 'user_semester_id', 'is_favorited'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'user_semester_id');
    }
}
