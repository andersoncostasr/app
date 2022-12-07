@extends('layouts.default')

@section('title')
Categorias <a href="{{ route('categories.create') }}" class="btn btn-primary rounded-pill">Adicionar Categoria</a>
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
                                    <th>Descrição</th>
                                    <th>Data de Criação</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <th>{{ $category->name }}</th>
                                    <th>{{ $category->description }}</th>
                                    <th>{{ date('d/m/Y', strtotime($category->created_at)) }}</th>
                                    <th>
                                        <div class="">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
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
