<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    public function store(Request $request)
    {
        $module = new Module;
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
        $module->name = $request->name;
        $module->save();
        return redirect()->route('courses.show', $request->course_id);
    }


    public function destroy($id)
    {
        $module = Module::find($id);
        $module->delete();
        return redirect()
            ->route('courses.show', $module->course->id)
            ->withSuccess('Módulo deletado com sucesso!');
    }
}
