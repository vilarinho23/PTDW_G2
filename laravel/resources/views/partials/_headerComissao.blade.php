@extends("partials._header")
@section("navbar_content")
<div class="navbar-brand m-0 p-0 d-inline-flex gap-5 position-absolute top-50 start-50 translate-middle">
    <a class="m-0 p-0 text-decoration-none {{ Request::is('comissao/submissoes*') ? 'fw-bold' : '' }}" style="color: black; font-family: 'Inter', sans-serif;" href="{{ route("submissoes") }}">Submissões</a>
    <a class="m-0 p-0 text-decoration-none {{ Request::is('comissao/docentes*') ? 'fw-bold' : '' }}" style="color: black; font-family: 'Inter', sans-serif;" href="{{ route("gestorDocentes") }}">Docentes</a>
    <a class="m-0 p-0 text-decoration-none {{ Request::is('comissao/ucs*') ? 'fw-bold' : '' }}" style="color: black; font-family: 'Inter', sans-serif;" href="{{ route("gestorUcs") }}">Unidades Curriculares</a>
    <a class="m-0 p-0 text-decoration-none {{ Request::is('comissao/atribuicaoucs*') ? 'fw-bold' : '' }}" style="color: black; font-family: 'Inter', sans-serif;" href="{{ route("atribuicaoUcs") }}">Atribuições</a>
</div>
@endsection
