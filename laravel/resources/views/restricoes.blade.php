<!DOCTYPE html>
<html lang="en">
    @include('partials._head',["titulo"=>"Restrições"])

<body>
    @include('partials._headerDocente')
    <div class="d-flex align-items-center justify-content-center">
      <div class="p-5  " style="min-height: 80vh;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active text-black" id="uc0-tab" data-bs-toggle="tab" data-bs-target="#uc0" type="button" role="tab" aria-controls="uc0" aria-selected="true">Nome UC 1</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link text-black" id="uc1-tab" data-bs-toggle="tab" data-bs-target="#uc1" type="button" role="tab" aria-controls="uc1" aria-selected="false">Nome UC 2</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link text-black" id="impedimentos-tab" data-bs-toggle="tab" data-bs-target="#impedimentos" type="button" role="tab" aria-controls="impedimentos" aria-selected="false">Restrições</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fadey p-5 show active tabela shadow-lg p-3 mb-5 bg-white rounded" id="uc0" role="tabpanel" aria-labelledby="uc0-tab">
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
                      <input class="form-check-input" type="checkbox" value="" aria-label="...">
                    </div>

                    <div class="d-flex gap-2">
                      <p>Preferencial</p>
                      <input class="form-check-input" type="checkbox" value="" aria-label="...">
                    </div>


                  </div>

                  <div class="d-flex gap-3 ">
                    <p><strong>Laboratórios Possíveis: </strong></p>

                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownLaboratorio0Uc0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownLaboratorio0Uc0">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownLaboratorio1Uc0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownLaboratorio1Uc0">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownLaboratorio2Uc0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownLaboratorio2Uc0">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownLaboratorio3Uc0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownLaboratorio3Uc0">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>

                  </div>

                  <div class="d-flex gap-5">
                    <p><strong>Para Avaliação:</strong></p>
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownAvaliacaoUc0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownAvaliacaoUc0">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex gap-4 mt-5">
                    <p><strong>Software Necessário:</strong></p>
                    <div class="input-group input-group-lg">
                      <input type="text" class="form-control" aria-label="Large">
                    </div>
                  </div>


                </div>
                <div class="d-flex justify-content-end mt-4">
                  <button type="button" class="button-style" id="botao-seguinte">Seguinte</button>
                </div>

              </div>
            </div>
            <div class="tab-pane fade " id="uc1" role="tabpanel" aria-labelledby="uc1-tab">2</div>
            <div class="tab-pane fade tabela shadow-lg p-3 mb-5 bg-white rounded" id="impedimentos" role="tabpanel" aria-labelledby="impedimentos-tab">
              <div class="container mt-4 ">
                <p class="text-center mb-4"><strong>Assinalar Impedimentos</strong></p>
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
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                        </tr>
                        <tr>
                            <th scope="col">Tarde</th>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                        </tr>
                        <tr>
                            <th scope="col">Noite</th>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                            <td><input class="form-check-input " type="checkbox" value="" aria-label="..."></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-3 ms-3 mt-5">
              <div>
                <img src="images/info.png" alt="info">
              </div>
              <p>Deve deixar pelo menos 2 blocos disponíveis.</p>
            </div>
            <div class="d-flex justify-content-end mt-5">
              <button type="button" class="button-style" id="botao-preencher" data-bs-toggle="modal" data-bs-target="#submeterModal">Submeter</button>
            </div>
            <div class="modal" id="submeterModal" tabindex="-1" aria-labelledby="submeterModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                  <div class="modal-header border-0">
                    <h5 class="modal-title mx-auto" id="submeterModalLabel">Submeter informações?</h5>
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

</body>

</html>
