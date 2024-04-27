<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['title', 'units', 'description', 'instructor', 'course_number'];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function favorites()
    {
        return $this->belongsTo(User::class, 'favorites');
    }
}
