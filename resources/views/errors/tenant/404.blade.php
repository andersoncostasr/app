<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/main/app.css') }}">
    <link rel="stylesheet" href="assets/css/pages/error.css" />
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
    <style>
        #error {
            background-color: #ebf3ff;
            min-height: 100vh;
            padding: 2rem 0
        }

        #error .img-error {
            height: 435px;
            -o-object-fit: contain;
            object-fit: contain;
            padding: 3rem 0
        }

        #error .error-title {
            font-size: 3rem;
            margin-top: 1rem
        }

        body.theme-dark #error {
            background-color: #151521
        }
    </style>
</head>

<body>
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="text-center">
                    <img class="img-error" src="{{ asset('images/samples/error-404.svg') }}" alt="Not Found" />
                    <h1 class="error-title">Página Não Encontrada</h1>
                    <p class="fs-5 text-gray-600">
                        O que você está procurando não foi encontrado.
                    </p>
                    <a href="http://app.test" class="btn btn-lg btn-outline-primary mt-3">Ir para a Home</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
