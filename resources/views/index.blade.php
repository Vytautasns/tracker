@extends('layouts.app')
@section('content')
<div id="app">
  {{-- <ul class="dropdown-menu" role="menu">
    <li>
      <a href="{{ route('logout') }}"
      onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
           Logout
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </li>
  </ul> --}}
  <Application></Application>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@endsection
