@extends('layouts.default')

@section('title')
Novo Usuário
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
<form action="{{ route('categories.store') }}" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nome da Categoria</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg round" placeholder="Comece Aqui">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">Descrição</label>
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Aprenda o passo a passo para iniciar!"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Ordem da Categoria</label>
                            <input type="text" name="order" id="order" class="form-control form-control-lg round" placeholder="0" value="0">
                        </div>
                        <div class="mt-5">
                            <div class="form-group">
                                <a href="{{ route('categories.index') }}" class="btn btn-light rounded-pill">Cancelar</a>
                                <button type="submit" class="btn btn-primary rounded-pill">Criar Categoria</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
