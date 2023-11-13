<!DOCTYPE html>
<html lang="en">
    @include('partials._head',["titulo"=>"Atribuição de Uc's"])
</head>
<body>
    @include('partials._headerComissao')

    <div class="container">
        <div class="border-atribuicao mx-auto" >
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    </div>
                    <div>
                        <img src="images/search-interface-symbol.png" alt="search">
                    </div>
                </div>

                <div class="d-flex gap-5">
                    <button type="button" class="button-style" style="width: 150px; height: 40px;" data-bs-toggle="modal" data-bs-target="#atribuirUcModal">Atribuir UC</button>
                    <button type="button" class="button-style" style="width: 170px; height: 40px;" data-bs-toggle="modal" data-bs-target="#carregarModal">Carregar Ficheiro</button>
                </div>
            </div>
            <div>

                <div class="container mt-3 text-center">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nome Docente</th>
                                <th>ACN Docente</th>
                                <th>Cód. UC</th>
                                <th>ACN UC</th>
                                <th>Doc. Responsável</th>
                                <th>Nome UC</th>
                                <th>Curso</th>
                                <th>Horas</th>
                                <th>%</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Paulo Rui Santos</td>
                                <td>Tecnologias Aplicadas ao Trabalho</td>
                                <td>999999</td>
                                <td>Tecnologias Informáticas</td>
                                <td>Pedro Santos Rodrigues</td>
                                <td>Matemática Complementar</td>
                                <td>Tecnologias da informação</td>
                                <td>25</td>
                                <td>23</td>
                                <td><img src="images\edit.png" alt="edit" data-bs-toggle="modal"
                                    data-bs-target="#editarModal"></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Paulo Rui Santos</td>
                                <td>Tecnologias Aplicadas ao Trabalho</td>
                                <td>999999</td>
                                <td>Tecnologias Informáticas</td>
                                <td>Pedro Santos Rodrigues</td>
                                <td>Matemática Complementar</td>
                                <td>Tecnologias da informação</td>
                                <td>25</td>
                                <td>23</td>
                                <td><img src="images\edit.png" alt="edit"></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Paulo Rui Santos</td>
                                <td>Tecnologias Aplicadas ao Trabalho</td>
                                <td>999999</td>
                                <td>Tecnologias Informáticas</td>
                                <td>Pedro Santos Rodrigues</td>
                                <td>Matemática Complementar</td>
                                <td>Tecnologias da informação</td>
                                <td>25</td>
                                <td>23</td>
                                <td><img src="images\edit.png" alt="edit"></td>
                            </tr>
                        </tbody> 
                    </table>       
                </div>
            </div>
        </div>
        <div class="d-flex gap-3 ms-3">
            <div>
              <img src="images/info.png" alt="info">
            </div>
            <p>INFORMAÇÃO DE AJUDA</p>
          </div>
    </div>

    <div class="modal modal-lg" id="atribuirUcModal" tabindex="-1" aria-labelledby="atribuirUcModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-4">
                    <h5 class="modal-title mx-auto" id="atribuirUcModalLabel">Atribuir Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="container">

                            <div class="d-flex justify-content-center align-items-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Nº funcionário</label>
                                    </div>
                                    <div>
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown button
                                            </button>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                    <div>
                                        <label for="inputNFuncionario" class="col-form-label">Código UC</label>
                                    </div>
                                    <div>
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown button
                                            </button>
                                    </div>
                                </div>
                                
                            </div>


                            <div class="d-flex justify-content-center align-items-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Nome Docente</label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                    <div>
                                        <label for="inputNFuncionario" class="col-form-label">Nome UC</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputACNDocente" placeholder="">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="d-flex justify-content-center align-items-center mt-5 gap-2">
                                <div>
                                    <label for="inputNFuncionario" class="col-form-label">%</label>
                                </div>
                                <div style="width: 45px">
                                    <input type="text" class="form-control" id="inputACNDocente" placeholder="">
                                </div>

                            </div>
                    

                        </div>
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="mx-2 button-style"
                        style="width: 130px; height: 30px;">Confirmar</button>
                    <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                        data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-lg" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-4">
                    <h5 class="modal-title mx-auto" id="editarModalLabel"> Editar Atribuição de Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="container">

                            <div class="d-flex justify-content-center align-items-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Nº funcionário</label>
                                    </div>
                                    <div>
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown button
                                            </button>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                    <div>
                                        <label for="inputNFuncionario" class="col-form-label">Código UC</label>
                                    </div>
                                    <div>
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown button
                                            </button>
                                    </div>
                                </div>
                                
                            </div>


                            <div class="d-flex justify-content-center align-items-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Nome Docente</label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                    <div>
                                        <label for="inputNFuncionario" class="col-form-label">Nome UC</label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputACNDocente" placeholder="">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="d-flex justify-content-center align-items-center mt-5 gap-2">
                                <div>
                                    <label for="inputNFuncionario" class="col-form-label">%</label>
                                </div>
                                <div style="width: 45px">
                                    <input type="text" class="form-control" id="inputACNDocente" placeholder="">
                                </div>

                            </div>
                    

                        </div>
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="mx-2 button-style"
                        style="width: 130px; height: 30px;">Confirmar</button>
                    <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                        data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-lg" id="carregarModal" tabindex="-1" aria-labelledby="carregarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title mx-auto" id="carregarModalLabel">Atribuir Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="container-fluid">
                            <div class="row col container-fluid ficheiro_ja_carregado">
                                <div class="row g-3 align-items-center m-1">
                                    <div class="col">
                                        <p class="text-danger fw-bold text-center">JÁ FOI CARREGADO UM FICHEIRO</p>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center m-1">
                                    <div class="col text-center">
                                        <span class="fw-bold">Autor:</span>
                                        <span>Jorge Silva</span>
                                    </div>
                                    <div class="col text-center">
                                        <span class="fw-bold">Ficheiro:</span>
                                        <span>dsd_example.xlsx</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="fileUpload"
                                            class="form-label fw-bold text-decoration-underline">Selecione o
                                            ficheiro</label>
                                        <input class="form-control" type="file" id="fileUpload">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="mx-2 button-style"
                        style="width: 130px; height: 30px;">Carregar<span class="ficheiro_ja_carregado">
                            Novo</span></button>
                    <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                        data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    

    
</body>
</html>