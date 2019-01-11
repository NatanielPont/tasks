@extends('layouts.app')
@section('title')
    Tasques
@endsection

@section('content')

    <v-card v-cloak>


        <v-toolbar color="cyan" dark class="toolTitle" >

            <v-toolbar-title >Tasques</v-toolbar-title>
            {{--<v-toolbar-content style="display: block;height: 64px;text-align: center;padding-top: 15px;">--}}

            {{--</v-toolbar-content>--}}

        </v-toolbar>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md5>
                <v-list>
                    <?php foreach ($tasks as $task) : ?>

                    <v-list-tile>

                        <v-list-tile-avatar>
                            <img src="https://placeimg.com/100/100/any">
                        </v-list-tile-avatar>
                        @if($task->completed)
                            <v-layout row justify-center >
                                <v-flex xs8 mt-3>
                                    <del><h5>{{ $task->name }}</h5></del>

                                </v-flex>
                                <v-layout justify-space-between>
                                    <v-layout justify-end>

                                    <v-flex xs>
                                        <form action="completed_task/{{ $task->id }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="id" value="{{ $task->id  }}">
                                            <v-btn type="submit" color="warning">
                                                Descompletar
                                            </v-btn>
                                        </form>
                                    </v-flex>
                                    <v-flex xs >
                                        <form action="/tasks/{{ $task->id }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <v-btn type="submit" color="error">
                                                Eliminar
                                            </v-btn>
                                        </form>
                                    </v-flex>
                                    </v-layout>
                                </v-layout>

                            </v-layout>
                            {{--<v-flex xs3>--}}
                            {{--<del>{{ $task->name }}</del>--}}
                            {{--</v-flex>--}}
                        {{--<v-layout>--}}

                            {{--<v-flex xs7 >--}}

                                {{--<div class="btn-group" >--}}
                                    {{--<form action="completed_task/{{ $task->id }}" method="POST">--}}
                                        {{--@csrf--}}
                                        {{--{{ method_field('DELETE') }}--}}
                                        {{--<input type="hidden" name="id" value="{{ $task->id  }}">--}}
                                        {{--<v-btn type="submit" color="warning">--}}
                                           {{--Descompletar--}}
                                        {{--</v-btn>--}}
                                    {{--</form>--}}
                                    {{--<form action="/tasks/{{ $task->id }}" method="POST">--}}
                                        {{--@csrf--}}
                                        {{--{{ method_field('DELETE') }}--}}
                                        {{--<v-btn type="submit" color="error">--}}
                                            {{--Eliminar--}}
                                        {{--</v-btn>--}}
                                    {{--</form>--}}


                                {{--</div>--}}
                            {{--</v-flex>--}}
                        {{--</v-layout>--}}


                        @else
                            <v-layout row justify-center >
                                <v-flex xs9 mt-3>
                                        <h5>{{ $task->name }}</h5>
                                </v-flex>
                                <v-layout justify-end>
                                    <v-layout justify-space-between>

                                    <v-flex xs>
                                        <form action="completed_task/{{ $task->id }}" method="POST">
                                            @csrf
                                            {{ method_field('POST') }}
                                            <input type="hidden" name="id" value="{{ $task->id  }}">
                                            <v-btn type="submit" color="warning">
                                                Completar
                                            </v-btn>
                                        </form>
                                    </v-flex>

                                    <v-flex xs>
                                        <v-btn type="submit" color="warning" name="submit" value="Update" href="#"
                                               data-toggle="modal"
                                               data-target="#create-{{$task->id}}">
                                            Modificar
                                        </v-btn>
                                    </v-flex>
                                    <v-flex xs>
                                        <form action="/tasks/{{ $task->id }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <v-btn type="submit" color="error">
                                                Eliminar
                                            </v-btn>
                                        </form>
                                    </v-flex>
                                    </v-layout>
                                </v-layout>

                            </v-layout>
                            {{--<v-flex xs3 style="margin-right: 100px;">--}}

                            {{--<h5>{{ $task->name }}</h5>--}}

                            {{--</v-flex>--}}
                            {{--<v-flex xs7>--}}

                        {{--<div class="btn-group"  >--}}
                            {{--<form action="completed_task/{{ $task->id }}" method="POST">--}}
                                {{--@csrf--}}
                                {{--{{ method_field('POST') }}--}}
                                {{--<input type="hidden" name="id" value="{{ $task->id  }}">--}}
                                {{--<v-btn type="submit" color="warning">--}}
                                    {{--Completar--}}
                                {{--</v-btn>--}}
                            {{--</form>--}}
                            {{--<form action="/tasks/{{ $task->id }}" method="POST">--}}
                                {{--@csrf--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--<v-btn type="submit" color="error">--}}
                                    {{--Eliminar--}}
                                {{--</v-btn>--}}
                            {{--</form>--}}
                            {{--<v-btn type="submit" color="warning" name="submit" value="Update" href="#"--}}
                                   {{--data-toggle="modal"--}}
                                   {{--data-target="#create-{{$task->id}}">--}}
                                {{--Modificar--}}
                            {{--</v-btn>--}}


                        {{--</div>--}}
                            {{--</v-flex>--}}



                        @endif
                    </v-list-tile>
                    @include('task_edit')
                    <?php endforeach;?>


                    <form action="/tasks" method="POST" align="center">
                        @csrf
                        <input name="name" type="text" placeholder="Nova tasca (max. 25 ctrs)" required>
                        <v-btn color="success">
                            <button>Afegir</button>
                        </v-btn>
                    </form>
                </v-list>
            </v-flex>
        </v-layout>


    </v-card>


@endsection

<style>
    .toolTitle > div.v-toolbar__content {
        display: block;
        padding-top: 15px;
        text-align: center;
    }
</style>

