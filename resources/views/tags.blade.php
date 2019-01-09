@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <tasques :tasks="{{ $tags }}" ></tasques>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
