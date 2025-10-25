<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'tutor_course_semester', 'tutor_id', 'course_id')
                    ->withPivot('semester_id')
                    ->withTimestamps();
    }
    public function assignedCourses()
{
    return $this->belongsToMany(
        Course::class,
        'course_tutor',
        'tutor_id',     // your pivot foreign key to users
        'course_id'     // pivot foreign key to courses
    )->withPivot('semester_id','academic_year_id')
     ->withTimestamps();
}

}
