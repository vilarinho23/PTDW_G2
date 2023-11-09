<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}">
    <title>Restrições</title>
</head>
<body>
    @include('partials._headDocente')
    <div class="d-flex align-items-center justify-content-center">
      <div class="p-5  " style="min-height: 80vh;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Nome UC 1</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nome UC 2</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Restrições</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade border border-primary p-5 show active tabela" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="d-flex ">
                <p class="w-50"> <strong>Unidade Curricular: </strong>Nome da uni C</p>
                <p class="w-25"><strong>Curso: </strong>Ti</p>
                <p class="w-25"><strong>Nº Horas Atribuidas: </strong>horas</p>
              </div>
              <p><strong>Docente Responsável: </strong>nome</p>
              <div>
                <p class="mt-5"><strong>Utilização de Laboratórios:</strong></p>
                <div class="p-1">

                  <div class="gap-5 d-flex">
                    
                    <div class="d-flex gap-2">
                      <p><strong>Para Aula: </strong>Obrigatório</p>
                      <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                    </div>

                    <div class="d-flex gap-2">
                      <p>Preferencial</p>
                      <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                    </div>
                    
                    
                  </div>

                  <div class="d-flex gap-3">
                    <p><strong>Laboratórios Possíveis: </strong></p>

                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>

                  </div>

                  <div class="d-flex gap-5">
                    <p><strong>Para Avaliação:</strong></p>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex gap-4 mt-5">
                    <p><strong>Software Necessário:</strong></p>
                    <div class="input-group input-group-lg">
                      <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                    </div>
                  </div>
                  
                  
                </div>
                <div class="d-flex justify-content-end mt-4">
                  <button type="button" class="button-style" id="botao-preencher">Seguinte</button>
                </div>
                
              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
            <div class="tab-pane fade tabela" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <div class="container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Horário</th>
                            <th scope="col">Segunda-feira</th>
                            <th scope="col">Terça-feira</th>
                            <th scope="col">Quarta-feira</th>
                            <th scope="col">Quinta-feira</th>
                            <th scope="col">Sexta-feira</th>
                            <th scope="col">Sábado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col">Manhã</th>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></ scope="col">
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                        </tr>
                        <tr>
                            <th scope="col">Tarde</th>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                        </tr>
                        <tr>
                            <th scope="col">Noite</th>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                            <td scope="col"><input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="..."></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-3 ms-3">
              <div>
                <img src="images/info.png" alt="info">
              </div>
              <p>Deve deixar pelo menos 2 blocos disponíveis.</p>
            </div>
            <div class="d-flex justify-content-end mt-4">
              <button type="button" class="button-style" id="botao-preencher" data-bs-toggle="modal" data-bs-target="#myModal">Submeter</button>
            </div>
            <div class="modal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                  <div class="modal-header border-0">
                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Submeter informações?</h5>
                  </div>
                  <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;">Confirmar</button>
                    <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
          </div>
            </div>
          </div>
    </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>