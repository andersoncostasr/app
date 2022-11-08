@extends('layouts.default')

@section('title')
    Cursos <a href="{{ route('courses.create') }}" class="btn btn-primary rounded-pill">Adicionar Curso</a>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('message'))
        <div class="alert alert-warning">{{ session('message') }}</div>
    @endif
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-content">
                        <a href="{{ route('courses.show', $course->id) }}">
                            @if ($course->image)
                                <img src="{{ asset('images/courses/' . Auth::user()->tenant_id . '/' . $course->image) }}"
                                    class="card-img-top img-fluid" alt="{{ $course->name }}">
                            @else
                                <img src="{{ asset('images/courses/no-image.png') }}" class="card-img-top img-fluid"
                                    alt="singleminded">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <p class="card-text">
                                    {{ $course->description }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
