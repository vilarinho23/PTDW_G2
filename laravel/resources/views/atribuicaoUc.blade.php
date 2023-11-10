<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
    <title>Atribuição de Uc's</title>
</head>
<body>
    @include('partials._headComissao')

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
                    <button type="button" class="button-style" style="width: 150px; height: 40px;">Atribuir UC</button>
                    <button type="button" class="button-style" style="width: 150px; height: 40px;">Carregar Ficheiro</button>
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
                                <td><img src="images\edit.png" alt="edit"></td>
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

    
</body>
</html>