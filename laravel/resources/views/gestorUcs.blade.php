@extends('partials._document')
@section('head')
    @include('partials._head', ['titulo' => "Gestor de UC's"])
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
                        <input id="inputPesquisar" type="search" class="form-control rounded" placeholder="Search"
                            aria-label="Search">
                    </div>
                    <div>
                        <img src="{{ asset('images/search-interface-symbol.svg') }}" alt="search">
                    </div>
                </div>
                <button type="button" class="button-style" style="width: 150px; height: 40px;" data-bs-toggle="modal"
                    data-bs-target="#adicionarUcModal">Adicionar UC</button>
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
                            @foreach ($unidadesCurriculares as $uc)
                                <tr>
                                    <td>{{ $uc->cod_uc }}</td>
                                    <td>{{ $uc->acn_uc }}</td>
                                    <td>{{ $uc->responsavel->nome_docente }}</td>
                                    <td>{{ $uc->nome_uc }}</td>
                                    <td>{{ $uc->cursos->implode('acron_curso', ', ') }}</td>
                                    <td>{{ $uc->horas_uc }}</td>
                                    <td> <img src="{{ asset('images/edit.svg') }}" alt="edit" data-bs-toggle="modal"
                                            data-bs-target="#editarModal" data-id="{{ $uc->id }}"></td>
                                </tr>
                            @endforeach
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

    <div class="modal modal-lg" id="adicionarUcModal" tabindex="-1" aria-labelledby="adicionarUcModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-4">
                    <h5 class="modal-title mx-auto" id="adicionarUcModalLabel">Adicionar Nova Unidade Curricular</h5>
                </div>
                <div class="modal-body">
                    <form id="formAdicionarUc" method="POST" action="{{ route('adicionarUnidadeCurricular') }}">
                        @csrf
                        <div class="container">
                            <div class="d-flex justify-content-center gap-5 mb-5">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="selectAdicionarCurso" class="col-form-label">Curso: </label>
                                    </div>
                                    <div>
                                        <select class="form-control" id="selectAdicionarCurso" name="acron_uc">
                                            <option value="">Selecione o curso</option>
                                            @foreach ($cursos as $curso)
                                                <option value="{{ $curso->acron_curso }}">{{ $curso->nome_curso }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="mensagemErroCurso" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarNome" class="col-form-label">Nome UC: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputAdicionarNome" name="nome_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-5">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarCod" class="col-form-label">Cód. UC: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputAdicionarCod" name="cod_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarAcn" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputAdicionarAcn" name="acn_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-5">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarHoras" class="col-form-label">Horas: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputAdicionarHoras" name="horas_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="selectAdicionarResponsavel" class="col-form-label">Doc.
                                            Responsável:</label>
                                    </div>
                                    <div>
                                        <select class="form-control" id="selectAdicionarResponsavel"
                                            name="num_func_responsavel">
                                            <option value="">Selecione o Docente Responsável</option>
                                            @foreach ($docentesResponsaveis as $docente)
                                                <option value="{{ $docente->num_func }}">{{ $docente->nome_docente }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="mensagemErroResponsavel" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end"></div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center border-0">
                            <button type="button" id="btnAdicionarUc" class="mx-2 button-style"
                                style="width: 130px; height: 30px;">Confirmar</button>
                            <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                                data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!--    <div class="modal modal-lg" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
                <div class="modal-content border-0">
                    <div class="modal-header border-0 p-4">
                        <h5 class="modal-title mx-auto" id="editarModalLabel"> Editar Unidade Curricular</h5>
                    </div>
        
                    <div class="modal-body">
                        <form method="POST" action="{/{ route('updateUnidadeCurricular', ['id' => $unidadesCurriculares->id]) }}">
                            @/csrf
                            @/method('PUT')
                            <div class="container">
                                <div class="d-flex justify-content-center gap-5 mb-5">
                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div>
                                            <label for="selectEditarCurso" class="col-form-label">Curso: </label>
                                        </div>
                                        <div>
                                            <select class="form-control" id="selectEditarCurso" name="curso_uc">
                                                <option value="">Selecione o curso</option>
                                                @/foreach ($cursos as $curso)
                                                    <option value="{/{ $curso->acron_curso }}" @/if($curso->acron_curso === $unidadesCurriculares->curso_uc) selected @/endif>{/{ $curso->nome_curso }}</option>
                                                @/endforeach
                                            </select>
                                            <span id="mensagemErroCurso" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div>
                                            <label for="inputEditarNome" class="col-form-label">Nome UC: </label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control" id="inputEditarNome" placeholder="">
                                            value="{/{ $unidadesCurriculares->nome_uc }}">
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 w-25 justify-content-end "></div>

                                </div>


                                <div class="d-flex justify-content-center gap-5 mb-5">

                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div>
                                            <label for="inputEditarCod" class="col-form-label">Cód. UC: </label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control" id="inputEditarCod" placeholder="">
                                            value="{/{ $unidadesCurriculares->cod_uc }}">
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div>
                                            <label for="inputEditarAcn" class="col-form-label">ACN UC: </label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control" id="inputEditarAcn" placeholder="">
                                            value="{/{ $unidadesCurriculares->acn_uc }}">
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 w-25 justify-content-end "></div>

                                </div>

                                <div class="d-flex justify-content-center  gap-5 mb-5">

                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div>
                                            <label for="inputEditarHoras" class="col-form-label">Horas: </label>
                                        </div>
                                        <div>
                                            <input type="text" class="form-control" id="inputEditarHoras" name="horas_uc"
                                                value="{/{ $unidadesCurriculares->horas_uc }}">
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div>
                                            <label for="selectEditarResponsavel" class="col-form-label">Doc. Responsável:
                                            </label>
                                        </div>

                                        <div>
                                            <select class="form-control" id="selectEditarResponsavel"name="num_func_responsavel">
                                                <option value="">Selecione o Docente Responsável</option>
                                                @/foreach ($docentesResponsaveis as $docente)
                                                    <option value="{/{ $docente->num_func }}">{/{ $docente->nome_docente }}
                                                    </option>
                                                @/endforeach
                                            </select>
                                            <span id="mensagemErroResponsavel" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 w-25 justify-content-end"></div>

                                </div>


                            </div>
                        </form>
                    </div>

                    <div class="modal-footer d-flex justify-content-center border-0">
                        <button type="button" id="btnAdicionarUc" class="mx-2 button-style"
                            style="width: 130px; height: 30px;">Confirmar</button>
                        <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                            data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>  Aqui está a tentativa de fazer o editar--> 


    <div class="modal modal-lg" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-4">
                    <h5 class="modal-title mx-auto" id="editarModalLabel"> Editar Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form method="POST" action="/">
                        @csrf
                        <div class="container">

                            <div class="d-flex justify-content-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarCurso" class="col-form-label">Curso: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputEditarCurso" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarNome" class="col-form-label">Nome UC: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputEditarNome" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>

                            </div>


                            <div class="d-flex justify-content-center gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarCod" class="col-form-label">Cód. UC: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputEditarCod" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarAcn" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputEditarAcn" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>

                            </div>

                            <div class="d-flex justify-content-center  gap-5 mb-5">

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarHoras" class="col-form-label">Horas: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputEditarHoras" placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarResponsavel" class="col-form-label">Doc. Responsável:
                                        </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputEditarResponsavel"
                                            placeholder="">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('formAdicionarUc');
            var btnSubmit = document.getElementById('btnAdicionarUc');

            btnSubmit.addEventListener('click', function(event) {
                // Limpar mensagens de erro anteriores
                document.getElementById('mensagemErroCurso').innerText = "";
                document.getElementById('mensagemErroResponsavel').innerText = "";

                // Validar o campo Curso
                var selectCurso = document.getElementById('selectAdicionarCurso');
                if (selectCurso.value === "") {
                    document.getElementById('mensagemErroCurso').innerText =
                        "É obrigatório selecionar o curso!";
                    event.preventDefault();
                    return;
                }

                // Validar o campo Docente Responsável
                var selectResponsavel = document.getElementById('selectAdicionarResponsavel');
                if (selectResponsavel.value === "") {
                    document.getElementById('mensagemErroResponsavel').innerText =
                        "É obrigatório selecionar o docente responsável!";
                    event.preventDefault();
                    return;
                }

                const data = {
                    curso_uc: selectCurso.value,
                    nome_uc: document.getElementById('inputAdicionarNome').value,
                    cod_uc: document.getElementById('inputAdicionarCod').value,
                    acn_uc: document.getElementById('inputAdicionarAcn').value,
                    horas_uc: document.getElementById('inputAdicionarHoras').value,
                    num_func_resp: selectResponsavel.value
                };

                fetch('/comissao/uc', {
                        method: 'POST',
                        body: JSON.stringify(data),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        alert(data.message);
                    })
                    .catch(error => {
                        console.error('Erro ao adicionar Unidade Curricular:', error);
                        alert('Erro ao adicionar Unidade Curricular. Por favor, tente novamente.');
                    });
            });
        });
    </script>
@endsection
