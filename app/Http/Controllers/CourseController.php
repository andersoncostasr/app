<?php

namespace App\Http\Controllers;

use App\Http\Requests\Courses\StoreCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::find($id);
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        $data = $request->all();
        $data['available'] = (!isset($data['available'])) ? 0 : 1;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/courses/' . Auth::user()->tenant_id), $filename);
            $data['image'] = $filename;
        }

        $course = $request->user()
            ->courses()
            ->create($data);

        return redirect()->route('courses.show', $course->id);
    }

    public function edit($id)
    {
        $course = Course::find($id);
        return view('courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, $id)
    {
        $course = Course::find($id);
        $data = $request->all();

        $data['available'] = (!isset($data['available'])) ? 0 : 1;

        if ($request->file('image')) {
            if (File::exists(public_path('images/courses/' . Auth::user()->tenant_id . '/' . $course->image))) {
                File::delete(public_path('images/courses/' . Auth::user()->tenant_id . '/' . $course->image));
            }

            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/courses/' . Auth::user()->tenant_id), $filename);
            $data['image'] = $filename;
        }

        $course->update($data);

        return redirect()->route('courses.show', $course->id);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()
            ->route('courses.index')
            ->withSuccess('Curso deletado com sucesso!');
    }
}
