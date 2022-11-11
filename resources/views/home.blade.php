<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>

    <meta name="description"
        content="Mazer is a free Admin Dashboard Template that can help you develop faster. Made with Bootstrap 5. No jQuery dependency.">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/shared/iconly.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: url({{ asset('images/home/bg.svg') }}), white;
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            font-family: Lato;
        }

        .hero {
            padding: 5rem 0;
            min-height: 100vh;
        }

        .hero h1 {
            font-size: clamp(2rem, 3vw, 3rem);
        }

        .hero-text>*,
        .hero-image {
            animation: fadeSlideDown 1s forwards cubic-bezier(0, 0.55, 0.45, 1);
            opacity: 0;
        }

        .hero-text p {
            animation-delay: 100ms;
        }

        .hero-text .hero-cta {
            animation-delay: 200ms;
        }

        .hero-image {
            animation-delay: 300ms;
        }

        @media screen and (max-width: 768px) {
            .hero {
                padding-top: 2rem;
            }
        }

        @keyframes fadeSlideDown {
            from {
                transform: translateY(-2rem);
                opacity: 0;
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <div class="container">
                    <a class="navbar-brand me-auto" href="#">
                        <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Funcionalidades</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Preço</a>
                            </li>
                            <li class="nav-item">
                                @guest
                                    <a class="btn btn-outline-primary" href="{{ route('sub.login') }}">Login</a>
                                @else
                                    <a class="btn btn-outline-primary"
                                        href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                @endguest
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <section class="hero">
                <div class="hero-content">
                    <div class="hero-text text-center">
                        <h1 class='pt-5'>Tenha um App para Chamar de Seu</h1>
                        <p class='fs-5 mt-3'>Liberte-se das plataformas de terceiros e tenha um ecossistema próprio para
                            entrega dos seus conteúdos digitais.</p>
                        <div class="hero-cta">
                            <a href="#" class="btn btn-primary">Entrar em Contato</a>
                        </div>
                    </div>
                    <div class="hero-image d-flex justify-content-center mt-5">
                        <img src="{{ asset('images/home/hero.png') }}" class="col-md-8 col-12 mx-auto" alt="Demo Image">
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>
