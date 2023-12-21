@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Atribuição de UC's"])
@endsection
@section('header')
@include('partials._headerComissao')
@endsection

@section('content')
<div class="container">
    <div class="border-atribuicao mx-auto">
        <div class="d-flex justify-content-between">

            <div class="d-flex align-items-center gap-2">
                <div class="input-group rounded"><input type="search" class="form-control rounded" placeholder="Search"
                        aria-label="Search"></div>
                <div><img src="{{ asset('images/search-interface-symbol.svg') }}" alt="search"></div>
            </div>

            <div class="d-flex gap-5">
                <button type="button" class="button-style" style="width: 150px; height: 40px;" data-bs-toggle="modal"
                    data-bs-target="#atribuirUcModal">Atribuir UC</button>
                <button type="button" class="button-style" style="width: 170px; height: 40px;" data-bs-toggle="modal"
                    data-bs-target="#carregarModal">Carregar Ficheiro</button>
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
                            <th>Horas</th>
                            <th>%</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dados as $item)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $item->docente->nome_docente }}</td>
                            <td>{{ $item->docente->acn_docente }}</td>
                            <td>{{ $item->cod_uc }}</td>
                            <td>{{ $item->unidadeCurricular->acn_uc }}</td>
                            <td>{{ $item->unidadeCurricular->responsavel->nome_docente }}</td>
                            <td>{{ $item->unidadeCurricular->nome_uc }}</td>
                            <td>{{ $item->unidadeCurricular->horas_uc }}</td>
                            <td>{{ $item->perc_horas }}</td>
                            <td><img src="{{ asset('images/edit.svg') }}" alt="edit" data-bs-toggle="modal"
                                    data-bs-target="#editarModal"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex gap-3 ms-3">
        <div><img src="{{ asset('images/info.svg') }}" alt="info"></div>
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
                <form method="POST" action="{{ route('atribuicaoUcs.store') }}">

                    @csrf
                    <div class="container">

                        <div class="d-flex justify-content-center align-items-center gap-5 mb-5">
                            <div class="w-50">
                                <label for="dropdownAtribuirNFuncionario" class="col-form-label">Nº funcionário</label>
                                <select class="form-select" id="dropdownAtribuirNFuncionario" name="dropdownAtribuirNFuncionario" aria-label="Número do Funcionário">
                                    @foreach($funcionarios as $funcionario)
                                    <option value="{{ $funcionario->num_func }}">{{ $funcionario->num_func }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-50">
                                <label for="dropdownAtribuirCodUc" class="col-form-label">Código UC</label>
                                <select class="form-select" id="dropdownAtribuirCodUc" name="dropdownAtribuirCodUc" aria-label="Código da UC">
                                    @foreach($ucs as $uc)
                                    <option value="{{ $uc->cod_uc }}">{{ $uc->cod_uc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center gap-5 mb-5">

                            <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                <div><label for="inputAtribuirNomeDocente" class="col-form-label">Nome Docente</label></div>
                                <div><label class="form-control" id="inputAtribuirNomeDocente"></label></div>
                            </div>

                            <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                <div><label for="inputAtribuirNomeUc" class="col-form-label">Nome UC</label></div>
                                <div><label class="form-control" id="inputAtribuirNomeUc"></label></div>
                            </div>

                        </div>


                        <div class="d-flex justify-content-center align-items-center mt-5 gap-2">
                            <div><label for="inputAtribuirPerc" class="col-form-label">%</label></div>
                            <div style="width: 45px"><input type="text" class="form-control" id="inputAtribuirPerc" name="inputAtribuirPerc" placeholder=""></div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center border-0">
                            <button type="submit" class="mx-2 button-style"
                                style="width: 130px; height: 30px;">Confirmar</button>
                            <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                                data-bs-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-lg" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
        <div class="modal-content border-0">
            <div class="modal-header border-0 p-4">
                <h5 class="modal-title mx-auto" id="editarModalLabel"> Editar Atribuição de Unidade Curricular</h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="/">
                    @csrf
                    <div class="container">

                        <div class="d-flex justify-content-center align-items-center gap-5 mb-5">

                            <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                <div><label for="dropdownEditarNFuncionario" class="col-form-label">Nº
                                        funcionário</label></div>
                                <div><button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownEditarNFuncionario" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Dropdown button</button></div>
                            </div>

                            <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                <div><label for="dropdownEditarCodUc" class="col-form-label">Código UC</label></div>
                                <div><button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownEditarCodUc" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Dropdown button</button></div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center align-items-center gap-5 mb-5">

                            <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                <div><label for="inputEditarNomeDocente" class="col-form-label">Nome Docente</label>
                                </div>
                                <div><input type="text" class="form-control" id="inputEditarNomeDocente" placeholder="">
                                </div>
                            </div>

                            <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                                <div><label for="inputEditarNomeUc" class="col-form-label">Nome UC</label></div>
                                <div><input type="text" class="form-control" id="inputEditarNomeUc" placeholder="">
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-5 gap-2">
                            <div><label for="inputEditarPerc" class="col-form-label">%</label></div>
                            <div style="width: 45px"><input type="text" class="form-control" id="inputEditarPerc"
                                    placeholder=""></div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                    data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-lg" id="carregarModal" tabindex="-1" aria-labelledby="carregarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto" id="carregarModalLabel">Atribuir Unidade Curricular</h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="/">
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
                                    <label for="fileUploadCarregar"
                                        class="form-label fw-bold text-decoration-underline">Selecione o
                                        ficheiro</label>
                                    <input class="form-control" type="file" id="fileUploadCarregar">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;">Carregar<span
                        class="ficheiro_ja_carregado">Novo</span></button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                    data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@endsection