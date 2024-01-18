@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Comissão"])
@endsection
@section('header')
@include("partials._headerComissao")
@endsection

@section('content')
<div class="container p-0 d-flex flex-column align-items-center mx-auto" style="width: fit-content; margin-top: 100px;">
    <p class="mb-5" style="font-size: 25px; font-weight: 600;">Bem-Vindo à Página da Comissão</p>
    <div class="mt-5">
        <div class="d-flex gap-5">
            <button class="button-style me-4" style="width: 250px; height: 70px; font-size: 20px" id="submissao-button" >Submissões</button>
            <button class="button-style" style="width: 250px; height: 70px; font-size: 20px" id="atribuicoes-button" >Atribuições</button>
        </div>
        <div class="d-flex gap-5 mt-5">
            <button class="button-style me-4" style="width: 250px; height: 70px; font-size: 20px" id="docentes-button" >Docentes</button>
            <button class="button-style" style="width: 250px; height: 70px; font-size: 20px" id="uc-button">Unidades Curriculares</button>
        </div>
    </div>
</div>

<script>
    $('#submissao-button').on('click', function () {
        window.location.href = "{{route('submissoes')}}";
    });
    $('#atribuicoes-button').on('click', function () {
        window.location.href = "{{route('atribuicaoUcs')}}";
    });
    $('#docentes-button').on('click', function () {
        window.location.href = "{{route('gestorDocentes')}}";
    });
    $('#uc-button').on('click', function () {
        window.location.href = "{{route('gestorUcs')}}";
    });
</script>
@endsection
