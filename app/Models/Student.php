<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'student_number',
        'name',
        'email',
        'phone',
        'department',
        'program',
        'year_of_study',
    ];

    /**
     * Relationship: A student belongs to one user account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A student can have many enrollments.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relationship: A student can access courses through enrollments.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withTimestamps();
    }

    /**
     * Accessor: Get the student's full name (if first and last name are stored separately).
     * Uncomment if you have `first_name` and `last_name` columns.
     */
    // public function getFullNameAttribute()
    // {
    //     return "{$this->first_name} {$this->last_name}";
    // }

    /**
     * Helper: Check if the student is enrolled in a specific course.
     */
    public function isEnrolledIn($courseId)
    {
        return $this->enrollments()->where('course_id', $courseId)->exists();
    }
}
