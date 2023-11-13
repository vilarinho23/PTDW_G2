<nav class="navbar w-100 position-relative" style="background-color: #0EB4BD; height: 60px;">
  <div class="navbar-brand m-0 p-0 d-inline-flex gap-5 position-absolute top-50 start-50 translate-middle">
      <a class="m-0 p-0 text-decoration-none" style="color: black; font-family: 'Inter', sans-serif;" href="{{url("submissoes")}}">Submissões</a>
      <a class="m-0 p-0 text-decoration-none" style="color: black; font-family: 'Inter', sans-serif;" href="{{url("gestorDocentes")}}">Gestor de Docentes</a>
      <a class="m-0 p-0 text-decoration-none" style="color: black; font-family: 'Inter', sans-serif;" href="{{url("gestoruc")}}">Gestor de UC's</a>
      <a class="m-0 p-0 text-decoration-none" style="color: black; font-family: 'Inter', sans-serif;" href="{{url("atribuicaouc")}}">Atribuição UC's</a>
  </div>
  <div class="position-absolute end-0 d-flex align-items-center">
      <p class="m-0 p-0 me-3" style="color: black; font-family: 'Inter', sans-serif;">Pedro Antunes</p>
      <img class="m-0 p-0 me-4" src="{{ asset('images/logout.png') }}" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.cursor='default';" alt="Image_logout" data-bs-toggle="modal" data-bs-target="#logOutModal">
  </div>
</nav>

<div class="modal" id="logOutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title mx-auto" id="exampleModalLabel">Pretende sair da sua conta?</h5>
      </div>
      
      <div class="modal-footer d-flex justify-content-center border-0">
        <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;">Sair</button>
        <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>    
