@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <h1>Cadastrar Post</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="text" name="title" placeholder="Título">
                    </div>
                    <br>
                    <div class="form-group">
                        <input class="form-control" type="file" name="image" placeholder="Imagem">
                    </div>
                    <br>
                    <div class="form-group">
                        <textarea class="form-control" name="body" cols="30" rows="5" placeholder="Corpo do Post"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
