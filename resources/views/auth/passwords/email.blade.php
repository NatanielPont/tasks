@extends('layouts.login')

@section('title')
    Login a l'aplicació de Tasks
@endsection
@section('content')

    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">
                        <v-toolbar dark color="primary" >
                            <v-toolbar-title>Reseting password. Put e-mail account.</v-toolbar-title>
                        </v-toolbar>
                        <v-form method="POST" action="{{ route('password.email') }}" >
                            @csrf



                            <v-text-field
                            id="email" type="email" class="block form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required
                            placeholder="Email"
                            single-line
                            box
                            ></v-text-field>

                            <v-btn color="accent" flat type="submit" class="mt-3" >
                            Done
                            </v-btn>

                        </v-form>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
@endsection
