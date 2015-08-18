<!DOCTYPE html>
<html>
<head>
  <title>@yield('title') | TourGuide</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @section('styles')
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
  @show
</head>
<body>
<div class="container-fluid">
  @section('body')
    @yield('content')
  @show
</div>

@section('scripts')
  <script src="/js/app.js"></script>
@show
</body>
</html>
