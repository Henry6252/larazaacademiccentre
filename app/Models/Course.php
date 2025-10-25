<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }
  public function tutors()
{
    return $this->belongsToMany(
        User::class,
        'course_tutor',
        'course_id',   // pivot key referencing course
        'tutor_id'     // pivot key referencing user/tutor
    )->withPivot('semester_id', 'academic_year_id')
     ->withTimestamps();
}

public function course()
{
    return $this->belongsTo(Course::class);
}
public function tutor()
{
    return $this->belongsTo(\App\Models\User::class, 'tutor_id');
}

public function semester()
{
    return $this->belongsTo(Semester::class);
}

public function academicYear()
{
    return $this->belongsTo(AcademicYear::class);
}
public function materials()
{
    return $this->hasMany(CourseMaterial::class);
}
public function units()
{
    return $this->hasMany(CourseUnit::class);
}



}
