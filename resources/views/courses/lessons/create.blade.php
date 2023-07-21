@extends('layouts.default')

@section('title')
Nova Aula - <span>{{ $course->name }}</span>
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
<form action="{{ route('lessons.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image" class="form-label">Imagem da Aula</label>
                            <input name="image" class="form-control form-control-lg" id="image" type="file">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Nome da Aula</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg round" placeholder="Ex: Aula 01">
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label" for="module">Módulo</label>
                            <select name="module_id" class="form-control form-control-lg round" id="modulo">
                                <option value="" disabled selected>Selecione o módulo</option>
                                @foreach ($course->modules as $module)
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label" for="name">URL</label>
                            <input type="text" name="url" id="url" class="form-control form-control-lg round" placeholder="https://google.com.br">
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label" for="name">Vídeo</label>
                            <input type="text" name="video" id="video" class="form-control form-control-lg round" placeholder="ydfrewplki">
                        </div>


                        <div class="form-group mb-3 mt-3">
                            <label for="description" class="form-label">Descreva a sua aula</label>
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Tudo que você precisa saber sobre copywriting e faturar muito com textos."></textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="checkbox">
                                        <input name="available" type="checkbox" id="available" class="form-check-input"
                                            value="1" checked>
                                        <label for="available">Permitir Comentários</label>
                                        <br>
                                        <small>Desmarque essa opção caso não queira comentários nessa aula.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <hr>
        <div class="">
            <div class="form-group">
                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-primary rounded-pill">Cancelar</a>
                <button type="submit" class="btn btn-primary rounded-pill">Salvar</button>
            </div>
        </div>
    </div>

</form>
@endsection
