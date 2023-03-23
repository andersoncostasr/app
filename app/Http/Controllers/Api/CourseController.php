<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attacchment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;

class CourseController extends Controller
{

    public function categories()
    {
        $categories = Category::orderBy('order')->get();
        $courses = array('name' => 'courses');

        foreach ($categories as $category) {
            $courses_array = (array) $category->courses;
            array_push($courses_array, $courses);
        }

        return response()->json($categories);
    }

    public function index()
    {
        $courses = Course::all();

        return response()->json([$courses]);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json([$course]);
    }

    public function modules($id)
    {
        $course = Course::findOrFail($id);
        $modules = $course->modules;
        $lessons = array('name' => 'lessons');

        foreach ($modules as $module) {
            $lessons_array = (array) $module->lessons;
            array_push($lessons_array, $lessons);
        }

        return response()->json($modules);
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

        return response()->json([$lesson]);
    }

    public function attacchments($lessonId)
    {
        $attacchments = Attacchment::where('lesson_id', $lessonId)->get();
        return response()->json($attacchments);
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