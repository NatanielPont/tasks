<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Tasques</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

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
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            <h1>Tasques</h1>
            <ul>
                {{--@foreach ($tasks as $task)--}}
                    {{--<li>{{ $task->name }} <button>Completar</button>--}}
                        {{--<a href="/task_edit/{{ $task->id }}">--}}
                            {{--<button>Modificar</button>--}}
                        {{--</a>--}}

                        {{--<form action="/tasks/{{ $task->id }}" method="POST">--}}
                            {{--@csrf--}}
                            {{--{{ method_field('DELETE') }}--}}
                            {{--<button>Eliminar</button>--}}
                        {{--</form>--}}
                    {{--</li>--}}
                {{--@endforeach--}}
            @foreach ($tasks as $task)
                <li>This is task {{ $task->name }} ~|~ completed : {{ $task->completed }}</li>
                    <button>Completar</button>
                <a href="/task_edit/{{ $task->id }}">
                    <button>Modificar</button>
                </a>
                    <form action="/tasks/{{$task->id}}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                    <button>Eliminar</button>
                    </form>
            @endforeach
            </ul>

        </div>
        <div id="formulari">
            <form action="/tasks" method="POST">
                @csrf
                <input name="name" type="text" placeholder="nova tasca">
                <button>Afegir</button>
            </form>

        </div>

        <!--<div class="links">
            <a href="https://laravel.com/docs">Documentation</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://nova.laravel.com">Nova</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>-->
    </div>
</div>
</body>
</html>
