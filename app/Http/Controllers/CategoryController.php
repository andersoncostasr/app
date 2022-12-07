<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:100',
        ]);

        $data = $request->all();

        $category = new Category;
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->user_id = $data['user_id'];
        $category->save();

        return redirect()->route('categories.index')->withSuccess('Categoria criada com sucesso!');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5|max:100',
        ]);

        $data = $request->all();

        $category = Category::find($id);
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->user_id = $data['user_id'];
        $category->save();

        return redirect()->route('categories.index')->withSuccess('Categoria editada com sucesso!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()
            ->route('categories.index')
            ->withSuccess('Categoria deletada com sucesso!');
    }
}
