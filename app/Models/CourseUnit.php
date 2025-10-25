<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUnit extends Model
{
    use HasFactory;

    protected $table = 'course_units';

    protected $fillable = [
        'course_id',   
        'name',        
        'code',        
        'description'  
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

   
    public function materials()
    {
        return $this->hasMany(CourseMaterial::class, 'unit_id');
    }

    
    public function tutors()
    {
        return $this->belongsToMany(User::class, 'course_tutor', 'unit_id', 'tutor_id');
    }
    
}
