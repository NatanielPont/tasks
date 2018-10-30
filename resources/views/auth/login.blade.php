@extends('layouts.login')

@section('title')
    Login a l'aplicació de Tasks
@endsection
@section('content')
    <v-content>
        @if ($errors->any())
            <v-alert
                    :value="true"
                    type="error"
            >
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </v-alert>
        @endif
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">

{{--                        <login-form email={{old('email')}}></login-form>--}}
                        <login-form email="email" csrf-token>{{csrf_token()}}</login-form>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
@endsection
© 2018 GitHub, Inc.
Terms
Privacy
Security
Status
Help
Contact GitHub
Pricing
API
Training
Blog
About
Press h to open a hovercard with more details.