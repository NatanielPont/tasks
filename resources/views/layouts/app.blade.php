<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="user" content="{{ logged_user() }}">
    <meta name="git" content="{{ git() }}">

    <meta name="impersonatedBy" content="{{ Auth::user()->impersonatedBy() }}">


    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#2680C2"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta property="og:image" href="/img/shareImg.jpg">
    <meta property="og:image:width" content="439">
    <meta property="og:image:height" content="659">
    <meta property="og:title" content="Application Tasks">
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="Description tasks">
    <meta property="og:url" content="https://tasks.natanielpont.scool.cat/">
    @stack('beforeScripts')

    <script defer src="{{ mix('/js/manifest.js') }}"></script>
    <script defer src="{{ mix('/js/vendor.js') }}"></script>
    <script defer src="{{ mix('/js/app.js') }}"></script>
    @stack('afterScripts')

    <title>@yield('title','Tasques Nataniel Pont')</title>
    <style>
        [v-cloak] {display: none}
    </style>
</head>
<body>
<div id="app" v-cloak>
    <v-app>
        <snackbar></snackbar>
        <service-worker></service-worker>
        <navigation v-model="drawer"></navigation>
        <navigation-right v-model="drawerRight" csrf-token="{{ csrf_token()}}"></navigation-right>
        <main-toolbar @toggle-right="drawerRight=!drawerRight"
                      @toggle-left="drawer=!drawer"
                      csrf-token="{{ csrf_token()}}">
        </main-toolbar>

        <v-content>
            @yield('content')
        </v-content>
        {{--<v-footer color="indigo" app>--}}
            {{--<span class="white--text">&copy; Nataniel Pont Tasks 2017</span>--}}
        {{--</v-footer>--}}
    </v-app>
</div>
</body>
</html>

{{--<v-toolbar--}}
{{--color="grey darken-1"--}}

{{--app--}}
{{--clipped-left--}}
{{--clipped-right--}}
{{--fixed>--}}
{{--<v-toolbar-side-icon class="white--text" @click.stop="drawer = !drawer"></v-toolbar-side-icon>--}}
{{--<v-toolbar-title class="white--text">Application</v-toolbar-title>--}}
{{--<v-spacer></v-spacer>--}}
{{--<notifications-widget></notifications-widget>--}}

{{--<v-avatar @click.stop="drawerRight = !drawerRight" title="{{ Auth::user()->name }} ( {{ Auth::user()->email }} )">--}}
{{--<img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar">--}}
{{--</v-avatar>--}}
{{--<v-form action="logout" method="POST">--}}
{{--@csrf--}}
{{--<v-btn color="grey darken-4" class="white--text" type="submit">Logout</v-btn>--}}
{{--</v-form>--}}
{{--</v-toolbar>--}}

