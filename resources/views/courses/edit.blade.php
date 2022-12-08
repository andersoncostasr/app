@extends('layouts.default')

@section('title')
Editar Curso
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>
            <div class="alert alert-danger">{{ $error }}</div>
        </li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('courses.update', $course->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nome do Curso</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg round" placeholder="Ex: Fundamentos do Copywriter" value="{{ $course->name }}">
                        </div>
                        <div class="form-group mb-3 mt-5">
                            <label for="description" class="form-label">Descreva sobre o que é o Curso</label>
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Tudo que você precisa saber sobre copywriting e faturar muito com textos.">{{ $course->description }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="category">Categoria</label>
                            <select name="category_id" class="form-control form-control-lg round" id="category">
                                <option selected value="{{ $course->category->id }}">{{ $course->category->name }}</option>
                                @php
                                $array = [$course->category->id];
                                @endphp
                                @foreach ($categories as $category)
                                @if (!in_array($category->id, $array))
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-content">
                    @if ($course->image)
                    <img src="{{ asset(env('AWS_BUCKET_URL') . $course->image) }}" class="card-img-top img-fluid mb-3" alt="{{ $course->name }}">
                    @else
                    <img src="{{ env('AWS_IMAGE_DEFAULT') }}" class="card-img-top img-fluid mb-3" alt="no-image">
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image" class="form-label">Imagem de Capa</label>
                            <input name="image" class="form-control form-control-lg" id="image" type="file">
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-check">
                                <div class="checkbox">
                                    <input name="available" type="checkbox" id="available" class="form-check-input" value="{{ $course->available }}" {{ $course->available == 1 ? ' checked' : '' }}>
                                    <label for="available">Curso Disponível</label>
                                    <br>
                                    <small>Desmarque essa opção caso não queira seu curso publicado agora.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="">
            <div class="form-group">
                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-light rounded-pill">Cancelar</a>
                <button type="submit" class="btn btn-primary rounded-pill">Próxima Etapa</button>
            </div>
        </div>
    </div>

</form>
@endsection
