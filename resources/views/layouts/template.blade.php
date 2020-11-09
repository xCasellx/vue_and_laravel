<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>@yield('title')</title>
</head>
<body >
    <div id="app" style="min-height: 100vh">
        @include('layouts.nav')
        <main class="">
            @yield('content')
        </main>
    </div>
    <footer class="text-white bg-dark mt-5">
        <div class="container text-center py-3">© 2020 Copyright</div>
    </footer>
</body>
<script src="{{mix('js/app.js')}}"></script>
@yield('script')

</html>
