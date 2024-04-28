<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Course;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Course::create([
            'title' => 'Advanced back-end web development',
            'course_number' => 'ITP405',
            'instructor' => 'David Tang',
            'units' => 4
        ]);
        Course::create([
            'title' => 'Accelerated programming in python',
            'course_number' => 'ITP116',
            'instructor' => 'Sinan Seymen',
            'units' => 2
        ]);
        Course::create([
            'title' => 'Full-stack web development',
            'course_number' => 'ITP303',
            'instructor' => 'Hannah Nguyen',
            'units' => 4
        ]);
        Course::create([
            'title' => 'Professional c++',
            'course_number' => 'ITP435',
            'instructor' => 'Sanjay Madhav',
            'units' => 4
        ]);
        Course::create([
            'title' => 'Video game programming',
            'course_number' => 'ITP380',
            'instructor' => 'Clark Kromenaker',
            'units' => 4
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course', function (Blueprint $table) {
            //
        });
    }
};
