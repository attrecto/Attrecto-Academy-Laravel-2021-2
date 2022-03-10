<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'title' => 'course1',
                'description' => 'course1 description',
                'author' => 'course1 author',
                'url' => 'http://course1.com',
            ],
            [
                'title' => 'course2',
                'description' => 'course2 description',
                'author' => 'course2 author',
                'url' => 'http://course2.com',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
