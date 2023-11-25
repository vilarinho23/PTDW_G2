@extends("partials._header")
@section("navbar_content")
<div class="navbar-brand m-0 p-0 d-inline-flex gap-5 position-absolute top-50 start-50 translate-middle">
    <a class="m-0 p-0 text-decoration-none" style="color: black; font-family: 'Inter', sans-serif;" href="{{route("submissoes")}}">Submissões</a>
    <a class="m-0 p-0 text-decoration-none" style="color: black; font-family: 'Inter', sans-serif;" href="{{route("gestorDocentes")}}">Gestor de Docentes</a>
    <a class="m-0 p-0 text-decoration-none" style="color: black; font-family: 'Inter', sans-serif;" href="{{route("gestorUcs")}}">Gestor de UC's</a>
    <a class="m-0 p-0 text-decoration-none" style="color: black; font-family: 'Inter', sans-serif;" href="{{route("atribuicaoUcs")}}">Atribuição UC's</a>
</div>
<div class="position-absolute end-0 d-flex align-items-center">
    <p class="m-0 p-0 me-3" style="color: black; font-family: 'Inter', sans-serif;">
        {{ $nomeComissao ?? "nomeComissao" }}
    </p>
    <img class="m-0 p-0 me-4" src="{{ asset('images/logout.svg') }}" alt="Image_logout" id="image_logout" data-bs-toggle="modal" data-bs-target="#logOutModal">
</div>
@endsection
