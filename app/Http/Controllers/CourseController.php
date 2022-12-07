<?php

namespace App\Http\Controllers;

use App\Http\Requests\Courses\StoreCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if ($course)
            return view('courses.show', compact('course'));

        return redirect()
            ->route('courses.index')
            ->withMessage('Curso não encontrado');
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
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                Auth::user()->tenant->subdomain . '/images/courses/',
                $filename
            );

            $data['image'] = $path;
        }

        $course = $request->user()
            ->courses()
            ->create($data);

        return redirect()->route('courses.show', $course->id);
    }

    public function edit($id)
    {
        $course = Course::find($id);
        if ($course)
            return view('courses.edit', compact('course'));

        return redirect()
            ->route('courses.index')
            ->withMessage('Curso não encontrado para editar');
    }

    public function update(UpdateCourseRequest $request, $id)
    {
        $course = Course::find($id);
        $data = $request->all();

        $data['available'] = (!isset($data['available'])) ? 0 : 1;

        if ($request->file('image')) {

            $image = Storage::disk()->exists($course->image);
            if ($image) {
                Storage::delete($course->image);
            }

            $file = $request->file('image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                Auth::user()->tenant->subdomain . '/images/courses',
                $filename
            );

            $data['image'] = $path;
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
