<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
    <style>
        .invalid-feedback {
            color: #dc3545;
            font-size: .875em;
            margin-top: 0.25rem;
            width: 100%;
            display: block !important;
        }
    </style>
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <img src="{{ asset('/images/logo/logo.svg') }}" alt="Logo">
                    </div>
                    <h1 class="auth-title"></h1>
                    <p class="auth-subtitle mb-5">Informe o seu Subdomínio</p>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                            </span>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('sub.verification') }}">
                        @csrf
                        @error('subdomain')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group mb-3">
                            <input type="text" name="subdomain" id="subdomain"
                                class="form-control form-control-xl @error('subdomain') is-invalid @enderror""
                                placeholder="empresa" value="{{ old('subdomain') }}">
                            <span class="input-group-text" id="basic-addon2">{{ env('CLEAR_APP_URL') }}</span>
                        </div>

                        <button type="submit"
                            class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Verificar</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>
