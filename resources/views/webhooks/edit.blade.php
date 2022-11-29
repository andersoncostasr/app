@extends('layouts.default')

@section('title')
Integração Guru Manager
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
<form action="{{ route('webhooks.update', $webhook->id) }}" method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="type" value="{{$webhook->type}}">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nome da Configuração</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg round" value="{{$webhook->name}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Token {{$webhook->type}}</label>
                            <input type="text" name="token" id="token" class="form-control form-control-lg round" value="{{$webhook->token}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">ID da Oferta {{$webhook->type}}</label>
                            <input type="text" name="offer" id="offer" class="form-control form-control-lg round" value="{{$webhook->offer}}">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <div class="checkbox">
                                    <input name="available" type="checkbox" id="available" class="form-check-input" value="{{ $webhook->available }}" {{ $webhook->available == 1 ? ' checked' : '' }}>
                                    <label for="availavle">Webhook Ativo?</label>
                                    <br>
                                    <small>Marque essa opção caso queira que seu webhook esteja ativo a partir de agora.
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <div class="form-group">
                                <a href="{{ route('webhooks.destroy', $webhook->id) }}" class='btn btn-outline-danger rounded-pill' onclick="event.preventDefault(); document.getElementById('destroy-form').submit();">
                                    Deletar
                                </a>
                                <a href="{{ route('webhooks.index') }}" class="btn btn-light rounded-pill">Cancelar</a>
                                <button type="submit" class="btn btn-primary rounded-pill">Editar Integração</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="destroy-form" action="{{ route('webhooks.destroy', $webhook->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection
