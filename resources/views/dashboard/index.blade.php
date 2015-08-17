@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  {!! link_to_route('sesiones.destroy', 'Cerrar sesión') !!}
@endsection
