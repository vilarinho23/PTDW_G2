@extends("partials._header")
@section("navbar_content")
<a class="navbar-brand m-0 p-0 position-absolute top-50 start-50 translate-middle" style="color: black; font-family: 'Inter', sans-serif;" href="{{route("docente")}}">Docente</a>
<div class="position-absolute end-0 d-flex align-items-center">
    <p class="m-0 p-0 me-3" style="color: black; font-family: 'Inter', sans-serif;">
        {{ $nomeDocente ?? "nomeDocente" }}
    </p>
    <img class="m-0 p-0 me-4" src="{{ asset('images/logout.svg') }}" alt="Image_logout" id="image_logout" data-bs-toggle="modal" data-bs-target="#logOutModal">
</div>
@endsection
