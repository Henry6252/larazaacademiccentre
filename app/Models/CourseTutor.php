<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseTutor extends Pivot
{
    use HasFactory;

    protected $table = 'course_tutor';

    protected $fillable = ['course_id','tutor_id','semester_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function tutors()
{
    return $this->belongsToMany(
        User::class,
        'course_tutor',
        'course_id',  // pivot key referencing course
        'tutor_id'    // pivot key referencing user/tutor
    )->withPivot('semester_id', 'academic_year_id')
     ->withTimestamps();
}

}
