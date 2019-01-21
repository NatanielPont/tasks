@extends('layouts.login')

@section('title')
    Login a l'aplicació de Tasks
@endsection
@section('content')
    
    <v-content>
        {{--@if ($errors->any())--}}
            {{--<v-alert--}}
                    {{--:value="true"--}}
                    {{--type="error"--}}
            {{-->--}}
                {{--<ul>--}}
                    {{--@foreach ($errors->all() as $error)--}}
                        {{--<li>{{ $error }}</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</v-alert>--}}
        {{--@endif--}}
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">
                        <v-toolbar dark color="primary" >
                            <v-toolbar-title>Reseting password. Put e-mail account.</v-toolbar-title>
                        </v-toolbar>
                        <v-form method="POST" action="{{ route('password.email') }}" >
                                {{--action="{{ route('password.email') }}"--}}
                            @csrf

                            {{--<div class="form-group row m-2">--}}

                            {{--<div class="">--}}

                            <v-text-field
                            id="email" type="email" class="block form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required
                            placeholder="Email"
                            single-line
                            box
                            ></v-text-field>
                            {{--@if ($errors->has('email'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('email') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <v-btn color="accent" flat type="submit" class="mt-3" >
                            Done
                            </v-btn>

                            {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </v-form>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
@endsection

{{--<form method="POST" action="{{ route('password.email') }}">--}}
    {{--@csrf--}}

    {{--<div class="form-group row m-2">--}}

    {{--<div class="">--}}
        {{--<v-flex  >--}}

        {{--<v-text-field--}}
                {{--id="email" type="email" class="block form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required--}}
                {{--placeholder="Email"--}}
                {{--single-line--}}
                {{--box--}}
        {{--></v-text-field>--}}
        {{--</v-flex>--}}
        {{--<input color="accent" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>--}}

        {{--@if ($errors->has('email'))--}}
            {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
        {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row mb-0">--}}
        {{--<div class="col-md-6 offset-md-4">--}}
            {{--<v-btn color="accent" flat type="submit" class="mt-3" >--}}
                {{--{{ __('Send Password Reset Link') }}--}}
            {{--</v-btn>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</form>--}}
