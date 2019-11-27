<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/sidebar.js') }}" defer></script>
  <script src="{{'https://kit.fontawesome.com/846336c251.js'}}" crossorigin="anonymous"></script>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
  <aside id="mySidebar" class="sidebar">
    <ul>
      <li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fas fa-backspace fa-xs"></i></a></li>
      <li><a href="">Dashboard</a></li>
      <li><a href="">Leaderboard</a></li>
      <li><a href="">Teams</a></li>
      <li><a href="">Projecten</a></li>
      <li><a href="">Leden</a></li>
      <li><a href="">GLRcoins</a></li>
      <li><a href="" style="margin-top:5%;">logout</a></li>
    </ul>
  </aside>

  <main class="py-4">
    <button class="openbtn" style="margin-left: 1%;" onclick="openNav()"><i class="fas fa-bars"></i></button>
    <div id="push_content">
      @yield('content')
    </div>
  </main>

</div>
</body>
</html>
