@extends('layouts.app')
@section('title')
    Tasques
@endsection

@section('content')

    <v-card v-cloak>


        <v-toolbar color="cyan" dark>

            <v-toolbar-title>Tasques</v-toolbar-title>

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
                            <del>{{ $task->name }}</del>

                            <form action="completed_task/{{ $task->id }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="id" value="{{ $task->id  }}">
                                <v-btn color="warning">
                                    <button>Descompletar</button>
                                </v-btn>
                            </form>
                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <v-btn color="error">
                                    <button>Eliminar</button>
                                </v-btn>
                            </form>

                        @else
                            {{ $task->name }}
                            <form action="completed_task/{{ $task->id }}" method="POST">
                                @csrf
                                {{ method_field('POST') }}
                                <input type="hidden" name="id" value="{{ $task->id  }}">
                                <v-btn color="warning">
                                    <button>Completar</button>
                                </v-btn>
                            </form>
                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <v-btn color="error">
                                    <button>Eliminar</button>
                                </v-btn>
                            </form>
                                <button name = "submit" value = "Update"  href="#" class="btn btn-primary btn-lg" data-toggle="modal"
                                          data-target="#create-{{$task->id}}"
                                        >Modificar
                                </button>



                        @endif
                    </v-list-tile>
                    @include('task_edit')
                    <?php endforeach;?>



                    <form action="/tasks" method="POST" align="center">
                        @csrf
                        <input name="name" type="text" placeholder="Nova tasca (max. 20 ctrs)" required>
                        <v-btn color="success">
                            <button>Afegir</button>
                        </v-btn>
                    </form>
                </v-list>
            </v-flex>
        </v-layout>



    </v-card>


@endsection

