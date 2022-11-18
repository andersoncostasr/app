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
<form action="{{ route('users.update', $user->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nome do Usuário</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg round" placeholder="João da Silva" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">E-mail</label>
                            <input type="text" name="email" id="email" class="form-control form-control-lg round" placeholder="joao@email.com" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg round" placeholder="********" value="">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <div class="checkbox">
                                    <input name="isAdmin" type="checkbox" id="isAdmin" class="form-check-input" value="{{ $user->isAdmin }}" {{ $user->isAdmin == 1 ? ' checked' : '' }}>
                                    <label for="isAdmin">Usuário é Admin?</label>
                                    <br>
                                    <small>Marque essa opção caso queira que seu usuário tenha acesso ao Admin.
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <div class="form-group">
                                <a href="{{ route('users.destroy', $user->id) }}" class='btn btn-outline-danger rounded-pill' onclick="event.preventDefault(); document.getElementById('destroy-user').submit();">
                                    Deletar
                                </a>
                                <a href="{{ route('users.index') }}" class="btn btn-light rounded-pill">Cancelar</a>
                                <button type="submit" class="btn btn-primary rounded-pill">Atualizar Usuário</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
<form id="destroy-user" action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection
