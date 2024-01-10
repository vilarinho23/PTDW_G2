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
                        <input id="inputPesquisar" type="search" class="form-control rounded pesquisar-uc" placeholder="Search"
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
                                <tr class="listrow" data-id={{ $uc->cod_uc }}
                                    data-url={{ route('unidadeCurricular.show', $uc->cod_uc) }}>
                                    <td class = "fw-bold">{{ $uc->cod_uc }}</td>
                                    <td>{{ $uc->acn_uc }}</td>
                                    <td>{{ $uc->responsavel->nome_docente }}</td>
                                    <td>{{ $uc->nome_uc }}</td>
                                    <td>{{ $uc->cursos->implode('acron_curso', ', ') }}</td>
                                    <td>{{ $uc->horas_uc }}</td>
                                    <td>
                                        <img src="{{ asset('images/edit.svg') }}" alt="edit" data-bs-toggle="modal"
                                            data-bs-target="#editarModal" data-id="{{ $uc->id }}">
                                    </td>
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
                    <form id="formAdicionarUc" method="POST" action="{{ route('adicionar.unidadeCurricular') }}">
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
                                        <label for="selectAdicionarResponsavel" class="col-form-label">Doc.Responsável:
                                        </label>
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


    <div class="modal modal-lg" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-4">
                    <h5 class="modal-title mx-auto" id="editarModalLabel"> Editar Unidade Curricular</h5>
                </div>

                <div class="modal-body">
                    <form id="formEditarUc" method="POST"
                        action="{{ route('update.unidadeCurricular', ['cod_uc' => $uc->cod_uc]) }}">
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <div class="d-flex justify-content-center gap-5 mb-5">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="selectEditarCurso" class="col-form-label">Curso: </label>
                                    </div>
                                    <div>
                                        <select class="form-control" id="selectEditarCurso" name="curso_uc">
                                            <option value="">Selecione o curso</option>
                                            @foreach ($cursos as $curso)
                                                <option value="{{ $curso->acron_curso }}"
                                                    @if ($curso->acron_curso === $uc->curso_uc) selected @endif>
                                                    {{ $curso->nome_curso }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="mensagemErroCurso" class="text-danger"></span>
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
                                        <input type="text" class="form-control" id="inputEditarCod" placeholder=""
                                            value="{{ $uc->cod_uc }}">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarAcn" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" id="inputEditarAcn" placeholder=""
                                            value="{{ $uc->acn_uc }}">
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
                                            value="{{ $uc->horas_uc }}">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="selectEditarResponsavel" class="col-form-label">Doc. Responsável:
                                        </label>
                                    </div>

                                    <div>
                                        <select class="form-control" id="selectEditarResponsavel"
                                            name="num_func_responsavel">
                                            <option value="">Selecione o Docente Responsável</option>
                                            @foreach ($docentesResponsaveis as $docente)
                                                <option value="{{ $docente->num_func }}"
                                                    @if ($docente->num_func === $uc->num_func_resp) selected @endif>
                                                    {{ $docente->nome_docente }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="mensagemErroResponsavel" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end"></div>

                            </div>


                        </div>
                    </form>
                </div>

                <div class="d-flex justify-content-center" id="mensagemErroEditar" style="color: red;"></div>

                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" id="btnEditarUc" class="mx-2 button-style"
                        style="width: 130px; height: 30px;">Confirmar</button>
                    <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="mx-2 button-style-red" id="btnEliminarModal"
                        style="width: 130px; height: 30px;" data-bs-toggle="modal"
                        data-bs-target="#eliminarModal">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-lg" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h3 class="modal-title mx-auto" id="eliminarModalLabel">Confirmar Eliminação</h3>
                </div>

                <div class="modal-body">
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="mx-2 button-style" id="btnEliminar"
                        style="width: 130px; height: 30px;">Confirmar</button>
                    <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                        data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        /*const updateUcUrl = "{{ route('update.unidadeCurricular', ':cod_uc') }}";
                                                        const insertUcUrl = "{{ route('adicionar.unidadeCurricular') }}";

                                                        $(document).ready(function() {
                                                            $('body').on('click', 'tr', function() {
                                                                var userURL = $(this).data('url');
                                                                $.get(userURL, function(data) {
                                                                    $('#editarModal').modal('show');
                                                                    $('#selectEditarCurso').val(data.curso_uc);
                                                                    $('#inputEditarCod').val(data.cod_uc);
                                                                    $('#inputEditarAcn').val(data.acn_uc);
                                                                    $('#inputEditarHoras').val(data.horas_uc);
                                                                    $('#selectEditarResponsavel').val(data.num_func_resp);

                                                                    $(".modal-body > form").attr(
                                                                        "action",
                                                                        updateUcUrl.replace(':cod_uc', data.cod_uc)
                                                                    );
                                                                });
                                                            });
                                                        });

                                                        document.getElementById("btnEditarUc").onclick = function() {
                                                            const data = {
                                                                curso_uc: document.getElementById('selectEditarCurso').value,
                                                                nome_uc: document.getElementById('inputEditarNome').value,
                                                                cod_uc: document.getElementById('inputEditarCod').value,
                                                                acn_uc: document.getElementById('inputEditarAcn').value,
                                                                horas_uc: document.getElementById('inputEditarHoras').value,
                                                                num_func_resp: document.getElementById('selectEditarResponsavel').value
                                                            };

                                                            let divMensagensErro = document.getElementById('mensagemErroEditar');

                                                            const url = updateUcUrl.replace(':cod_uc', data.get('cod_uc'));
                                                            fetch(url, {
                                                                    method: 'PUT',
                                                                    headers: {
                                                                        'Content-Type': 'application/json',
                                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                                    },
                                                                    body: JSON.stringify(data)
                                                                })
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    if (data && data.error) {
                                                                        divMensagensErro.innerText = data.error;
                                                                    } else {
                                                                        console.log('Dados enviados com sucesso:', data);
                                                                        $('#editarModal').modal('hide');
                                                                        window.location.reload();
                                                                    }
                                                                })
                                                                .catch(error => {
                                                                    console.error('Erro ao enviar dados:', error);
                                                                });
                                                        }
                                                        
                                                        Código da Página de Gestor de Docentes adaptado à Gestor de UC's*/

        //Adicionar UC
        document.addEventListener('DOMContentLoaded', function() {
            var formAdicionarUc = document.getElementById('formAdicionarUc');
            var btnAdicionarUc = document.getElementById('btnAdicionarUc');

            btnAdicionarUc.addEventListener('click', function(event) {
                document.getElementById('mensagemErroCurso').innerText = "";
                document.getElementById('mensagemErroResponsavel').innerText = "";

                var selectCurso = document.getElementById('selectAdicionarCurso');
                if (selectCurso.value === "") {
                    document.getElementById('mensagemErroCurso').innerText =
                        "É obrigatório selecionar o curso!";
                    event.preventDefault();
                    return;
                }

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


        //Editar UC
        var formEditarUc = document.getElementById('formEditarUc');
        var btnEditarUc = document.getElementById('btnEditarUc');

        document.querySelector('tbody').addEventListener('click', function(event) {
            var target = event.target;

            if (target.tagName.toLowerCase() === 'tr') {
                document.getElementById('mensagemErroCurso').innerText = "";
                document.getElementById('mensagemErroResponsavel').innerText = "";

                var idDaUC = target.dataset.id;

                fetch(`/comissao/uc/${idDaUC}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('selectEditarCurso').value = data.curso_uc;
                        document.getElementById('inputEditarCod').value = data.cod_uc;
                        document.getElementById('inputEditarAcn').value = data.acn_uc;
                        document.getElementById('inputEditarHoras').value = data.horas_uc;
                        document.getElementById('selectEditarResponsavel').value = data
                            .num_func_resp;

                        var editarModal = new bootstrap.Modal(document.getElementById(
                            'editarModal'));
                        editarModal.show();
                    })
                    .catch(error => {
                        console.error('Erro ao obter dados da Unidade Curricular:', error);
                        alert(
                            'Erro ao obter dados da Unidade Curricular. Por favor, tente novamente.'
                        );
                    });
            }
        });

        btnEditarUc.addEventListener('click', function(event) {
            document.getElementById('mensagemErroCurso').innerText = "";
            document.getElementById('mensagemErroResponsavel').innerText = "";

            var selectCurso = document.getElementById('selectEditarCurso');
            if (selectCurso.value === "") {
                document.getElementById('mensagemErroCurso').innerText =
                    "É obrigatório selecionar o curso!";
                event.preventDefault();
                return;
            }

            var selectResponsavel = document.getElementById('selectEditarResponsavel');
            if (selectResponsavel.value === "") {
                document.getElementById('mensagemErroResponsavel').innerText =
                    "É obrigatório selecionar o docente responsável!";
                event.preventDefault();
                return;
            }

            const data = {
                curso_uc: selectCurso.value,
                nome_uc: document.getElementById('inputEditarNome').value,
                cod_uc: document.getElementById('inputEditarCod').value,
                acn_uc: document.getElementById('inputEditarAcn').value,
                horas_uc: document.getElementById('inputEditarHoras').value,
                num_func_resp: selectResponsavel.value
            };

            fetch(`/comissao/uc/${data.cod_uc}`, {
                    method: 'PUT',
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

                    var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
                    editarModal.hide();
                })
                .catch(error => {
                    console.error('Erro ao editar Unidade Curricular:', error);
                    alert('Erro ao editar Unidade Curricular. Por favor, tente novamente.');
                });
        });


        //Pesquisar UC
        $(document).ready(function() {
            $('.pesquisar-uc').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();

                $('tbody tr').each(function() {
                    var codUC = $(this).find('td:eq(0)').text().toLowerCase();
                    var acnUC = $(this).find('td:eq(1)').text().toLowerCase();
                    var docResponsavel = $(this).find('td:eq(2)').text().toLowerCase();
                    var nomeUC = $(this).find('td:eq(3)').text().toLowerCase();
                    var cursos = $(this).find('td:eq(4)').text().toLowerCase();
                    var horasUC = $(this).find('td:eq(5)').text().toLowerCase();

                    if (codUC.includes(searchText) || acnUC.includes(searchText) ||
                        docResponsavel.includes(searchText) ||
                        nomeUC.includes(searchText) || cursos.includes(searchText) ||
                        horasUC.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });


            //Eliminar UC
            const deleteUnidadeCurricularUrl = "{{ route('eliminar.unidadeCurricular', ':id') }}";

            document.getElementById("btnEliminar").onclick = function() {
                const id = document.getElementById('inputEditarCod').value;
                const url = deleteUnidadeCurricularUrl.replace(':id', id);

                fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        alert(data.message);
                    })
                    .catch(error => {
                        console.error('Erro ao eliminar Unidade Curricular:', error);
                        alert('Erro ao eliminar Unidade Curricular. Por favor, tente novamente.');
                    });
            }
        });
    </script>
@endsection
