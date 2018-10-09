<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <!--//link css vuetify-->
</head>
<body>
Header
<nav>
    <ul>

        <li> <a href="/tasks_vue">Tasques amb PHP</a></li>
    </ul>
    <ul>
        <li>Tasques amb Vue</li>
    </ul>
    <ul>
        <li>Tasques amb Contact</li>
    </ul>
</nav>
<div id="app">
    @yield('content')
</div>
Footer
<script src="/js/app.js"></script>

</body>
</html>