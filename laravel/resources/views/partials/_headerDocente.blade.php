<nav class="navbar w-100 position-relative" style="background-color: #0EB4BD; height: 60px;">
  <a class="navbar-brand m-0 p-0 position-absolute top-50 start-50 translate-middle" style="color: black; font-family: 'Inter', sans-serif;" href="{{url("docente")}}">Docente</a>
  <div class="position-absolute end-0 d-flex align-items-center">
      <p class="m-0 p-0 me-3" style="color: black; font-family: 'Inter', sans-serif;">Pedro Antunes</p>
      <img class="m-0 p-0 me-4" src="{{ asset('images/logout.png') }}" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.cursor='default';" alt="Image_logout" data-bs-toggle="modal" data-bs-target="#logOutModal">
  </div>
</nav>

<div class="modal" id="logOutModal" tabindex="-1" aria-labelledby="logOutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title mx-auto" id="logOutModalLabel">Pretende sair da sua conta?</h5>
      </div>
      <div class="modal-footer d-flex justify-content-center border-0">
        <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" id="logOut-button">Sair</button>
        <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
