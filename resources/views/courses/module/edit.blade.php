@extends('layouts.default')

@section('title')
Gestão do Curso
<div class="btn-group mb-1">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle me-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opções
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
            <a href="{{ route('courses.edit', $module->course->id) }}" class="dropdown-item">Editar
                Curso</a>
            <a href="{{ route('courses.edit', $module->course->id) }}" class="dropdown-item">Adicionar
                Módulo</a>
            <a href="{{ route('courses.destroy', $module->course->id) }}" class='dropdown-item' onclick="event.preventDefault(); document.getElementById('destroy-form').submit();">
                Deletar
            </a>
            <form id="destroy-form" action="{{ route('courses.destroy', $module->course->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-5">
        <div class="card">
            <div class="card-content">
                @if ($module->course->image)
                <img src="{{ asset(env('AWS_BUCKET_URL') . $module->course->image) }}" class="card-img-top img-fluid" alt="{{ $module->course->name }}">
                @else
                <img src="{{env('AWS_IMAGE_DEFAULT')}}" class="card-img-top img-fluid" alt="no-image">
                @endif
                <div class="card-body">
                    <h4>{{ $module->course->name }}</h4>
                    <h6 class="card-subtitle mt-1 mb-3">{{$module->course->category->name}}</h6>
                    <p>{{ $module->course->description }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-7">
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
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('modules.update', $module->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="course_id" value="{{ $module->course->id }}">
                        <div class="form-group">
                            <label for="image" class="form-label">Imagem do Módulo</label>
                            <input name="image" class="form-control form-control-lg" id="image" type="file">
                        </div>
                        <label class="form-label" for="name">Editar Módulo</label>
                        <div class="input-group mb-3">
                            <input name="name" id="name" type="text" class="form-control form-control-lg" placeholder="Ex: Novo Módulo" aria-label="Nome do Novo Modulo" aria-describedby="button-addon2" value="{{ $module->name }}">
                            <button type="submit" class="btn btn-primary" type="button" id="button-addon2">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($module->course->modules as $module)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading{{ $module->id }}">
                                <button class="acc-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $module->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $module->id }}">

                                    <span class="title">
                                        @if ($module->image)
                                        <img style="width: 50px;" src="{{ asset(env('AWS_BUCKET_URL') . $module->image) }}" class="img-fluid" alt="{{ $module->name }}">
                                        {{ $module->name }}
                                        @else
                                        <img style="width: 50px;" src="{{ env('AWS_IMAGE_DEFAULT') }}" class="img-fluid" alt="no-image">
                                        {{ $module->name }}
                                        @endif
                                    </span>
                                    <span class="options">
                                        <div class="dropdown">
                                            <i class="bi bi-three-dots" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </i>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                <a id="redirectEdit-{{ $module->id }}" href="{{ route('modules.edit', [$module->course->id, $module->id]) }}" class="dropdown-item">Editar</a>

                                                <script>
                                                    $('#redirectEdit-{{ $module->id }}').click(function() {
                                                        window.location.href = $(this).attr('href');
                                                    })

                                                </script>

                                                <a href="{{ route('modules.destroy', $module->id) }}" class='dropdown-item' onclick="event.preventDefault(); document.getElementById('destroy-module-{{ $module->id }}').submit();">
                                                    Deletar
                                                </a>
                                                <form id="destroy-module-{{ $module->id }}" action="{{ route('modules.destroy', $module->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapse{{ $module->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $module->id }}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @foreach ($module->lessons as $lesson)
                                    {{ $lesson->name }}
                                    <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .accordion-body {
        color: #607080;
    }

    button.acc-btn {
        display: grid;
        grid-template-columns: 1fr max-content max-content;
        align-items: center;
        grid-gap: 10px;
    }

</style>
@endpush
