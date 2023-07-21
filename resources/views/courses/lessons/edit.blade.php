@extends('layouts.default')

@section('title')
Editar Aula - <span>{{ $lesson->name }}</span>
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
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
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-content">
                <form action="{{ route('lessons.update', $lesson->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($lesson->image)
                    <img src="{{ asset(env('AWS_BUCKET_URL') . $lesson->image) }}" class="card-img-top img-fluid mb-3" alt="{{ $lesson->name }}">
                    @else
                    <img src="{{ env('AWS_IMAGE_DEFAULT') }}" class="card-img-top img-fluid mb-3" alt="no-image">
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image" class="form-label">Imagem da Aula</label>
                            <input name="image" class="form-control form-control-lg" id="image" type="file">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Nome da Aula</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg round" placeholder="Ex: Aula 01" value="{{ $lesson->name }}">
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label" for="module">Módulo</label>
                            <select name="module_id" class="form-control form-control-lg round" id="modulo">
                                <option selected value="{{ $lesson->module->id }}">{{ $lesson->module->name }}</option>
                                @php
                                $array = [$lesson->module->id];
                                @endphp
                                @foreach ($lesson->module->course->modules as $module)
                                @if (!in_array($module->id, $array))
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label" for="name">URL</label>
                            <input type="text" name="url" id="url" class="form-control form-control-lg round" placeholder="https://google.com.br" value="{{ $lesson->url }}">
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label" for="name">Vídeo</label>
                            <input type="text" name="video" id="video" class="form-control form-control-lg round" placeholder="ydfrewplki" value="{{ $lesson->video }}">
                        </div>


                        <div class="form-group mb-3 mt-3">
                            <label for="description" class="form-label">Descreva a sua aula</label>
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Tudo que você precisa saber sobre copywriting e faturar muito com textos.">{{ $lesson->description }}</textarea>
                        </div>
                        <a href="{{ route('lessons.destroy', $lesson->id) }}" class='btn btn-outline-danger rounded-pill' onclick="event.preventDefault(); document.getElementById('destroy-lesson').submit();">
                            Deletar
                        </a>
                        <a href="{{ route('courses.show', $lesson->module->course->id) }}" class="btn btn-outline-primary rounded-pill">Voltar</a>
                        <button type="submit" class="btn btn-primary rounded-pill">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form id="store-attacchement" action="{{ route('attacchment.store', $lesson->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nome do Anexo</label>
                            <input name="name" class="form-control form-control-lg" id="name" type="text" placeholder="Pdf da Aula">
                        </div>
                        <div class="form-group">
                            <label for="attacchment" class="form-label">Inserir Anexo</label>
                            <input name="attacchment" class="form-control form-control-lg" id="image" type="file">
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill mt-3">Enviar Anexo</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="list-group">
                        @forelse($lesson->attacchments as $attacchment)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <a target="_blank" href="{{ asset(env('AWS_BUCKET_URL') . $attacchment->path) }}">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                {{ $attacchment->name }}
                            </span>
                            <span class="badge bg-danger badge-pill badge-round ml-1">
                                <a class="link-remover" href="{{ route('attacchment.destroy', $attacchment->id) }}" onclick="event.preventDefault(); document.getElementById('destroy-attacchement-{{ $attacchment->id }}').submit();">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                                <form id="destroy-attacchement-{{ $attacchment->id }}" action="{{ route('attacchment.destroy', $attacchment->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </span>
                        </li>
                        @empty
                        <p class="mb-0">Nenhum Anexo</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="destroy-lesson" action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('css')
<style>
    .link-remover {
        color: #fff;
    }

    .link-remover::hover {
        color: #fff;
    }

</style>
@endpush
