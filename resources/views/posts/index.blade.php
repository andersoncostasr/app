@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Posts</h1>
                <a href="{{ route('posts.create') }}">Add</a>
                @foreach ($posts as $post)
                    <p>{{ $post->title }}</p>
                    <a href="{{ route('posts.edit', $post->id) }}">Editar</a>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection
