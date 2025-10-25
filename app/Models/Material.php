<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course_id',
        'user_id',
        'file_path',
    ];

    // Relationship: Material belongs to a Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship: Material belongs to a User (tutor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
