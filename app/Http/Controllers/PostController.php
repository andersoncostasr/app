<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Tenant\ManagerTenant;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    public function index()
    {
        $posts = $this->post->get();
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        // dd(config('filesystem.disks.tenant.root'));

        return view('posts.create');
    }


    public function store(StoreUpdatePostRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = Str::kebab($request->title);
            $extension = $request->image->extension();
            $nameImage = "{$name}.$extension";
            $data['image'] = $nameImage;

            // $upload = $request->image->storeAs('tenants/' . \app(ManagerTenant::class)->getTenant()->uuid . '/posts', $nameImage);
            $upload = $request->image->storeAs('posts', $nameImage);


            if (!$upload)
                return redirect()->back()->with('errors', ['Falha no Upload']);
        }

        $post = $request->user()
            ->posts()
            ->create($data);

        return redirect()
            ->back()
            ->withSuccess('Post Cadastrado com Sucesso!');
    }


    public function show($id)
    {
        return $id;
    }


    public function edit($id)
    {
        $post = $this->post->find($id);

        return view('posts.edit', compact('post'));
    }


    public function update(StoreUpdatePostRequest $request, $id)
    {
        $post = $this->post->find($id);
        $post->update($request->all());

        return redirect()
            ->back()
            ->withSuccess('Post Atualizado com Sucesso!');
    }


    public function destroy($id)
    {
        //
    }
}
