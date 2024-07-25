<html data-bs-theme="dark">
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="@yield('meta_description')" />
    <script defer src="/js/jquery-3.7.1.min.js"></script>
</head>
<body>
<div id="app">
    <x-spa.preloader />
    <x-spa.preloaded-state :data="$preloaded_state" />
</div>
<link rel="stylesheet" href="/css/bootstrap.min.css" />
<link rel="stylesheet" href="/build/css/app.css?@front_version('css','app')"/>
<script src="/build/js/app.js?@front_version('js','app')"></script>
</body>
</html>


