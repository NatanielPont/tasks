@extends('layouts.app')
@section('title')
    Tasques
@endsection
<style>
    [v-cloak] {display: none}
</style>
@section('content')
        <v-card v-cloak>


            <v-toolbar color="grey darken-1" dark class="toolTitle" >

                <v-toolbar-title >Tasques</v-toolbar-title>
            </v-toolbar>
            <v-layout>
                <v-flex xs7>
                    <v-list>
                        <?php foreach ($tasks as $task) : ?>

                        <v-list-tile>

                            <v-list-tile-avatar>
                                <img src="https://placeimg.com/100/100/any">
                            </v-list-tile-avatar>
                            @if($task['completed'])
                                <v-layout row >

                                    <v-flex xs7 mt-3>
                                        <del><h5>{{ $task['name'] }}</h5></del>

                                    </v-flex>
                                        <v-layout>

                                            <v-btn-toggle >

                                                <form action="completed_task/{{ $task['id'] }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <input type="hidden" name="id" value="{{ $task['id']  }}">
                                                    <v-btn type="submit" color="success darken-3" flat >
                                                        Descompletar
                                                    </v-btn>
                                                </form>
                                                <form action="/tasks/{{ $task['id'] }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <v-btn type="submit" color="error darken-3" flat>
                                                        Eliminar
                                                    </v-btn>
                                                </form>
                                            </v-btn-toggle>

                                        </v-layout>

                                </v-layout>
                            @else
                                <v-layout row >

                                    <v-flex xs3 mt-3>
                                        <h5>{{ $task['name'] }}</h5>
                                    </v-flex>
                                    <v-layout >
                                        <v-layout justify-center>
                                            <v-flex xs12 sm4 class="py-2">
                                                <v-btn-toggle>
                                                    <form action="completed_task/{{ $task['id'] }}" method="POST">
                                                        @csrf
                                                        {{ method_field('POST') }}
                                                        <input type="hidden" name="id" value="{{ $task['id']  }}">
                                                        <v-btn type="submit" color="success darken-4" flat>
                                                            Completar
                                                        </v-btn>
                                                    </form>
                                                    <v-btn type="submit" color="accent darken-3" name="submit" value="Update" href="#"
                                                           data-toggle="modal"
                                                           data-target="#create-{{$task['id']}}" flat>
                                                        Modificar
                                                    </v-btn>
                                                    <form action="/tasks/{{ $task['id'] }}" method="POST">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <v-btn type="submit" color="error darken-3" flat>
                                                            Eliminar
                                                        </v-btn>
                                                    </form>
                                                </v-btn-toggle>
                                            </v-flex>

                                        </v-layout>
                                    </v-layout>

                                </v-layout>
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

