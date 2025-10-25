<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Introduction to Programming',
                'code' => 'CS101',
                'description' => 'Basics of programming using Python.',
                'credits' => 3,
            ],
            [
                'name' => 'Database Management Systems',
                'code' => 'CS202',
                'description' => 'Design and management of databases with SQL.',
                'credits' => 4,
            ],
            [
                'name' => 'Web Development',
                'code' => 'CS303',
                'description' => 'Front-end and back-end web development.',
                'credits' => 3,
            ],
            [
                'name' => 'Computer Networks',
                'code' => 'CS404',
                'description' => 'Study of network protocols and security.',
                'credits' => 3,
            ],
            [
                'name' => 'Software Engineering',
                'code' => 'CS505',
                'description' => 'Principles of designing and managing software projects.',
                'credits' => 4,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
