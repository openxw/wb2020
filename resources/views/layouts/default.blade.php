<!DOCTYPE html>
<html>
<head>
  <title>@yield('title','WB2020 App') - laravel 新手入门教程</title>
  <link rel="stylesheet" href="{{ mix('/css/app.css')}}">
</head>
<body>
  @include('layouts._header')

  <div class="container">
    <div class="offset-md-1 col-mo-10">
      @include('shared._messages')
       @yield('content')
       @include('layouts._footer')
    </div>
  </div>
</body>
</html>
