@extends('partials._document')
@section('head')
@include('partials._head', ['titulo' => "Gestor de Unidades Curriculares"])
@endsection
@section('header')
@include('partials._headerComissao')
@endsection

@section('content')
    <div class="container">
        <div class="mx-auto">
            <div class="ms-4 mt-3 mb-5">
                <nav class="" role="navigation" aria-label="Breadcrumb">
                    <ol class="breadcrumb d-none d-md-flex">
                        <li>
                            <span itemscope="" itemtype="">
                                <a itemprop="url" class="link-underline link-dark link-underline-opacity-0" href="{{route("comissao")}}">
                                    <span itemprop="title">Comissão</span>
                                </a>
                            </span>
                        </li>
                        <span class="separator mx-1"><i class="fa-angle-right fa"></i></span>
                        <li>
                            <span itemscope="" itemtype="">
                                <a itemprop="url" class="link-underline link-dark link-underline-opacity-0" title="UC" aria-current="page" href="{{route("gestorUcs")}}">
                                    <span itemprop="title">Unidades Curriculares</span>
                                </a>
                            </span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center gap-2 ms-4">
                    <div class="input-group rounded">
                        <input id="inputPesquisar" type="search" class="form-control rounded pesquisar-uc searchInput" placeholder="Código/Nome UC"
                            aria-label="Search">
                    </div>
                </div>
                <button type="button" class="button-style" style="width: 150px; height: 40px;" data-bs-toggle="modal"
                    data-bs-target="#adicionarUcModal">Adicionar UC</button>
            </div>
            <div>

                <div class=" mt-3 text-center tableFixHead" id="ucTableContainer">
                    <table class="table">
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
                                <tr class="hover listrow" data-id={{ $uc->cod_uc }}
                                    data-url={{ route('unidadeCurricular.show', $uc->cod_uc) }}>
                                    <td class = "fw-bold">{{ $uc->cod_uc }}</td>
                                    <td>{{ $uc->acn_uc }}</td>
                                    <td>{{ $uc->responsavel->nome_docente }}</td>
                                    <td>{{ $uc->nome_uc }}</td>
                                    <td>{{ $uc->cursos->implode('acron_curso', ', ') }}</td>
                                    <td>{{ $uc->horas_uc }}</td>
                                    <td>
                                        <img src="{{ asset('images/edit.svg') }}" alt="edit" data-id="{{ $uc->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @php
                        $block = count($unidadesCurriculares) == 0 ? "d-block" : "d-none";
                    @endphp
                    <p id="noResultsMessage" class="text-center mt-5 {{ $block }}">Sem resultados.</p>
                </div>
            </div>
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
                    <form id="formAdicionarUc">
                        <div class="container">
                            <div class="d-flex justify-content-center mb-4 rowAdd" id="adicionarRowOne">
                                <div class="d-flex gap-2 justify-content-center">
                                    <div>
                                        <label class="col-form-label">Cursos: </label>
                                    </div>
                                    <div class="gap-2" id="divAdicionarCurso">
                                        <div class="inputsize mb-1" style="height: 100px; overflow: auto; width: 630px">
                                            @foreach ($cursos as $curso)
                                                <div class="form-check">
                                                    <input class="form-check-input curso-checkbox" type="checkbox" id="cursos_{{ $curso->acron_curso }}" name="cursos[]" value="{{ $curso->acron_curso }}">
                                                    <label class="form-check-label" for="cursos_{{ $curso->acron_curso }}">
                                                        {{ $curso->nome_curso }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <span class="text-danger" id="spanAdicionarCurso">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-5 mb-4 rowAdd" id="adicionarRowTwo">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarNome" class="col-form-label">Nome UC: </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarNome">
                                        <input type="text" class="form-control" id="inputAdicionarNome" name="nome_uc"
                                            placeholder="">
                                        <span class="text-danger" id="spanAdicionarNome"></span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarCod" class="col-form-label">Cód. UC: </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarCod">
                                        <input type="text" class="form-control" id="inputAdicionarCod" name="cod_uc"
                                            placeholder="">
                                        <span class="text-danger" id="spanAdicionarCod">&nbsp;</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-4 rowAdd" id="adicionarRowThree">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarAcn" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarAcn">
                                        <input type="text" class="form-control" id="inputAdicionarAcn" name="acn_uc"
                                            placeholder="">
                                        <span class="text-danger" id="spanAdicionarAcn">&nbsp;</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarHoras" class="col-form-label">Horas: </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarHoras">
                                        <input type="text" class="form-control" id="inputAdicionarHoras" name="horas_uc"
                                            placeholder="">
                                        <span class="text-danger" id="spanAdicionarHoras">&nbsp;</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-4 rowAdd" id="adicionarRowFour">
                                <div class="d-flex gap-2">
                                    <div>
                                        <label for="selectAdicionarResponsavel" class="col-form-label">Doc. Responsável:
                                        </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarResponsavel">
                                        <select class="form-control" id="selectAdicionarResponsavel" name="num_func_responsavel">
                                            <option value="">Selecione o Docente</option>
                                            @foreach ($docentesResponsaveis as $docente)
                                                <option value="{{ $docente->num_func }}">{{ $docente->nome_docente }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="spanAdicionarResponsavel">&nbsp;</span>
                                    </div>
                                </div>
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


    <div class="modal modal-lg" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
            <div class="modal-content border-0">
                <div class="modal-header border-0 p-4">
                    <h5 class="modal-title mx-auto" id="editarModalLabel"> Editar Unidade Curricular</h5>
                </div>
                <div class="modal-body">
                    <form id="formEditarUc">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex gap-2 justify-content-center mb-4 rowAdd" id="editarRowOne">
                                    <div>
                                        <label class="col-form-label">Cursos: </label>
                                    </div>
                                    <div class="gap-2" id="divEditarCurso">
                                        <div class="inputsize mb-1" style="height: 100px; overflow: auto; width: 630px">
                                            @foreach ($cursos as $curso)
                                                <div class="form-check" >
                                                    <input class="form-check-input curso-checkbox" type="checkbox" id="curso_{{ $curso->acron_curso }}" 
                                                    name="cursos" value="{{ $curso->acron_curso }}">
                                                    <label class="form-check-label" for="curso_{{ $curso->acron_curso }}">
                                                        {{ $curso->nome_curso }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <span class="text-danger" id="spanEditarCurso">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-5 mb-4 rowAdd" id="editarRowTwo">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarNome" class="col-form-label">Nome UC: </label>
                                    </div>
                                    <div class="inputsize" id="divEditarNome">
                                        <input type="text" class="form-control" id="inputEditarNome" name="nome_uc"
                                            placeholder="">
                                        <span class="text-danger" id="spanEditarNome">&nbsp;</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarCod" class="col-form-label">Cód. UC: </label>
                                    </div>
                                    <div class="inputsize" id="divEditarCod">
                                        <input type="text" class="form-control" id="inputEditarCod" name="cod_uc"
                                            placeholder="" disabled>
                                        <span class="text-danger" id="spanEditarCod">&nbsp;</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-4 rowAdd" id="editarRowThree">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarAcn" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div class="inputsize" id="divEditarAcn">
                                        <input type="text" class="form-control" id="inputEditarAcn" name="acn_uc"
                                            placeholder="">
                                        <span class="text-danger" id="spanEditarAcn">&nbsp;</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarHoras" class="col-form-label">Horas: </label>
                                    </div>
                                    <div class="inputsize" id="divEditarHoras">
                                        <input type="text" class="form-control" id="inputEditarHoras" name="horas_uc"
                                            placeholder="">
                                        <span class="text-danger" id="spanEditarHoras">&nbsp;</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-4 rowAdd" id="editarRowFour">
                                <div class="d-flex gap-2">
                                    <div>
                                        <label for="selectEditarResponsavel" class="col-form-label">Doc. Responsável:
                                        </label>
                                    </div>
                                    <div class="inputsize" id="divEditarResponsavel">
                                        <select class="form-control" id="selectEditarResponsavel" name="num_func_responsavel">
                                            <option value="">Selecione o Docente</option>
                                            @foreach ($docentesResponsaveis as $docente)
                                                <option value="{{ $docente->num_func }}">{{ $docente->nome_docente }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="spanEditarResponsavel">&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center border-0">
                            <button type="button" id="btnEditarUc" class="mx-2 button-style"
                                style="width: 130px; height: 30px;">Confirmar</button>
                            <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="mx-2 button-style-red" id="btnEliminarModal"
                                style="width: 130px; height: 30px;" data-bs-toggle="modal"
                                data-bs-target="#eliminarModal">Eliminar</button>
                        </div>
                    </form>
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
        const insertUCUrl = '{{ route ('adicionar.unidadeCurricular') }}';
        const updateUCUrl = "{{ route('update.unidadeCurricular', ':id') }}";
        const deleteUCUrl = "{{ route('eliminar.unidadeCurricular', ':id') }}";
        const token = '{{ csrf_token() }}';

        //Adicionar UC
        document.addEventListener('DOMContentLoaded', function() {
            const btnAdicionarUc = document.getElementById('btnAdicionarUc');
            const adicionarUcModal = document.getElementById('adicionarUcModal');

            btnAdicionarUc.addEventListener('click', function(event) {
                const selectCurso = document.querySelectorAll(".curso-checkbox");
                let selectedOptions = [];
                if (selectCurso.length > 0) {
                    selectedOptions = Array.from(selectCurso).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
                }


                const selectNomeUC = document.getElementById('inputAdicionarNome').value;
                const selectCodUC = document.getElementById('inputAdicionarCod').value;
                const selectACNUC = document.getElementById('inputAdicionarAcn').value;
                const selectHoras = document.getElementById('inputAdicionarHoras').value;
                const selectResponsavel = document.getElementById('selectAdicionarResponsavel').value;

                var spanCurso = document.getElementById('spanAdicionarCurso');
                var spanNomeUC = document.getElementById('spanAdicionarNome');
                var spanCodUC = document.getElementById('spanAdicionarCod');
                var spanACNUC = document.getElementById('spanAdicionarAcn');
                var spanHoras = document.getElementById('spanAdicionarHoras');
                var spanResponsavel = document.getElementById('spanAdicionarResponsavel');

                //innertext = ""
                spanCurso.innerHTML = "&nbsp;";
                spanNomeUC.innerHTML = "&nbsp;";
                spanCodUC.innerHTML = "&nbsp;";
                spanACNUC.innerHTML = "&nbsp;";
                spanHoras.innerHTML = "&nbsp;";
                spanResponsavel.innerHTML = "&nbsp;";

                const data = {
                    curso_uc: selectedOptions,
                    nome_uc: selectNomeUC,
                    cod_uc: selectCodUC,
                    acn_uc: selectACNUC,
                    horas_uc: selectHoras,
                    num_func_resp: selectResponsavel
                };

                console.log(data);
                
                fetch(insertUCUrl, {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        console.log(data.errors);
                        Object.keys(data.errors).forEach(errorKey => {
                            var error = data.errors[errorKey];
                            switch (errorKey) {
                                case "curso_uc":
                                    spanCurso.textContent = error;
                                    break;
                                case "nome_uc":
                                    spanNomeUC.textContent = error;
                                    break;
                                case "cod_uc":
                                    spanCodUC.textContent = error;
                                    break;
                                case "acn_uc":
                                    spanACNUC.textContent = error;
                                    break;
                                case "horas_uc":
                                    spanHoras.textContent = error;
                                    break;
                                case "num_func_resp":
                                    spanResponsavel.textContent = error;
                                    break;
                            }
                        });
                    }else{
                        alert(data.message);
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Erro ao adicionar Unidade Curricular:', error);
                    alert('Erro ao adicionar Unidade Curricular. Por favor, tente novamente.');
                });
            });


            //Resetar Modal
            adicionarUcModal.addEventListener('hidden.bs.modal', function () {
                document.getElementById('inputAdicionarNome').value = '';
                document.getElementById('inputAdicionarCod').value = '';
                document.getElementById('inputAdicionarAcn').value = '';
                document.getElementById('inputAdicionarHoras').value = '';
                document.getElementById('selectAdicionarResponsavel').value = '';

                var checkboxes = document.querySelectorAll('.curso-checkbox');
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
                
                var spans = document.querySelectorAll('.text-danger');
                spans.forEach(function (span) {
                    span.innerHTML = "&nbsp;";
                });
            });

            editarModal.addEventListener('hidden.bs.modal', function () {
                var checkboxes = document.querySelectorAll('.curso-checkbox');
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
                
                var spans = document.querySelectorAll('.text-danger');
                spans.forEach(function (span) {
                    span.innerHTML = "&nbsp;";
                });
            });
        });

        //Editar UC
        var codUC = "";

        $(document).ready(function () {
            $('body').on('click', 'tr', function () {
                var userURL = $(this).data('url');
                $.get(userURL, function (data) {
                    console.log(data);
                    $('#editarModal').modal('show');
                    $('#inputEditarNome').val(data.uc.nome_uc);
                    $('#inputEditarCod').val(data.uc.cod_uc);
                    $('#inputEditarAcn').val(data.uc.acn_uc);
                    $('#inputEditarHoras').val(data.uc.horas_uc);
                    $('#selectEditarResponsavel').val(data.uc.num_func_resp);
                    data.cursos.forEach(curso => {
                        $('#curso_' + curso.acron_curso).prop('checked', true);
                    });
                    codUC = data.uc.cod_uc;
                });
            });
        });

        document.getElementById("btnEditarUc").onclick = function() {
            const selectCurso = document.querySelectorAll(".curso-checkbox");
            let selectedOptions = [];
            if (selectCurso.length > 0) {
                selectedOptions = Array.from(selectCurso).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
            }


            const selectNomeUC = document.getElementById('inputEditarNome').value;
            const selectCodUC = document.getElementById('inputEditarCod').value;
            const selectACNUC = document.getElementById('inputEditarAcn').value;
            const selectHoras = document.getElementById('inputEditarHoras').value;
            const selectResponsavel = document.getElementById('selectEditarResponsavel').value;

            var spanCurso = document.getElementById('spanEditarCurso');
            var spanNomeUC = document.getElementById('spanEditarNome');
            var spanACNUC = document.getElementById('spanEditarAcn');
            var spanHoras = document.getElementById('spanEditarHoras');
            var spanResponsavel = document.getElementById('spanEditarResponsavel');
            
            //innertext = ""
            spanCurso.innerHTML = "&nbsp;";
            spanNomeUC.innerHTML = "&nbsp;";
            spanACNUC.innerHTML = "&nbsp;";
            spanHoras.innerHTML = "&nbsp;";
            spanResponsavel.innerHTML = "&nbsp;";

            const data = {
                nome_uc: selectNomeUC,
                curso_uc: selectedOptions,
                acn_uc: selectACNUC,
                horas_uc: selectHoras,
                num_func_resp: selectResponsavel
            };

            console.log(data);
            const url = updateUCUrl.replace(':id', selectCodUC);

            fetch(url, {
                method: 'PUT',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    console.log(data.errors);
                    Object.keys(data.errors).forEach(errorKey => {
                        var error = data.errors[errorKey];
                        switch (errorKey) {
                            case "curso_uc":
                                spanCurso.textContent = error;
                                break;
                            case "nome_uc":
                                spanNomeUC.textContent = error;
                                break;
                            case "acn_uc":
                                spanACNUC.textContent = error;
                                break;
                            case "horas_uc":
                                spanHoras.textContent = error;
                                break;
                            case "num_func_resp":
                                spanResponsavel.textContent = error;
                                break;
                        }
                    });
                }else{
                    alert(data.message);
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Erro ao adicionar Unidade Curricular:', error);
                alert('Erro ao adicionar Unidade Curricular. Por favor, tente novamente.');
            });
        }
        
        //Eliminar UC
        document.getElementById("btnEliminar").onclick = function() {
            console.log(codUC);
            const url = deleteUCUrl.replace(':id', codUC);
            console.log(url);

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert(data.message);
                location.reload();
            })
            .catch(error => {
                console.error('Erro ao eliminar Unidade Curricular:', error);
                alert('Erro ao eliminar Unidade Curricular. Por favor, tente novamente.');
            });
        }


        //Pesquisar UC
        $(document).ready(function() {
            $('.pesquisar-uc').on('input', function() {
                var searchText = $(this).val();
                var counter = 0;

                $('tbody tr').each(function() {
                    var codUC = $(this).find('td:eq(0)').text();
                    var nomeUC = $(this).find('td:eq(3)').text();

                    if (codUC.includes(searchText) || nomeUC.includes(searchText)) {
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
