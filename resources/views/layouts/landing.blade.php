<!doctype html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <style>
        [v-cloak] {display: none}
    </style>
</head>
<body>
<div id="app" v-cloak>

<v-content>
    <v-container fluid fill-height>
        <v-layout
                justify-center

        >
            <v-flex text-xs-center>
                @yield('content')
            </v-flex>
        </v-layout>
    </v-container>
</v-content>
<v-footer color="indigo" app>
    <span class="white--text">Created by Nataniel Pont Castells, &copy; 2018 All rights reserved</span>
</v-footer>


<script  src="{{mix('/js/app.js')}}"></script>

</div>
</body>
</html>
