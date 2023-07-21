<?php

namespace App\Http\Controllers;

use App\Http\Requests\Courses\StoreLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function create($course_id)
    {
        $course  = Course::find($course_id);
        return view('courses.lessons.create', compact('course'));
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = new Lesson;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                Auth::user()->tenant->subdomain . '/images/courses/lessons',
                $filename
            );

            $lesson->image = $path;
        }

        $lesson->module_id = $request->module_id;
        $lesson->name = $request->name;
        $lesson->url = $request->url;
        $lesson->video = $request->video;
        $lesson->description = $request->description;
        $lesson->save();
        return redirect()->route('courses.show', $lesson->module->course->id)->withSuccess('Aula cadastrada com sucesso!');
    }

    public function edit($course_id, $module_id, $lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        return view('courses.lessons.edit', compact('lesson'));
    }

    public function update(StoreLessonRequest $request, $id)
    {
        $lesson = Lesson::find($id);


        if ($request->file('image')) {

            $image = Storage::disk()->exists($lesson->image);
            if ($image) {
                Storage::delete($lesson->image);
            }

            $file = $request->file('image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                Auth::user()->tenant->subdomain . '/images/courses/lessons',
                $filename
            );

            $lesson->image = $path;
        }



        $lesson->module_id = $request->module_id;
        $lesson->name = $request->name;
        $lesson->url = $request->url;
        $lesson->video = $request->video;
        $lesson->description = $request->description;

        $lesson->save();
        return redirect()->route('courses.show', $lesson->module->course->id)->withSuccess('Aula atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $image = Storage::disk()->exists($lesson->image);
        if ($image) {
            Storage::delete($lesson->image);
        }
        $lesson->delete();
        return redirect()->route('courses.show', $lesson->module->course->id)->withSuccess('Aula deletada com sucesso!');
    }
}
