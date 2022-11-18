@extends('layouts.default')

@section('title')
Posts
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ route('posts.create') }}">Add</a>
        @foreach ($posts as $post)
        <p>{{ $post->title }}</p>
        <a href="{{ route('posts.edit', $post->id) }}">Editar</a>
        <hr>
        @endforeach
    </div>
</div>
@endsection