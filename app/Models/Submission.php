<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'assessment_id', 'student_id', 'file_path', 'answer_text',
        'score', 'feedback', 'graded'
    ];

    public function assessment() {
        return $this->belongsTo(Assessment::class);
    }

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }
}
