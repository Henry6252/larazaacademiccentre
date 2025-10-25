<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_tutor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('tutor_id')->constrained('users')->onDelete('cascade'); // tutors stored in users table
            $table->foreignId('semester_id')->constrained()->onDelete('cascade'); // course assigned for a semester
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_tutor');
    }
};
