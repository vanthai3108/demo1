<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course = Course::create([
            'name' => 'Web Development',
            'description' => 'This is Web design and development course', 
            'image' => 'storage/courses/course1.jpg', 
            'numberOfSessions' => 30, 
            'shift' => 1, 
            'startDate' => '2021/12/11', 
            'endDate' => '2022/02/11',
            'category_id' => 1,
        ]);
        $course->users()->attach([9,10,11]);
        $course = Course::create([
            'name' => 'Application Development',
            'description' => 'This is Application development course', 
            'image' => 'storage/courses/course2.jpg', 
            'numberOfSessions' => 15, 
            'shift' => 2, 
            'startDate' => '2021/12/25', 
            'endDate' => '2022/01/25',
            'category_id' => 1,
        ]);
        $course->users()->attach([10,11, 13]);
        $course = Course::create([
            'name' => 'Business Intelligence',
            'description' => 'This is Business intelligence, AI course', 
            'image' => 'storage/courses/course3.jpg', 
            'numberOfSessions' => 15, 
            'shift' => 3, 
            'startDate' => '2021/12/17', 
            'endDate' => '2022/3/17',
            'category_id' => 2,
        ]);
        $course->users()->attach([9,11, 13]);
        $course = Course::create([
            'name' => 'Data structure',
            'description' => 'This is data structure, algorithsm course', 
            'image' => 'storage/courses/course4.png', 
            'numberOfSessions' => 15, 
            'shift' => 3, 
            'startDate' => '2021/12/18', 
            'endDate' => '2022/3/18',
            'category_id' => 3,
        ]);
        $course->users()->attach([9,12]);
        $course = Course::create([
            'name' => 'Embedded System',
            'description' => 'This is embedded system and automation course', 
            'image' => 'storage/courses/course5.png', 
            'numberOfSessions' => 30, 
            'shift' => 3, 
            'startDate' => '2021/12/10', 
            'endDate' => '2022/4/10',
            'category_id' => 4,
        ]);
        $course->users()->attach([11,12]);
        $course = Course::create([
            'name' => 'Digital Animation',
            'description' => 'This is graphic design, digital animation course', 
            'image' => 'storage/courses/course6.jpg', 
            'numberOfSessions' => 30, 
            'shift' => 3, 
            'startDate' => '2021/12/15', 
            'endDate' => '2022/4/15',
            'category_id' => 5,
        ]);
        $course->users()->attach([9,13]);
        $course = Course::create([
            'name' => 'Architectural Engineering',
            'description' => 'This is Architectural Engineering course', 
            'image' => 'storage/courses/course7.jpg', 
            'numberOfSessions' => 15, 
            'shift' => 3, 
            'startDate' => '2021/11/11', 
            'endDate' => '2022/2/11',
            'category_id' => 6,
        ]);
        $course->users()->attach([11]);
        $course = Course::create([
            'name' => 'Digital Marketing',
            'description' => 'This is Business and Digital Marketing course', 
            'image' => 'storage/courses/course8.jpg', 
            'numberOfSessions' => 15, 
            'shift' => 3, 
            'startDate' => '2021/12/21', 
            'endDate' => '2022/3/21',
            'category_id' => 7,
        ]);
        $course->users()->attach([12]);
        
    }
}
