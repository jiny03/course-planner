<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'course_id', 'title', 'units', 'instructor', 'course_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
