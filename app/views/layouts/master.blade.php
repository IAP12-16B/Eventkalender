<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">
    <head>
        <meta charset="{{ mb_internal_encoding() }}">
        @yield('head.before')
        <title>
            @yield('head.title', 'Eventkalender')
        </title>
        @yield('head.after')
    </head>
    <body>
        @yield('body.before')
        @yield('body.content')
        @yield('body.after')
    </body>
</html>