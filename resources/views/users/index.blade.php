@extends('layouts.default')

@section('title')
    Usuários <a href="{{ route('users.create') }}" class="btn btn-primary rounded-pill">Adicionar Usuário</a>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('message'))
        <div class="alert alert-warning">{{ session('message') }}</div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Data de Criação</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th>{{ $user->name }}</th>
                                            <th>{{ $user->email }}</th>
                                            <th>{{ $user->created_at }}</th>
                                            <th>
                                                <div class="">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                                    <a href="#" class="btn icon btn-danger"><i
                                                            class="bi bi-x"></i></a>
                                                    <a href="#" class="btn icon btn-warning"><i
                                                            class="bi bi-star"></i></a>
                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        th {
            vertical-align: middle;
        }
    </style>
@endpush
