<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agrégateur de flux RSS</title>

    <link rel="icon" type="image/png" href="img/favicon.png"/>

    <meta property="og:title" content="{{ config('app.name', 'Agrégateur de flux RSS') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://laravel.laurenceplatzer.com"/>
    <meta property="og:image" content="img/favicon.png"/>
    <meta property="og:image:width" content="256"/>
    <meta property="og:image:height" content="256"/>

    <meta property="og:description"
          content="Pour faire votre veille ou être à jour de vos blogs préférés, l'agrégateur de flux RSS est l'outil qu'il vous faut !"/>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            margin: 50px 0;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .explication {
            margin: 50px 0;
        }

        @media all and (max-width: 500px) {
            .content{
                margin: 0 10px;
            }
            .title{
                margin-top: 400px;
            }
            #titleApp {
                font-size: 40px;
            }
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/index') }}">Mes abonnements RSS</a>
            @else
                <a href="{{ route('login') }}">Se connecter</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">S'enregistrer</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
         <span id="titleApp">Agrégateur de flux RSS</span>  <br>
            <img src="img/favicon.png" alt="logo agrégateur flux RSS">
        </div>

        <div class="jumbotron-fluid">
            <div class="display-1">
                <div class="explication">
                    <h2 class="lead">Qu'est-ce qu'un agrégateur de flux RSS ?</h2>
                    <h4 class="text-justify">C'est un outil qui vous permet d'être informé·e des nouveaux contenus de
                        vos
                        sites préférés sans avoir à les consulter un par un, pour peu qu'ils aient un flux RSS.</h4>
                </div>
                <div class="explication">
                    <h2 class="lead">Comment l'utiliser ?</h2>
                    <h4 class="text-justify">Créez votre compte, et ajoutez les flux RSS de vos sites préférés ! Vous
                        pouvez même les organiser en catégories pour affiner votre veille.</h4>
                </div>
            </div>
        </div>
        <div class="links">
            <a href="/mentions-legales">Mentions légales</a>
            <a href="/politique-confidentialite">Politique de confidentialité</a>
            {{--                    <a href="https://laravel-news.com">News</a>--}}
            {{--                    <a href="https://blog.laravel.com">Blog</a>--}}
            {{--                    <a href="https://nova.laravel.com">Nova</a>--}}
            {{--                    <a href="https://forge.laravel.com">Forge</a>--}}
            {{--                    <a href="https://vapor.laravel.com">Vapor</a>--}}
            {{--                    <a href="https://github.com/laravel/laravel">GitHub</a>--}}
        </div>
        {{--        <div class="col text-center"><a href="/mentionslegales">Mentions légales</a></div>--}}
        {{--        <div class="col text-center"><a href="/politique-confidentialite">Politique de confidentialité</a>--}}

    </div>
</div>

@section('footer')
    @include('footer')
@endsection

</body>
</html>



