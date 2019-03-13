<!doctype html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="manifest" href="/manifest.json">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/icons/favicon-16x16.png">
    <link rel="mask-icon" href="/img/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#5bbad5">
    <meta name="theme-color" content="#5bbad5">

    <script defer src="{{ mix('/js/manifest.js') }}"></script>
    <script defer src="{{ mix('/js/vendor.js') }}"></script>
    <script defer src="{{ mix('/js/app.js') }}"></script>

    <title>@yield('title', 'Landing')</title>

    <style>
        [v-cloak] {display: none}
    </style>
</head>
<body>

<v-app id="app" v-cloak>

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
    <service-worker></service-worker>
    <v-footer color="indigo" app>
        <span class="white--text">Created by Nataniel Pont Castells, &copy; 2018 All rights reserved</span>
    </v-footer>
</v-app>
</body>
</html>
