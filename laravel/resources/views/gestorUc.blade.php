<!DOCTYPE html>
<html lang="en">
    @include('partials._head',["titulo"=>"Gestor de Uc's"])

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
                <button type="button" class="button-style" style="width: 150px; height: 40px;" data-bs-toggle="modal" data-bs-target="#atribuirUcModal">Adicionar UC</button>
            </div>
            <div>

                <div class="container mt-3 text-center">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Cód. UC</th>
                                <th>ACN UC</th>
                                <th>Doc. Responsável</th>
                                <th>Nome UC</th>
                                <th>Curso</th>
                                <th>Horas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>999999</td>
                                <td>Tecnologias Informáticas</td>
                                <td>Pedro Santos Rodrigues</td>
                                <td>Matemática Complementar</td>
                                <td>Tecnologias da informação</td>
                                <td>25</td>
                                <td><img src="images\edit.png" alt="edit" data-bs-toggle="modal"
                                    data-bs-target="#editarModal"></td>
                            </tr>
                            <tr>
                                <td>999999</td>
                                <td>Tecnologias Informáticas</td>
                                <td>Pedro Santos Rodrigues</td>
                                <td>Matemática Complementar</td>
                                <td>Tecnologias da informação</td>
                                <td>25</td>
                                <td><img src="images\edit.png" alt="edit"></td>
                            </tr>
                            <tr>
                                <td>999999</td>
                                <td>Tecnologias Informáticas</td>
                                <td>Pedro Santos Rodrigues</td>
                                <td>Matemática Complementar</td>
                                <td>Tecnologias da informação</td>
                                <td>25</td>
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
                    <h5 class="modal-title mx-auto" id="atribuirUcModalLabel">Adicionar Nova Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="container">

                            <div class="d-flex justify-content-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Curso: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Nome UC: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                                
                            </div>


                            <div class="d-flex justify-content-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Cód. UC: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                                
                            </div>

                            <div class="d-flex justify-content-center  gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Horas: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Doc. Responsável: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end"></div>
                                
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
                    <h5 class="modal-title mx-auto" id="editarModalLabel"> Editar Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="container">

                            <div class="d-flex justify-content-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Curso: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Nome UC: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                                
                            </div>


                            <div class="d-flex justify-content-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Cód. UC: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                                
                            </div>

                            <div class="d-flex justify-content-center  gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Horas: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div >
                                        <label for="inputNFuncionario" class="col-form-label">Doc. Responsável: </label>
                                    </div>
                                    <div >
                                        <input type="text" class="form-control" id="inputNomeDocente" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end"></div>
                                
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
    
</body>
</html>