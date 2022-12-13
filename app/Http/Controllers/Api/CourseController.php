<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();

        return response()->json([
            'data' => $courses
        ]);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json([
            'data' => $course
        ]);
    }

    public function modules($id)
    {
        $course = Course::findOrFail($id);
        $modules = $course->modules;
        return response()->json([
            'data' => $modules
        ]);
    }

    public function module($moduleId)
    {
        $module = Module::findOrFail($moduleId);
        return response()->json([
            'data' => $module
        ]);
    }

    public function lessons($moduleId)
    {
        $module = Module::findOrFail($moduleId);
        $lessons = $module->lessons;
        return response()->json([
            'data' => $lessons
        ]);
    }

    public function lesson($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $lesson->attacchments;

        return response()->json([
            'data' => [
                'lesson' => $lesson
            ]
        ]);
    }
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