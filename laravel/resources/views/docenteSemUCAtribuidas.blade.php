@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Docente"])
@endsection
@section('header')
@include('partials._headerDocente')
@endsection

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="height: 60vh;">
    <h1 class="mt-4">Sem Unidades Curriculares Associadas</h1>
    <p class="mt-3">Em caso de dúvida: <a href="geral@ua.pt" class="link-underline link-underline-hover">geral@ua.pt</a></p>
</div>
@endsection
