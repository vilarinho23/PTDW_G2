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
                    <input id="inputPesquisar" type="search" class="form-control rounded" placeholder="Search" aria-label="Search">
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
                        @foreach ($docentes as $docente)
                        <tr data-id={{$docente->num_func}} data-url={{ route("docente.show",$docente->num_func) }}>
                            <td class="fw-bold" scope="row">{{ $docente->num_func }}</td>
                            <td>{{ $docente->nome_docente }}</td>
                            <td>{{ $docente->acn_docente }}</td>
                            <td><img src="{{ asset('images/edit.svg') }}" alt="edit"></td>
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

<div class="modal modal-lg" id="adicionarModal" tabindex="-1" aria-labelledby="adicionarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto" id="adicionarModalLabel">Adicionar Novo Docente</h5>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('adicionar.docente') }}">
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
                <button type="button" id="btnConfirmar" class="mx-2 button-style"
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
                <form method="PUT" action="/docente/{{$docente->num_func}}">
                    @csrf
                    <div class="container-fluid">
                        <div class="row g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputEditarNFuncionario" class="col-form-label">Nº funcionário</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="inputEditarNFuncionario" name="num_func" >
                            </div>
                        </div>
                        <div class="row mt-2 g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputEditarNome" class="col-form-label">Nome docente</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputEditarNome" >
                            </div>
                        </div>
                        <div class="row mt-2 g-3 align-items-center">
                            <div class="col-sm-2">
                                <label for="inputEditarAcn" class="col-form-label">ACN docente</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputEditarAcn" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" id="btnCfm"
                    style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                    data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('body').on('click', 'tr', function () {
            var userURL = $(this).data('url');
            $.get(userURL, function (data) {
                $('#editarModal').modal('show');
                $('#inputEditarNFuncionario').val(data.num_func);
                $('#inputEditarNome').val(data.nome_docente);
                $('#inputEditarAcn').val(data.acn_docente);

                $(".modal-body > form").attr("action", `/docente/${data.num_func}`);

            });
        });
    });
    document.getElementById("btnCfm").onclick = function() {

        const id = document.getElementById('inputEditarNFuncionario').value;

        const data = {
            num_func: id,
            nome_docente: document.getElementById('inputEditarNome').value,
            acn_docente: document.getElementById('inputEditarAcn').value
        };
        console.log(data);

        fetch('/comissao/docente/' + id, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
                console.log('Dados enviados com sucesso:', data);
                $('#editarModal').modal('hide');
        })
        .catch(error => {
            console.error('Erro ao enviar dados:', error);
        });
        
    }

    document.getElementById('btnConfirmar').addEventListener('click', function () {
        
        const data = {
            num_func: document.getElementById('inputAdicionarNFuncionario').value,
            nome_docente: document.getElementById('inputAdicionarNome').value,
            acn_docente: document.getElementById('inputAdicionarAcn').value
        };
        console.log(data);

        fetch('{{ route('adicionar.docente') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify(data)
        })
        .then(response => console.log(response))
        .then(data => {
            console.log('Dados enviados com sucesso:', data);
            $('#adicionarModal').modal('hide');
        })
        .catch(error => {
            console.error('Erro ao enviar dados:', error);
        });
    });

    $(document).ready(function () {
        $('#inputPesquisar').on('keyup', function () {
            var searchText = $(this).val().toLowerCase();

            $('tbody tr').each(function () {
                var numFunc = $(this).data('id').toString().toLowerCase();
                var nomeDocente = $(this).find('td:eq(1)').text().toLowerCase();
                var acnDocente = $(this).find('td:eq(2)').text().toLowerCase();

                if (numFunc.includes(searchText) || nomeDocente.includes(searchText) || acnDocente.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>


@endsection
