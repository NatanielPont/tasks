@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <clock></clock>
                {{--<tags :tags="{{ $tags }}" uri="{{$uri}}"></tags>--}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection
