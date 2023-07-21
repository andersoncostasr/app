<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:5|max:255',
        ]);

        $module = new Module;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                Auth::user()->tenant->subdomain . '/images/courses/modules',
                $filename
            );

            $module->image = $path;
        }


        $module->course_id = $request->course_id;
        $module->name = $request->name;
        $module->save();

        if ($module)
            return redirect()->back()->withSuccess('Módulo criado com sucesso!');

        return redirect()->back()->withError('Não foi possível cadastrar o Módulo');
    }


    public function edit($course_id, $module_id)
    {
        $module = Module::find($module_id);
        return view('courses.module.edit', compact('module'));
    }


    public function update(Request $request, $id)
    {
        $module = Module::find($id);

        $request->validate([
            'name' => 'required|min:5|max:255',
        ]);

        if ($request->file('image')) {

            $image = Storage::disk()->exists($module->image);
            if ($image) {
                Storage::delete($module->image);
            }

            $file = $request->file('image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                Auth::user()->tenant->subdomain . '/images/courses/modules',
                $filename
            );

            $module->image = $path;
        }

        $module->name = $request->name;
        $module->save();
        return redirect()->route('courses.show', $request->course_id);
    }


    public function destroy($id)
    {
        $module = Module::find($id);
        $image = Storage::disk()->exists($module->image);
        if ($image) {
            Storage::delete($module->image);
        }
        $module->delete();
        return redirect()
            ->route('courses.show', $module->course->id)
            ->withSuccess('Módulo deletado com sucesso!');
    }
}
