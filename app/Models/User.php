<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// ✅ Import HasRoles trait
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles; // ✅ Enables role/permission functionality

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
   // app/Models/User.php
public function courses()
{
    return $this->belongsToMany(
        Course::class,
        'course_tutor',    // ✅ Correct pivot table
        'tutor_id',        // Foreign key on pivot for this model
        'course_id'        // Foreign key on pivot for the related model
    )->withPivot('semester_id', 'academic_year_id')
     ->withTimestamps();
}

public function tutorProfile()
{
    return $this->hasOne(Tutor::class);
}

// app/Models/User.php
public function student()
{
    return $this->hasOne(Student::class);
}
// public function courseAssignments()
// {
//     return $this->belongsToMany(
//         Course::class,
//         'course_tutor',
//         'tutor_id',   // this model’s foreign key on pivot
//         'course_id'   // other side’s foreign key
//     )->withPivot('semester_id', 'academic_year_id')
//      ->withTimestamps();
// }
// public function assignedCourses()
// {
//     return $this->belongsToMany(Course::class, 'course_tutor', 'tutor_id', 'course_id')
//                 ->withPivot('semester_id', 'academic_year_id')
//                 ->withTimestamps();
// }


}
