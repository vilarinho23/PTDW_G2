<nav class="navbar w-100 position-relative" id="mainNavBar" style="background-color: #0EB4BD; height: 60px;">
    @yield('navbar_content')

    @auth
        <div class="position-absolute end-0 d-flex align-items-center">
            <p class="m-0 p-0 me-3" style="color: black; font-family: 'Inter', sans-serif;">
                @php
                    $user = Auth::user();
                    $nomeDisplay = $user->docente->nome_docente ?? ($user->name ?? 'Nome não encontrado');
                @endphp
                {{ $nomeDisplay }}
            </p>
            <img class="m-0 p-0 me-4 hover" src="{{ asset('images/logout.svg') }}" alt="Image_logout" id="image_logout"
                data-bs-toggle="modal" data-bs-target="#logOutModal">
        </div>
    @endauth
</nav>
<div id="wrapper" style="display: none;">
    <div class="overlay"></div>
    <nav class="navbar-inverse fixed-top" id="sidebar-wrapper">
        <div class="nav sidebar-nav">
            <div class="sidebar-header">
                <div class="d-flex sidebar-brand align-items-center p-0">
                    <div class="d-flex w-75 align-items-center justify-content-center">
                        <p class="m-0" style="color: white">
                            @php
                                $user = Auth::user();
                                $nomeDisplay = $user->docente->nome_docente ?? ($user->name ?? 'Nome não encontrado');
                            @endphp
                            {{ $nomeDisplay }}
                        </p>
                    </div>
                    <div class="w-25">
                        <img class="m-0 p-0 me-4 hover" src="{{ asset('images/logout.svg') }}" alt="Image_logout"
                            id="image_logout_side" data-bs-toggle="modal" data-bs-target="#logOutModal"
                            style="width: 25px">
                    </div>
                </div>
            </div>
            <ul class="d-flex flex-column gap-5 mt-5 ps-4">
                @yield('sidebar_content')
            </ul>
        </div>
    </nav>
    <div id="page-content-wrapper">
        <button type="button" class="hamburger animated fadeInLeft is-closed" id="hambImg" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
    </div>
</div>

<div class="modal" id="logOutModal" tabindex="-1" aria-labelledby="logOutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto" id="logOutModalLabel">Pretende sair da sua conta?</h5>
            </div>
            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                    id="logOut-button">Sair</button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                    data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
