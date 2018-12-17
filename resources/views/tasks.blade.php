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
                            <v-flex xs3>
                            <del>{{ $task->name }}</del>
                            </v-flex>
                            <v-flex xs7>

                                <div class="btn-group"  >
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


                                </div>
                            </v-flex>


                        @else
                            <v-flex xs3>

                            <h5>{{ $task->name }}</h5>

                            </v-flex>
                            <v-flex xs7>

                        <div class="btn-group"  >
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
                            <v-btn color="warning" >
                                <button name="submit" value="Update" href="#"
                                        data-toggle="modal"
                                        data-target="#create-{{$task->id}}"
                                >Modificar
                                </button>
                            </v-btn>


                        </div>
                            </v-flex>



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

