@extends('layouts.main')

@section('body')
  <div class="row">
    <aside class="col-xs-2 col-xl-1">
      <div class="text-center">
        <img id="logo" class="img-responsive center-block" src="{{ asset('images/logo.png') }}">
        <h5>TourGuide</h5>
      </div>

      <nav>
        <ul class="list-unstyled">
          <li>{!! link_to_route('dashboard', 'Inicio') !!}</li>
          <li>{!! link_to_route('administrar.compras', 'Compras') !!}</li>
          <li>{!! link_to_route('administrar.usuarios', 'Usuarios') !!}</li>
          <li>{!! link_to_route('administrar.ubicaciones', 'Ubicaciones turísticas') !!}</li>
        </ul>
      </nav>

      <div id="usuario">
        <strong>{{ Auth::user()->nombreCompleto() }}</strong>
        <strong>{{ ucfirst(Auth::user()->rol) }}</strong>
        <p>
          <span class="pull-left">Perfil</span>
          {!! link_to_route('sesiones.destroy', 'Salir', [], ['class' => 'pull-right']) !!}
        </p>
      </div>
    </aside>
    <main class="col-xs-10 col-xl-11 animated fadeIn">
      @yield('content')
    </main>
  </div>
@endsection

@section('scripts')
  @parent
  <script src="/js/crud.js"></script>
@endsection
