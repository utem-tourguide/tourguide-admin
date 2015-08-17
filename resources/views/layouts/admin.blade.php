@extends('layouts.main')

@section('body')
  <div class="row">
    <aside class="col-md-2">
      <img id="logo" class="img-responsive" src="{{ asset('images/tourguide-logo.jpg') }}">
      <h5>TourGuide</h5>

      <nav>
        <ul class="list-unstyled">
          <li>{!! link_to_route('dashboard', 'Inicio') !!}</li>
          <li>{!! link_to_route('administrar.compras', 'Compras') !!}</li>
          <li>{!! link_to_route('administrar.usuarios', 'Usuarios') !!}</li>
          <li>{!! link_to_route('administrar.ubicaciones', 'Ubicaciones turísticas') !!}</li>
        </ul>
      </nav>
    </aside>
    <main class="col-md-10">
      @yield('content')
    </main>
  </div>
@endsection

@section('scripts')
  @parent
  <script src="/js/crud.js"></script>
@endsection
