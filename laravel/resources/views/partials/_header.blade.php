<nav class="navbar w-100 position-relative" style="background-color: #0EB4BD; height: 60px;">
    @yield("navbar_content")
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
