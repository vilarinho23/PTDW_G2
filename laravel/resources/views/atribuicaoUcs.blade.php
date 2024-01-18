@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Gestor de Atribuições"])
@endsection
@section('header')
@include('partials._headerComissao')
@endsection

@section('content')
<div class="container">
    <div class="border-atribuicao mx-auto">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center gap-2 ms-4">
                <div class="input-group rounded"><input type="search" class="form-control rounded searchInput" placeholder="Número/Nome" aria-label="Pesquisa"></div>
            </div>
            <div class="d-flex gap-5">
                <button type="button" class="button-style" style="width: 170px; height: 40px;" data-bs-toggle="modal" data-bs-target="#carregarModal">Carregar Ficheiro</button>
                <button type="button" class="button-style" style="width: 150px; height: 40px;" data-bs-toggle="modal" data-bs-target="#atribuirUcModal">Atribuir UC</button>
                <button type="button" class="button-style" style="width: 150px; height: 40px;" data-bs-toggle="modal" data-bs-target="#eliminarTodasModal">Eliminar Todas</button>
            </div>
        </div>

        <div class="container mt-3 text-center tableFixHead">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Nº</th>
                        <th class="text-start">Nome Docente</th>
                        <th>Cód. UC</th>
                        <th class="text-start">Nome UC</th>
                        <th>Horas</th>
                        <th>%</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                    <tr class="listrow" data-num-func={{$item->docente->num_func}} data-cod-uc={{$item->unidadeCurricular->cod_uc}}>
                        <td>{{ $item->docente->num_func }}</td>
                        <td class="text-start">{{ $item->docente->nome_docente }}</td>
                        <td>{{ $item->unidadeCurricular->cod_uc }}</td>
                        <td class="text-start">{{ $item->unidadeCurricular->nome_uc }}</td>
                        <td>{{ $item->unidadeCurricular->horas_uc }}</td>
                        <td>{{ $item->perc_horas }}</td>
                        <td><img src="{{ asset('images/edit.svg') }}" alt="Editar"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @php
                $block = count($dados) == 0 ? "d-block" : "d-none";
            @endphp
            <p id="noResultsMessage" class="text-center mt-5 {{ $block }}">Sem resultados.</p>
        </div>
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
                        <div class="w-100">
                            <label for="dropdownAtribuirNomeDocente" class="col-form-label">Nome Docente:</label>
                            <select class="form-select" id="dropdownAtribuirNomeDocente" aria-label="Nome do Funcionário">
                                @foreach($funcionarios->sortBy('nome_docente') as $funcionario)
                                    <option value="{{ $funcionario->num_func }}">{{ $funcionario->nome_docente }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-100">
                            <label for="dropdownAtribuirNomeUc" class="col-form-label">Nome UC:</label>
                            <select class="form-select " id="dropdownAtribuirNomeUc" aria-label="Nome da Unidade Curricular">
                                @foreach($ucs->sortBy('nome_uc') as $uc)
                                    <option value="{{ $uc->cod_uc }}">{{ $uc->nome_uc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center gap-5 mb-5">

                        <div class="w-100">
                            <label for="dropdownAtribuirNFuncionario" class="col-form-label">Nº funcionário</label>
                            <select class="form-select" id="dropdownAtribuirNFuncionario" name="dropdownAtribuirNFuncionario" aria-label="Número do Funcionário">
                                @foreach($funcionarios->sortBy('num_func') as $funcionario)
                                    <option value="{{ $funcionario->num_func }}">{{ $funcionario->num_func }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-100">
                            <label for="dropdownAtribuirCodUc" class="col-form-label">Código UC</label>
                            <select class="form-select" id="dropdownAtribuirCodUc" name="dropdownAtribuirCodUc" aria-label="Código da UC">
                                @foreach($ucs->sortBy('cod_uc') as $uc)
                                    <option value="{{ $uc->cod_uc }}">{{ $uc->cod_uc }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="d-flex justify-content-center align-items-center mt-5 gap-2">
                        <div><label for="inputAtribuirPerc" class="col-form-label">%</label></div>
                        <div style="width: 45px"><input type="text" class="form-control" id="inputAtribuirPerc" name="inputAtribuirPerc" placeholder=""></div>
                    </div>

                    <div id="divMessagemErroAtribuir" class="d-flex justify-content-center" style="color: red"></div>

                    <div class="modal-footer d-flex justify-content-center border-0">
                        <button id="btnAtribuir" type="button" class="mx-2 button-style" style="width: 130px; height: 30px;">Confirmar</button>
                        <button type="button" id="btnCancelarAtribuir" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
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
                    <p class="fw-bold">Dados da última importação:</p>

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

                <div>
                    <span class="fw-bold">Notas:</span>
                    <ul>
                        <li>Os dados que já existam serão atualizados.</li>
                        <li>Os dados que não existam serão criados.</li>
                        <li>Os dados que não sejam fornecidos serão mantidos.</li>

                        <li>O ficheiro deve ser fornecido pela DSD (Distribuição de Serviço Docente).</li>
                        <li>O ficheiro deve ser um Excel (.xlsx ou .xls).</li>
                    </ul>
                </div>
                <form id="formCarregar" enctype="multipart/form-data">
                    <label for="fileUploadCarregar" class="form-label fw-bold text-decoration-underline">Selecione o ficheiro</label>
                    <input class="form-control" type="file" id="fileUploadCarregar" name="file" accept=".xlsx, .xls">
                </form>
                <div id="divMensagemErroCarregar" class="d-flex justify-content-center text-danger"></div>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 p-4">
                <h5 class="modal-title mx-auto" id="editarModalLabel">Editar Atribuição da UC '<span id="nomeUcEditarModal"></span>' com o Docente '<span id="nomeDocenteEditarModal"></span>'</h5>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="d-flex flex-column gap-3 justify-content-center">
                    <label for="inputEditarPerc" class="form-label">Digita a nova percentagem de horas:</label>
                    <div class="d-flex justify-content-center">
                        <input type="text" class="form-control w-25" id="inputEditarPerc" name="inputEditarPerc" value="">
                    </div>
                </div>
            </div>
            <div id="divMensagemErroEditar" class="d-flex justify-content-center text-danger"></div>

            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" id="btnConfirmarEditar" style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" id="btnCancelarModalEditar" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="mx-2 button-style-red" id="btnEliminarModal"
                style="width: 130px; height: 30px;" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</button>
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
                <button type="button" class="mx-2 button-style" id="btnEliminar" style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-lg" id="eliminarTodasModal" tabindex="-1" aria-labelledby="eliminarTodasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h3 class="modal-title mx-auto" id="eliminarTodasModalLabel">Confirmar eliminação de todas as atribuições</h3>
            </div>

            <div class="modal-body"></div>
            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" id="btnEliminarTodas" style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
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
    const deleteAllUrl = "{{ route('atribuicaoUcs.clear') }}";

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

    $("#fileUploadCarregar").val('');
    $('#confirmarBtn').click(function () {
        const form = $('#formCarregar')[0];
        $("#divMensagemErroCarregar").text('');

        fetch(importUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            body: new FormData(form)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.error) {
                $("#fileUploadCarregar").val('');
                $("#divMensagemErroCarregar").text(data.error);
            } else {
                const nrErros = Object.keys(data.errors).length;
                alert(data.message + '\nOcorreram ' + nrErros + ' erros.');
                location.reload();
            }
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

    $("#btnConfirmarEditar").click(function () {
        const numFunc = $("#editarModal").data('num-func');
        const codUc = $("#editarModal").data('cod-uc');
        const percHoras = $("#inputEditarPerc").val();

        $("#divMensagemErroEditar").text('');

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
        .then(response=>response.json())
        .then(data => {
            if(data.error){
                $("#divMensagemErroEditar").text(data.error);
            }else{
                console.log(data);
                alert("Atribuição atualizada com sucesso");
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Erro ao editar atribuição:', error);
        });
    });

    $("#btnCancelarModalEditar").click(function () {
        $("#inputEditarPerc").val("");
        $("#divMensagemErroEditar").text('');
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
            alert("Registo eliminado com sucesso");
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

        $("#divMessagemErroAtribuir").text('');

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
        .then(response => response.json())
        .then(data => {
            if (data.error){
                console.log(data);
                $("#divMessagemErroAtribuir").text(data.error);
            }else{
                console.log(data);
                alert("Registo criado com sucesso");
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Erro ao atribuir UC:', error);
        });
    });

    $("#btnCancelarAtribuir").click(function() {
        $("#inputAtribuirPerc").val("");
        $("#divMessagemErroAtribuir").text('');
    });

    $('#btnEliminarTodas').click(function () {
        fetch(deleteAllUrl, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token
            }
        })
        .then(() => {
            console.log(data);
            alert("Registos eliminados com sucesso");
            window.location.reload();
        })
        .catch(error => {
            console.error('Erro ao eliminar todas as atribuições:', error);
        });
    });

    //Pesquisar UC
    $(document).ready(function() {
        $('.searchInput').on('input', function() {
            var searchText = $(this).val();
            var counter = 0;

            $('tbody tr').each(function() {
                var nDocente = $(this).find('td:eq(0)').text();
                var nomeDocente = $(this).find('td:eq(1)').text();
                var nUC = $(this).find('td:eq(2)').text();
                var nomeUC = $(this).find('td:eq(3)').text();

                if (nDocente.includes(searchText) || nomeDocente.includes(searchText) || nUC.includes(searchText) || nomeUC.includes(searchText)) {
                    $(this).show();
                    counter += 1;
                } else {
                    $(this).hide();
                }
            });

            if (counter == 0) {
                $('.no-result').show();
                $('#noResultsMessage').removeClass('d-none').addClass('d-block');
            } else {
                $('.no-result').hide();
                $('#noResultsMessage').addClass('d-none').removeClass('d-block');
            }
        });
    });

    $("#carregarModal").on("hidden.bs.modal", function () {
        $("#divMensagemErroCarregar").text('');
        $("#fileUploadCarregar").val('');
    });
</script>
@endsection
