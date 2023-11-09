<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <style>
        #myModal {
            backdrop-filter: blur(3px);
        }
    </style>

</head>
<body>
    <nav class="navbar w-100 position-relative" style="background-color: #0EB4BD; height: 60px;">
        <div class="navbar-brand m-0 p-0 d-inline-flex gap-5 position-absolute top-50 start-50 translate-middle">
            <p class="m-0 p-0" style="color: black; font-family: 'Inter', sans-serif;">Submissões</p>
            <p class="m-0 p-0" style="color: black; font-family: 'Inter', sans-serif;">Getor de Docentes</p>
            <p class="m-0 p-0" style="color: black; font-family: 'Inter', sans-serif;">Gestor de UC´s</p>
            <p class="m-0 p-0" style="color: black; font-family: 'Inter', sans-serif;">Atribuição UC´s</p>
        </div>
        <div class="position-absolute end-0 d-flex align-items-center">
            <p class="m-0 p-0 me-3" style="color: black; font-family: 'Inter', sans-serif;">Pedro Antunes</p>
            <img class="m-0 p-0 me-4" src="{{ asset('images/logout.png') }}" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.cursor='default';" alt="Image_logout" data-bs-toggle="modal" data-bs-target="#myModal">
        </div>
    </nav>

    <div class="modal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 