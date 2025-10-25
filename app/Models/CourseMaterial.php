<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
    'unit_id',
    'course_id',
    'user_id',
    'title',
    'description',
    'file_path',
];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function unit()
    {
        return $this->belongsTo(CourseUnit::class);
    }
}
