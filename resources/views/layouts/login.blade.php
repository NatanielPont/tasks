<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" content="/img/shareImg.jpg">
    <meta property="og:image:width" content="439">
    <meta property="og:image:height" content="659">
    <meta property="og:title" content="Application Tasks">
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="Description tasks">
    <meta property="og:url" content="https://tasks.natanielpont.scool.cat/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <meta name="vapidPublicKey" content="{{ config('webpush.vapid.public_key') }}">

    <link rel="manifest" href="/manifest.json">
    @stack('beforeScripts')


    <script defer src="{{ mix('/js/manifest.js') }}"></script>
    <script defer src="{{ mix('/js/vendor.js') }}"></script>
    <script defer src="{{ mix('/js/app.js') }}"></script>
    @stack('afterScripts')


    <title>@yield('title','Put your title here')</title>
    <style>
        [v-cloak] {display: none}
    </style>
</head>
<body>
<div id="app" v-cloak>
    <v-app>
        @yield('content')
    </v-app>
</div>
</body>
</html>
