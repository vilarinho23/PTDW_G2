@extends("partials._header")
@section("navbar_content")
<a class="navbar-brand m-0 p-0 position-absolute top-50 start-50 translate-middle" id="docenteHeader" style="color: black; font-family: 'Inter', sans-serif;" href="{{route("docente")}}">Docente</a>
@endsection

@section("head_plus")
<link rel="stylesheet" href="{{ asset('css/docenteStyle.css') }}">
@endsection
