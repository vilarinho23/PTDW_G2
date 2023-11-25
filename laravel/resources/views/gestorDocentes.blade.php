@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Gestor de Docentes"])
@endsection
@section('header')
@include('partials._headerComissao')
@endsection

@section('content')
<div class="container">
    <div class="border-atribuicao mx-auto">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search">
                </div>
                <div>
                    <img src="{{ asset('images/search-interface-symbol.svg') }}" alt="search">
                </div>
            </div>

            <div class="d-flex gap-5">
                <button type="button" class="button-style" style="width: 200px; height: 40px;"
                    data-bs-toggle="modal" data-bs-target="#adicionarModal">Adicionar docente</button>
            </div>
        </div>
        <div>

            <div class="container mt-3 text-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Nome Docente</th>
                            <th>ACN Docente</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Paulo Rui Santos</td>
                            <td>Tecnologias Aplicadas ao Trabalho</td>
                            <td><img src="{{ asset('images/edit.svg') }}" alt="edit" data-bs-toggle="modal"
                                    data-bs-target="#editarModal"></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Paulo Rui Santos</td>
                            <td>Tecnologias Aplicadas ao Trabalho</td>
                            <td><img src="{{ asset('images/edit.svg') }}" alt="edit" data-bs-toggle="modal"
                                    data-bs-target="#editarModal"></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Paulo Rui Santos</td>
                            <td>Tecnologias Aplicadas ao Trabalho</td>
                            <td><img src="{{ asset('images/edit.svg') }}" alt="edit" data-bs-toggle="modal"
                                    data-bs-target="#editarModal"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex gap-3 ms-3">
        <div>
            <img src="{{ asset('images/info.svg') }}" alt="info">
        </div>
        <p>INFORMAÇÃO DE AJUDA</p>
    </div>
</div>

<div class="modal modal-lg" id="adicionarModal" tabindex="-1" aria-labelledby="adicionarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto" id="adicionarModalLabel">Adicionar Novo Docente</h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="/">
                    @csrf
                    <div class="container-fluid">
                        <div class="row g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputAdicionarNFuncionario" class="col-form-label">Nº funcionário</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="inputAdicionarNFuncionario" placeholder="">
                            </div>
                        </div>
                        <div class="row mt-2 g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputAdicionarNome" class="col-form-label">Nome docente</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputAdicionarNome" placeholder="">
                            </div>
                        </div>
                        <div class="row mt-2 g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputAdicionarAcn" class="col-form-label">ACN docente</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputAdicionarAcn" placeholder="">
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
                <h5 class="modal-title mx-auto" id="editarModalLabel">Editar Dados de Docente</h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="/">
                    @csrf
                    <div class="container-fluid">
                        <div class="row g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputEditarNFuncionario" class="col-form-label">Nº funcionário</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="inputEditarNFuncionario" placeholder="">
                            </div>
                        </div>
                        <div class="row mt-2 g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputEditarNome" class="col-form-label">Nome docente</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputEditarNome" placeholder="">
                            </div>
                        </div>
                        <div class="row mt-2 g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputEditarAcn" class="col-form-label">ACN docente</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputEditarAcn" placeholder="">
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
@endsection
