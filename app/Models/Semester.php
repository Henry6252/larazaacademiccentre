<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['name','academic_year_id'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    // Courses assigned to tutors in this semester
    public function courseTutors()
    {
        return $this->hasMany(CourseTutor::class);
    }

    // Students registered in this semester
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
