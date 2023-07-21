@extends('layouts.default')

@section('title')
Payloads <a data-bs-toggle="modal" data-bs-target="#type" href="{{ route('webhooks.index') }}" class="btn btn-primary rounded-pill">Voltar</a>
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
                                    <th>Url</th>
                                    <th>Recebido</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($webhook->payloads as $payload)
                                <tr>
                                    <th>{{$payload->webhook->name}}</th>
                                    <th><input disabled type="text" class="form-control" value="{{ route('webhook.guru', $payload->webhook->id)}}"></input></th>
                                    </th>
                                    <th>{{$payload->webhook->created_at}}</th>
                                    <th style="max-height: 100px;">{{$payload->data}}</th>
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


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="type" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Escolha a Plataforma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <a href="{{ route('webhooks.create', ['type' => 'guru']) }}">Guru Manager</a>
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
