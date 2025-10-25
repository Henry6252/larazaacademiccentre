<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = ['year']; // e.g., "2025/2026"

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}
