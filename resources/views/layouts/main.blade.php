<!DOCTYPE html>
<html>
<head>
  <title>@yield('title') | TourGuide</title>
  @section('styles')
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
  @show
</head>
<body>
<div class="container-fluid">
  @yield('content')
</div>

@section('scripts')
  <script src="/js/app.js"></script>
@show
</body>
</html>
