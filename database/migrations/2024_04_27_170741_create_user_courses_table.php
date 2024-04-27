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
        Schema::create('user_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('units');
            $table->string('instructor');
            $table->string('course_number');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_semester_id')->constrained('semesters')->onDelete('cascade');
            $table->boolean('is_favorited')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_courses');
    }
};
