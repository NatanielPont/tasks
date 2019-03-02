@extends('layouts.app')
@section('title')
    Tasques
@endsection
<style>
    [v-cloak] {display: none}
</style>
@section('content')
    <v-container grid-list-md text-xs-center id="tasks" class="tasks" fill-height >
        <v-layout row wrap>
            <v-flex xs12 >

            <v-card v-cloak>


            <v-toolbar color="grey darken-4" dark class="toolTitle" >

                <v-toolbar-title >Tasques</v-toolbar-title>
            </v-toolbar>
            {{--<v-layout row wrap>--}}
                {{--<v-flex >--}}
                    <v-list style="
    background-color: grey;
">
                        <?php foreach ($tasks as $task) : ?>

                        <v-list-tile class="mb-3">

                            <v-list-tile-avatar>
                                <img src="https://placeimg.com/100/100/any">
                            </v-list-tile-avatar>
                            @if($task['completed'])
                                {{--<v-layout row >--}}


                                    <v-flex xs12 mt-2>

                                            <v-card dark color="primary">
                                        <del><h5>{{ $task['name'] }}</h5></del>

                                            </v-card>
                                        <v-layout justify-end>

                                            <v-btn-toggle >

                                                <form action="completed_task/{{ $task['id'] }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <input type="hidden" name="id" value="{{ $task['id']  }}">
                                                    <v-btn type="submit" color="success darken-3" small  >
                                                        Descompletar
                                                    </v-btn>
                                                </form>
                                                <form action="/tasks/{{ $task['id'] }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <v-btn type="submit" color="error darken-3" small flat>
                                                        Eliminar
                                                    </v-btn>
                                                </form>
                                            </v-btn-toggle>
                                        </v-layout>
                                    </v-flex>


                            @else
                                    <v-flex xs12 mt-2>

                                        <v-card dark color="primary">
                                            <h5>{{ $task['name'] }}</h5>

                                        </v-card>
                                        <v-layout justify-end>
                                                <v-btn-toggle>
                                                    <form action="completed_task/{{ $task['id'] }}" method="POST">
                                                        @csrf
                                                        {{ method_field('POST') }}
                                                        <input type="hidden" name="id" value="{{ $task['id']  }}">
                                                        <v-btn type="submit" color="success darken-4" small flat>
                                                            Completar
                                                        </v-btn>
                                                    </form>
                                                    <v-btn type="submit" color="accent darken-3" name="submit" value="Update" href="#"
                                                           data-toggle="modal"
                                                           data-target="#create-{{$task['id']}}" small flat>
                                                        Modificar
                                                    </v-btn>
                                                    <form action="/tasks/{{ $task['id'] }}" method="POST">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <v-btn type="submit" color="error darken-3" small flat>
                                                            Eliminar
                                                        </v-btn>
                                                    </form>
                                                </v-btn-toggle>
                                        </v-layout>
                                    </v-flex>

                            @endif
                        </v-list-tile>
                        @include('task_edit')
                        <?php endforeach;?>


                        <form action="/tasks" method="POST" align="center" class="mb-5">
                            @csrf
                            <input name="name" type="text"  placeholder="Nova tasca (max. 25 ctrs)" required>
                            <v-btn color="primary">
                                <button>Afegir</button>
                            </v-btn>
                        </form>
                    </v-list>


        </v-card>
            </v-flex>

        </v-layout>
    </v-container>




@endsection

<style>
    .toolTitle > div.v-toolbar__content {
        display: block;
        padding-top: 15px;
        text-align: center;
    }
</style>

