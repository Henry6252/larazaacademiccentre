<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * (Optional, but useful for clarity — especially if your table name
     * doesn't strictly follow Laravel's naming conventions.)
     */
    protected $table = 'enrollments';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'student_id',
        'course_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: Each enrollment belongs to a specific student.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Relationship: Each enrollment belongs to a specific course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
