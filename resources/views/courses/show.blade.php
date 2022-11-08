@extends('layouts.default')

@section('title')
    Gestão do Curso
    <div class="btn-group mb-1">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opções
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                <a href="{{ route('courses.edit', $course->id) }}" class="dropdown-item">Editar
                    Curso</a>
                <a href="{{ route('courses.edit', $course->id) }}" class="dropdown-item">Adicionar
                    Módulo</a>
                <a href="{{ route('courses.destroy', $course->id) }}" class='dropdown-item'
                    onclick="event.preventDefault(); document.getElementById('destroy-form').submit();">
                    Deletar
                </a>
                <form id="destroy-form" action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        {{ $course->name }}
        {{ $course->description }}
    </div>
@endsection
