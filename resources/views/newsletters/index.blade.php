@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <newsletters :newsletter="{{ $newsletter }}"></newsletters>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
