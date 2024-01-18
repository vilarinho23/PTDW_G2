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
            <div class="d-flex align-items-center gap-2 ms-4 w-25   ">
                <div class="input-group rounded pe-3 w-75">
                    <input id="inputPesquisar" type="search" class="form-control rounded searchInput" placeholder="Número/Nome Docente" aria-label="Search">
                </div>
            </div>
            <button type="button" class="button-style" style="width: 200px; height: 40px;" data-bs-toggle="modal" data-bs-target="#adicionarModal">Adicionar docente</button>
        </div>
        <div>

            <div class="container mt-3 text-center tableFixHead">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Nome Docente</th>
                            <th>ACN Docente</th>
                            <th>Contacto</th>
                            <th>E-mail</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($docentes as $docente)
                        <tr class="listrow" data-id={{$docente->num_func}} data-url={{ route("docente.show", $docente->num_func) }}>
                            <td class="fw-bold">{{ $docente->num_func }}</td>
                            <td>{{ $docente->nome_docente }}</td>
                            <td>{{ $docente->acn_docente }}</td>
                            <td>{{ $docente->telef_docente }}</td>
                            <td>{{ $docente->email_docente }}</td>
                            <td><img src="{{ asset('images/edit.svg') }}" alt="edit"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @php
                    $block = count($docentes) == 0 ? "d-block" : "d-none";
                @endphp
                <p id="noResultsMessage" class="text-center mt-5 {{ $block }}">Sem resultados.</p>
            </div>
        </div>
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
                    <div class="row mt-2 g-3 align-items-center">
                        <div class="col-sm-2">
                            <label for="inputAdicionarContacto" class="col-form-label">Contacto</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="inputAdicionarContacto" placeholder="">
                        </div>
                    </div>
                    <div class="row mt-2 g-3 align-items-center">
                        <div class="col-sm-2">
                            <label for="inputAdicionarEmail" class="col-form-label">E-mail</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="inputAdicionarEmail" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center" id="mensagemErroAdicionar" style="color: red;"></div>

            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" id="btnConfirmarAdicionar" class="mx-2 button-style"
                    style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" id="btnCancelarModalAdicionar" class="mx-2 button-style" style="width: 130px; height: 30px;"
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
                <div class="container-fluid">
                    <div class="row g-3 align-items-center">
                        <div class="col-sm-2">
                            <label for="inputEditarNFuncionario" class="col-form-label">Nº funcionário</label>
                        </div>
                        <div class="col-sm">
                            <input type="text" class="form-control" id="inputEditarNFuncionario" name="num_func" disabled>
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
                    <div class="row mt-2 g-3 align-items-center">
                        <div class="col-sm-2">
                            <label for="inputEditarContacto" class="col-form-label">Contacto</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="inputEditarContacto" >
                        </div>
                    </div>
                    <div class="row mt-2 g-3 align-items-center">
                        <div class="col-sm-2">
                            <label for="inputEditarEmail" class="col-form-label">E-mail</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="inputEditarEmail" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center" id="mensagemErroEditar" style="color: red;"></div>

            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" id="btnConfirmarEditar"
                    style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" id="btnCancelarModalEditar" class="mx-2 button-style" style="width: 130px; height: 30px;"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="mx-2 button-style-red" id="btnEliminarModal"
                style="width: 130px; height: 30px;" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</button>
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
    const updateDocenteUrl = "{{ route('editar.docente', ':id') }}";
    const insertDocenteUrl = "{{ route('adicionar.docente') }}";
    const deleteDocenteUrl = "{{ route('eliminar.docente', ':id') }}";
    const token = '{{ csrf_token() }}';

    $(document).ready(function () {
        $('body').on('click', 'tr', function () {
            var userURL = $(this).data('url');
            $.get(userURL, function (data) {
                $('#editarModal').modal('show');
                $('#inputEditarNFuncionario').val(data.num_func);
                $('#inputEditarNome').val(data.nome_docente);
                $('#inputEditarAcn').val(data.acn_docente);
                $('#inputEditarContacto').val(data.telef_docente);
                $('#inputEditarEmail').val(data.email_docente);

                $(".modal-body > form").attr(
                    "action",
                    updateDocenteUrl.replace(':id', data.num_func)
                );
            });
        });
    });
    document.getElementById("btnConfirmarEditar").onclick = function() {

        const id = document.getElementById('inputEditarNFuncionario').value;

        const data = {
            num_func: id,
            nome_docente: document.getElementById('inputEditarNome').value,
            acn_docente: document.getElementById('inputEditarAcn').value,
            telef_docente: document.getElementById('inputEditarContacto').value,
            email_docente: document.getElementById('inputEditarEmail').value
        };
        let divMensagensErro = document.getElementById('mensagemErroEditar');

        const url = updateDocenteUrl.replace(':id', id);
        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
            divMensagensErro.innerText = data.error;
            } else {
                console.log('Dados enviados com sucesso:', data);
                $('#editarModal').modal('hide');
                alert('Docente editado com sucesso!');
                location.reload();
            }
        })
        .catch(error => {
            console.error('Erro ao enviar dados:', error);
        });
    }

    document.getElementById("btnCancelarModalEditar").onclick = function() {
        document.getElementById('inputEditarNFuncionario').value = '';
        document.getElementById('inputEditarNome').value = '';
        document.getElementById('inputEditarAcn').value = '';
        document.getElementById('inputEditarContacto').value = '';
        document.getElementById('inputEditarEmail').value = '';
        document.getElementById('mensagemErroEditar').innerText = '';
    };

    document.getElementById('btnConfirmarAdicionar').onclick = function() {
        const data = {
            num_func: document.getElementById('inputAdicionarNFuncionario').value,
            nome_docente: document.getElementById('inputAdicionarNome').value,
            acn_docente: document.getElementById('inputAdicionarAcn').value,
            telef_docente: document.getElementById('inputAdicionarContacto').value,
            email_docente: document.getElementById('inputAdicionarEmail').value
        };

        let divMensagensErro = document.getElementById('mensagemErroAdicionar');

        fetch(insertDocenteUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                divMensagensErro.innerText = data.error;
            } else {
                console.log('Dados enviados com sucesso:', data);
                $('#adicionarModal').modal('hide');
                alert('Docente adicionado com sucesso!');
                location.reload();
            }
        })
        .catch(error => {
            console.error('Erro ao enviar dados:', error);
        });
    };

    document.getElementById('btnCancelarModalAdicionar').onclick = function() {
        document.getElementById('inputAdicionarNFuncionario').value = '';
        document.getElementById('inputAdicionarNome').value = '';
        document.getElementById('inputAdicionarAcn').value = '';
        document.getElementById('inputAdicionarContacto').value = '';
        document.getElementById('inputAdicionarEmail').value = '';
        document.getElementById('mensagemErroAdicionar').innerText = '';
    };


    document.getElementById("btnEliminar").onclick = function() {

        const id = document.getElementById('inputEditarNFuncionario').value;

        const url = deleteDocenteUrl.replace(':id', id);
        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            }
        })
        .then(response => {
            if (response.ok) {
                console.log('Docente excluído com sucesso');
                $('#editarModal').modal('hide');
                alert('Docente excluído com sucesso!');
                location.reload();
            } else {
                console.error('Erro ao excluir docente');
            }
        })
        .catch(error => {
            console.error('Erro ao excluir docente:', error);
        });

    }

    $(document).ready(function () {
        $('#inputPesquisar').on('input', function () {
            var searchText = $(this).val();
            var counter = 0;
            
            $('tbody tr').each(function () {
                var numFunc = $(this).find('td:eq(0)').text();
                var nomeDocente = $(this).find('td:eq(1)').text();

                if (numFunc.includes(searchText) || nomeDocente.includes(searchText)) {
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
</script>


@endsection
