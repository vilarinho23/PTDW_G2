<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Atribuição de UC's</title>
    <style>
        /* Caso nenhum ficheiro tenha sido carregado, a classe ficheiro_ja_carregado fica com display: none */
        .ficheiro_ja_carregado {
            display: none;
        }
    </style>
</head>

<body>
    @include('partials._headComissao')

    <div class="container">
        <div class="border-atribuicao mx-auto">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" />
                    </div>
                    <div>
                        <img src="images/search-interface-symbol.png" alt="search">
                    </div>
                </div>

                <div class="d-flex gap-5">
                    <button type="button" class="button-style" style="width: 150px; height: 40px;"
                        data-bs-toggle="modal" data-bs-target="#atribuirModal">Atribuir UC</button>
                    <button type="button" class="button-style" style="width: 150px; height: 40px;"
                        data-bs-toggle="modal" data-bs-target="#carregarModal">Carregar Ficheiro</button>
                </div>
            </div>
            <div>

                <div class="container mt-3 d-flex align-items-center justify-content-center">
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
                                <td><img src="images\edit.png" alt="edit" data-bs-toggle="modal"
                                        data-bs-target="#editarModal"></td>
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
                                <td><img src="images\edit.png" alt="edit" data-bs-toggle="modal"
                                        data-bs-target="#editarModal"></td>
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


    <div class="modal modal-lg" id="atribuirModal" tabindex="-1" aria-labelledby="atribuirModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title mx-auto" id="atribuirModalLabel">Atribuir Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="container-fluid">
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="selectNFuncionario" class="col-form-label">Nº func</label>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" aria-label="" id="selectNFuncionario">
                                        <option selected></option>
                                        <option value="111111">111111</option>
                                        <option value="222222">222222</option>
                                        <option value="333333">333333</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="selectNomeDocente" class="col-form-label">Nome Docente</label>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" aria-label="" id="selectNomeDocente">
                                        <option selected></option>
                                        <option value="111111">Paulo Rui Santos</option>
                                        <option value="222222">Paulo Rui Santos</option>
                                        <option value="333333">Paulo Rui Santos</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="selectCodUC" class="col-form-label">Cód. UC</label>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" aria-label="" id="selectCodUC">
                                        <option selected></option>
                                        <option value="111111">111111</option>
                                        <option value="222222">222222</option>
                                        <option value="333333">333333</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="selectNomeUC" class="col-form-label">Nome UC</label>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" aria-label="" id="selectNomeUC">
                                        <option selected></option>
                                        <option value="111111">Matemática Complementar</option>
                                        <option value="222222">Matemática Complementar</option>
                                        <option value="333333">Matemática Complementar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="inputPercentagem" class="col-form-label">%</label>
                                </div>
                                <div class="col-sm">
                                    <input type="text" class="form-control" id="inputPercentagem" placeholder="">
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title mx-auto" id="editarModalLabel">Editar Atribuição de Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="container-fluid">
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="selectNFuncionario" class="col-form-label">Nº func</label>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" aria-label="" id="selectNFuncionario">
                                        <option selected></option>
                                        <option value="111111">111111</option>
                                        <option value="222222">222222</option>
                                        <option value="333333">333333</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="selectNomeDocente" class="col-form-label">Nome Docente</label>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" aria-label="" id="selectNomeDocente">
                                        <option selected></option>
                                        <option value="111111">Paulo Rui Santos</option>
                                        <option value="222222">Paulo Rui Santos</option>
                                        <option value="333333">Paulo Rui Santos</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="selectCodUC" class="col-form-label">Cód. UC</label>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" aria-label="" id="selectCodUC">
                                        <option selected></option>
                                        <option value="111111">111111</option>
                                        <option value="222222">222222</option>
                                        <option value="333333">333333</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="selectNomeUC" class="col-form-label">Nome UC</label>
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" aria-label="" id="selectNomeUC">
                                        <option selected></option>
                                        <option value="111111">Matemática Complementar</option>
                                        <option value="222222">Matemática Complementar</option>
                                        <option value="333333">Matemática Complementar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center m-1">
                                <div class="col-sm-2">
                                    <label for="inputPercentagem" class="col-form-label">%</label>
                                </div>
                                <div class="col-sm">
                                    <input type="text" class="form-control" id="inputPercentagem" placeholder="">
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
