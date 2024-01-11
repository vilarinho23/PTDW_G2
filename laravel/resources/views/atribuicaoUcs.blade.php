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
                <div class="input-group rounded"><input type="search" class="form-control rounded" placeholder="Search" aria-label="Pesquisa"></div>
                <img src="{{ asset('images/search-interface-symbol.svg') }}" alt="search">
            </div>

            <div class="d-flex gap-5">
                <button type="button" class="button-style" style="width: 150px; height: 40px;" data-bs-toggle="modal" data-bs-target="#atribuirUcModal">Atribuir UC</button>
                <button type="button" class="button-style" style="width: 170px; height: 40px;" data-bs-toggle="modal" data-bs-target="#carregarModal">Carregar Ficheiro</button>
            </div>
        </div>

        <div class="container mt-3 text-center">
            <table class="table">
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
                    @foreach ($dados as $item)
                    <tr class="listrow" data-num-func={{$item->docente->num_func}} data-cod-uc={{$item->unidadeCurricular->cod_uc}}>
                        <td>{{ $item->docente->num_func }}</td>
                        <td>{{ $item->docente->nome_docente }}</td>
                        <td>{{ $item->docente->acn_docente }}</td>
                        <td>{{ $item->unidadeCurricular->cod_uc }}</td>
                        <td>{{ $item->unidadeCurricular->acn_uc }}</td>
                        <td>{{ $item->unidadeCurricular->responsavel->nome_docente }}</td>
                        <td>{{ $item->unidadeCurricular->nome_uc }}</td>
                        <td>{{ $item->unidadeCurricular->cursos->implode('acron_curso', ', ') }}</td>
                        <td>{{ $item->unidadeCurricular->horas_uc }}</td>
                        <td>{{ $item->perc_horas }}</td>
                        <td><img src="{{ asset('images/edit.svg') }}" alt="Editar"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex gap-3 ms-3">
        <img src="{{ asset('images/info.svg') }}" alt="info">
        <p>INFORMAÇÃO DE AJUDA</p>
    </div>
</div>

<div class="modal modal-lg" id="atribuirUcModal" tabindex="-1" aria-labelledby="atribuirUcModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
        <div class="modal-content border-0">
            <div class="modal-header border-0 p-4">
                <h5 class="modal-title mx-auto" id="atribuirUcModalLabel">Atribuir Unidade Curricular</h5>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="d-flex justify-content-center align-items-center gap-5 mb-5">
                        <div class="w-50">
                            <label for="dropdownAtribuirNFuncionario" class="col-form-label">Nº funcionário</label>
                            <select class="form-select" id="dropdownAtribuirNFuncionario" name="dropdownAtribuirNFuncionario" aria-label="Número do Funcionário">
                                @foreach($funcionarios->sortBy('num_func') as $funcionario)
                                    <option value="{{ $funcionario->num_func }}">{{ $funcionario->num_func }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-50">
                            <label for="dropdownAtribuirCodUc" class="col-form-label">Código UC</label>
                            <select class="form-select" id="dropdownAtribuirCodUc" name="dropdownAtribuirCodUc" aria-label="Código da UC">
                                @foreach($ucs->sortBy('cod_uc') as $uc)
                                    <option value="{{ $uc->cod_uc }}">{{ $uc->cod_uc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center gap-5 mb-5">
                        <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                            <div><label for="dropdownAtribuirNomeDocente" class="col-form-label">Nome Docente:</label></div>
                            <div>
                                <select class="form-select" id="dropdownAtribuirNomeDocente" aria-label="Nome do Funcionário">
                                    @foreach($funcionarios->sortBy('nome_docente') as $funcionario)
                                        <option value="{{ $funcionario->num_func }}">{{ $funcionario->nome_docente }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2 w-50 justify-content-center align-items-center">
                            <div><label for="dropdownAtribuirNomeUc" class="col-form-label">Nome UC:</label></div>
                            <div>
                                <select class="form-select" id="dropdownAtribuirNomeUc" aria-label="Nome da Unidade Curricular">
                                    @foreach($ucs->sortBy('nome_uc') as $uc)
                                        <option value="{{ $uc->cod_uc }}">{{ $uc->nome_uc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center mt-5 gap-2">
                        <div><label for="inputAtribuirPerc" class="col-form-label">%</label></div>
                        <div style="width: 45px"><input type="text" class="form-control" id="inputAtribuirPerc" name="inputAtribuirPerc" placeholder=""></div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center border-0">
                        <button id="btnAtribuir" type="button" class="mx-2 button-style" style="width: 130px; height: 30px;">Confirmar</button>
                        <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-lg" id="carregarModal" tabindex="-1" aria-labelledby="carregarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto" id="carregarModalLabel">Atribuir Unidades Curriculares</h5>
            </div>

            <div class="modal-body">
                @if ($dadosImportacao != null)
                <div class="mb-3">
                    <p class="text-danger fw-bold">JÁ FOI CARREGADO UM FICHEIRO</p>

                    <div class="m-1">
                        <span class="fw-bold">Data:</span> {{ $dadosImportacao->timestamp ?? 'Timestamp não encontrado' }}
                    </div>
                    <div class="m-1">
                        <span class="fw-bold">Uploader:</span> {{ $dadosImportacao->uploader ?? 'Uploader não encontrado' }}
                    </div>
                    <div class="m-1">
                        <span class="fw-bold">Ficheiro:</span> {{ $dadosImportacao->filename ?? 'Nome do ficheiro não encontrado' }}
                    </div>
                    @if ($dadosImportacao->lineErrors != null)
                    <div class="m-1">
                        <span class="fw-bold">Linhas com erros:</span> {{ $dadosImportacao->lineErrors }}
                    </div>
                    @endif
                </div>
                @endif

                <p>Se carregar um ficheiro, os dados atuais serão sobrescritos.</p>
                <form id="formCarregar" enctype="multipart/form-data">

                    <label for="fileUploadCarregar" class="form-label fw-bold text-decoration-underline">Selecione o ficheiro</label>
                    <input class="form-control" type="file" id="fileUploadCarregar" name="file" accept=".xlsx, .xls" required>
                </form>
            </div>

            <div class="modal-footer d-flex justify-content-center border-0">
                <button id="confirmarBtn" type="button" class="mx-2 button-style" style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-lg" id="editarModal" tabindex="-1"
    aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
        <div class="modal-content border-0">
            <div class="modal-header border-0 p-4">
                <h5 class="modal-title mx-auto" id="editarModalLabel">Editar Atribuição da UC '<span id="nomeUcEditarModal"></span>' com o Docente '<span id="nomeDocenteEditarModal"></span>'</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="inputEditarPerc" class="form-label">Digita a nova percentagem de horas:</label>
                    <input type="text" class="form-control" id="inputEditarPerc" name="inputEditarPerc" value="">
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnEditar" type="button" class="btn btn-primary">Salvar alterações</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar atribuição</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-lg" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h3 class="modal-title mx-auto" id="eliminarModalLabel">Confirmar Eliminação</h3>
            </div>

            <div class="modal-body"></div>
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
    const token = "{{ csrf_token() }}";
    const importUrl = "{{ route('import') }}";
    const updateUrl = "{{ route('atribuicaoUcs.update', ['num_func' => ':num_func', 'cod_uc' => ':cod_uc']) }}";
    const insertUrl = "{{ route('atribuicaoUcs.store') }}";
    const deleteUrl = "{{ route('atribuicaoUcs.destroy', ['num_func' => ':num_func', 'cod_uc' => ':cod_uc']) }}";

    @php
        $atribuicoes = $dados->values()->map(function ($atribuicao) {
            return [
                'num_func' => $atribuicao->docente->num_func,
                'nome_docente' => $atribuicao->docente->nome_docente,
                'cod_uc' => $atribuicao->unidadeCurricular->cod_uc,
                'nome_uc' => $atribuicao->unidadeCurricular->nome_uc,
                'perc_horas' => $atribuicao->perc_horas
            ];
        });
    @endphp
    const atribuicoes = @json($atribuicoes);

    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.querySelector('.form-control.rounded');
        const tableRows = document.querySelectorAll('.table tbody tr');

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();

            tableRows.forEach(function (row) {
                const docenteNome = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                const ucNome = row.querySelector('td:nth-child(7)').innerText.toLowerCase();

                if (docenteNome.includes(searchTerm) || ucNome.includes(searchTerm)) { row.style.display = ''; }
                else { row.style.display = 'none'; }
            });
        });
    });

    $('#confirmarBtn').click(function () {
        const form = $('#formCarregar')[0];
        $("#carregarModal").modal('hide');

        fetch(importUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            body: new FormData(form)
        })
        .then(() => {
            window.location.reload();
        })
        .catch(error => {
            console.error('Erro ao enviar ficheiro:', error);
        });
    });

    $("#dropdownAtribuirNFuncionario, #dropdownAtribuirNomeDocente").change(function () {
        const numFunc = $(this).val();
        $("#dropdownAtribuirNFuncionario").val(numFunc);
        $("#dropdownAtribuirNomeDocente").val(numFunc);
    });

    $("#dropdownAtribuirCodUc, #dropdownAtribuirNomeUc").change(function () {
        const codUc = $(this).val();
        $("#dropdownAtribuirCodUc").val(codUc);
        $("#dropdownAtribuirNomeUc").val(codUc);
    });

    $(".listrow").click(function () {
        const numFunc = $(this).data('num-func');
        const codUc = $(this).data('cod-uc');
        const atribuicao = atribuicoes.find(a => a.num_func == numFunc && a.cod_uc == codUc);

        $("#nomeUcEditarModal").text(atribuicao.nome_uc);
        $("#nomeDocenteEditarModal").text(atribuicao.nome_docente);
        $("#inputEditarPerc").val(atribuicao.perc_horas);

        const modal = $("#editarModal");
        modal.data('num-func', numFunc);
        modal.data('cod-uc', codUc);
        modal.modal('show');
    });

    $("#btnEditar").click(function () {
        const numFunc = $("#editarModal").data('num-func');
        const codUc = $("#editarModal").data('cod-uc');
        const percHoras = $("#inputEditarPerc").val();

        const url = updateUrl.replace(':num_func', numFunc).replace(':cod_uc', codUc);
        const data = { perc_horas: percHoras };

        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        })
        .then(data => {
            console.log(data);
            window.location.reload();
        })
        .catch(error => {
            console.error('Erro ao editar atribuição:', error);
        });
    });

    $("#btnEliminar").click(function () {
        const numFunc = $("#editarModal").data('num-func');
        const codUc = $("#editarModal").data('cod-uc');

        const url = deleteUrl.replace(':num_func', numFunc).replace(':cod_uc', codUc);

        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            }
        })
        .then(data => {
            console.log(data);
            window.location.reload();
        })
        .catch(error => {
            console.error('Erro ao eliminar atribuição:', error);
        });
    });

    $("#btnAtribuir").click(function () {
        const numFunc = $("#dropdownAtribuirNFuncionario").val();
        const codUc = $("#dropdownAtribuirCodUc").val();
        const percHoras = $("#inputAtribuirPerc").val();

        const data = {
            num_func: numFunc,
            cod_uc: codUc,
            perc_horas: percHoras
        };

        fetch(insertUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        })
        .then(data => {
            console.log(data);
            window.location.reload();
        })
        .catch(error => {
            console.error('Erro ao atribuir UC:', error);
        });
    });
</script>
@endsection
