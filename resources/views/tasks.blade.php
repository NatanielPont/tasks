@extends('layouts.app')
@section('content')
    {{--@if (Route::has('login'))--}}
        {{--<div class="top-right links">--}}
            {{--@auth--}}
                {{--<a href="{{ url('/home') }}">Home</a>--}}
            {{--@else--}}
                {{--<a href="{{ route('login') }}">Login</a>--}}
                {{--<a href="{{ route('register') }}">Register</a>--}}
            {{--@endauth--}}
        {{--</div>--}}
    {{--@endif--}}

    <div class="content">
        <div class="title m-b-md">
            <h1>Tasques</h1>
            <ul>
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
    @endsection
