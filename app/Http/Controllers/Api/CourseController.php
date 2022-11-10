<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();

        return response()->json([
            'courses' => $courses
        ]);
    }



    // public function index()
    // {
    //     $courses = Course::all();
    //     $modules = array('name' => 'modules');
    //     $lessons = array('name' => 'lessons');



    //     foreach ($courses as $course) {
    //         $modules_array = (array) $course->modules;

    //         foreach ($course->modules as $module) {
    //             $lessons_array = (array) $module->lessons;
    //         }


    //         array_push($modules_array, $modules);
    //         array_push($lessons_array, $lessons);
    //     }

    //     return response()->json([
    //         'courses' => $courses,
    //         'modules' => $modules,
    //         'lessons' => $lessons
    //     ], 200);
    // }
}
