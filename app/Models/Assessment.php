<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'course_unit_id', 'tutor_id', 'title', 'type', 'description',
        'total_marks', 'due_date', 'file_path'
    ];

    public function courseUnit() {
        return $this->belongsTo(CourseUnit::class);
    }

    public function submissions() {
        return $this->hasMany(Submission::class);
    }

    public function tutor() {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}
