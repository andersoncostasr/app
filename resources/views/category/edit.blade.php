@extends('layouts.default')

@section('title')
Editar Categoria
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
<form action="{{ route('categories.update', $category->id) }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nome da Categoria</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg round" placeholder="Comece Aqui" value="{{$category->name}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">Descrição</label>
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Aprenda o passo a passo para iniciar!">{{$category->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Ordem da Categoria</label>
                            <input type="text" name="order" id="order" class="form-control form-control-lg round" placeholder="0" value="{{$category->order}}">
                        </div>
                        <div class="mt-5">
                            <div class="form-group">
                                <a href="{{ route('categories.destroy', $category->id) }}" class='btn btn-outline-danger rounded-pill' onclick="event.preventDefault(); document.getElementById('destroy-category').submit();">
                                    Deletar
                                </a>
                                <a href="{{ route('categories.index') }}" class="btn btn-light rounded-pill">Cancelar</a>
                                <button type="submit" class="btn btn-primary rounded-pill">Atualizar Categoria</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
<form id="destroy-category" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('css')
<style>
    #order {
        max-width: 60px;
    }

</style>
@endpush
