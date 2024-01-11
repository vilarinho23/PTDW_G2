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
                        <input id="inputPesquisar" type="search" class="form-control rounded pesquisar-uc searchInput" placeholder="Código UC"
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
                        @csrf
                        <div class="container">
                            <div class="d-flex justify-content-center mb-4 rowAdd" id="adicionarRowOne">
                                <div class="d-flex gap-2 justify-content-center">
                                    <div>
                                        <label for="selectAdicionarCurso" class="col-form-label">Cursos: </label>
                                    </div>
                                    <div class="gap-2" id="divAdicionarCurso">
                                        <div class="inputsize mb-1" style="height: 100px; overflow: auto; width: 630px">
                                            @foreach ($cursos as $curso)
                                                <div class="form-check">
                                                    <input class="form-check-input curso-checkbox" type="checkbox" id="cursos_{{ $curso->acron_curso }}" name="cursos[]" value="{{ $curso->acron_curso }}">
                                                    <label class="form-check-label" for="curso_{{ $curso->acron_curso }}">
                                                        {{ $curso->nome_curso }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-5 mb-5 rowAdd" id="adicionarRowTwo">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarNome" class="col-form-label">Nome UC: </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarNome">
                                        <input type="text" class="form-control" id="inputAdicionarNome" name="nome_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarCod" class="col-form-label">Cód. UC: </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarCod">
                                        <input type="text" class="form-control" id="inputAdicionarCod" name="cod_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-5 rowAdd" id="adicionarRowThree">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarAcn" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarAcn">
                                        <input type="text" class="form-control" id="inputAdicionarAcn" name="acn_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputAdicionarHoras" class="col-form-label">Horas: </label>
                                    </div>
                                    <div class="inputsize" id="divAdicionarHoras">
                                        <input type="text" class="form-control" id="inputAdicionarHoras" name="horas_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-5 rowAdd" id="adicionarRowFour">
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
                                <div class="d-flex gap-2 justify-content-center mb-5 rowAdd" id="editarRowOne">
                                    <div>
                                        <label for="selectEditarCurso" class="col-form-label">Cursos: </label>
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
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-5 mb-5 rowAdd" id="editarRowTwo">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarNome" class="col-form-label">Nome UC: </label>
                                    </div>
                                    <div class="inputsize" id="divEditarNome">
                                        <input type="text" class="form-control" id="inputEditarNome" name="nome_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarCod" class="col-form-label">Cód. UC: </label>
                                    </div>
                                    <div class="inputsize" id="divEditarCod">
                                        <input type="text" class="form-control" id="inputEditarCod" name="cod_uc"
                                            placeholder="" disabled>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-5 rowAdd" id="editarRowThree">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarAcn" class="col-form-label">ACN UC: </label>
                                    </div>
                                    <div class="inputsize" id="divEditarAcn">
                                        <input type="text" class="form-control" id="inputEditarAcn" name="acn_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <div>
                                        <label for="inputEditarHoras" class="col-form-label">Horas: </label>
                                    </div>
                                    <div class="inputsize" id="divEditarHoras">
                                        <input type="text" class="form-control" id="inputEditarHoras" name="horas_uc"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="d-flex gap-2 w-25 justify-content-end "></div>
                            </div>

                            <div class="d-flex justify-content-center gap-5 mb-5 rowAdd" id="editarRowFour">
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

                var spanCurso = document.getElementById('divAdicionarCurso');
                var spanNomeUC = document.getElementById('divAdicionarNome');
                var spanCodUC = document.getElementById('divAdicionarCod');
                var spanACNUC = document.getElementById('divAdicionarAcn');
                var spanHoras = document.getElementById('divAdicionarHoras');
                var spanResponsavel = document.getElementById('divAdicionarResponsavel');

                var adicionarRowOne = document.getElementById('adicionarRowOne');
                var adicionarRowTwo = document.getElementById('adicionarRowTwo');
                var adicionarRowThree = document.getElementById('adicionarRowThree');
                var adicionarRowFour = document.getElementById('adicionarRowFour');

                validarInputs(adicionarRowOne, spanCurso, 'spanAdicionarCurso', selectedOptions.length === 0);
                validarInputs(adicionarRowTwo, spanNomeUC, 'spanAdicionarNome', selectNomeUC.trim() === "");
                validarInputs(adicionarRowTwo, spanCodUC, 'spanAdicionarCod', selectCodUC.trim() === "");
                validarInputs(adicionarRowThree, spanACNUC, 'spanAdicionarAcn', selectACNUC.trim() === "");
                validarInputs(adicionarRowThree, spanHoras, 'spanAdicionarHoras', selectHoras.trim() === "");
                validarInputs(adicionarRowFour, spanResponsavel, 'spanAdicionarResponsavel', selectResponsavel.trim() === "");

                let hasError = selectedOptions.length === 0 || selectNomeUC.trim() === "" || selectCodUC.trim() === "" || 
                   selectACNUC.trim() === "" || selectHoras.trim() === "" || selectResponsavel.trim() === "";

                if (hasError) {
                    console.log("Form has errors");
                    return;
                }

                const data = {
                    curso_uc: selectedOptions,
                    nome_uc: selectNomeUC,
                    cod_uc: selectCodUC,
                    acn_uc: selectACNUC,
                    horas_uc: selectHoras,
                    num_func_resp: selectResponsavel
                };

                console.log(data);
                
                fetch('{{ route ('adicionar.unidadeCurricular') }}', {
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
                    location.reload();
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
                    span.remove();
                });

                var rows = document.querySelectorAll('.rowAdd');
                rows.forEach(function (row) {
                    row.classList.remove('mb-4');
                    row.classList.add('mb-5');
                });
            });

            editarModal.addEventListener('hidden.bs.modal', function () {
                document.getElementById('inputEditarNome').value = '';
                document.getElementById('inputEditarCod').value = '';
                document.getElementById('inputEditarAcn').value = '';
                document.getElementById('inputEditarHoras').value = '';
                document.getElementById('selectEditarResponsavel').value = '';

                var checkboxes = document.querySelectorAll('.curso-checkbox');
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
                
                var spans = document.querySelectorAll('.text-danger');
                spans.forEach(function (span) {
                    span.remove();
                });

                var rows = document.querySelectorAll('.rowAdd');
                rows.forEach(function (row) {
                    row.classList.remove('mb-4');
                    row.classList.add('mb-5');
                });
            });
        });

        //Validar se input´s do modal têm valores
        function validarInputs(row, element, spanId, isEmpty) {
            var spanElement = document.getElementById(spanId);
            if (isEmpty) {
                if (!spanElement) {
                    var span = document.createElement('span');
                    span.textContent = "Tem de introduzir um valor!";
                    span.id = spanId;
                    span.classList = "text-danger";
                    element.appendChild(span);
                    row.classList.remove('mb-5');
                    row.classList.add('mb-4');
                }
            } else {
                if (spanElement) {
                    spanElement.remove();

                    var otherErrors = Array.from(row.children).some(function(child) {
                        var childSpan = child.querySelector('span');
                        return childSpan && childSpan.id && childSpan.id !== spanId;
                    });

                    if (!otherErrors) {
                        row.classList.remove('mb-4');
                        row.classList.add('mb-5');
                    }
                }
            }
        }




        //Editar UC
        const updateUCUrl = "{{ route('update.unidadeCurricular', ':id') }}";
        const deleteUCUrl = "{{ route('eliminar.unidadeCurricular', ':id') }}";
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

            var spanCurso = document.getElementById('divEditarCurso');
            var spanNomeUC = document.getElementById('divEditarNome');
            var spanACNUC = document.getElementById('divEditarAcn');
            var spanHoras = document.getElementById('divEditarHoras');
            var spanResponsavel = document.getElementById('divEditarResponsavel');

            var editarRowOne = document.getElementById('editarRowOne');
            var editarRowTwo = document.getElementById('editarRowTwo');
            var editarRowThree = document.getElementById('editarRowThree');
            var editarRowFour = document.getElementById('editarRowFour');

            validarInputs(editarRowOne, spanCurso, 'spanEditarCurso', selectedOptions.length === 0);
            validarInputs(editarRowTwo, spanNomeUC, 'spanEditarNome', selectNomeUC.trim() === "");
            validarInputs(editarRowThree, spanACNUC, 'spanEditarAcn', selectACNUC.trim() === "");
            validarInputs(editarRowThree, spanHoras, 'spanEditarHoras', selectHoras.trim() === "");
            validarInputs(editarRowFour, spanResponsavel, 'spanEditarResponsavel', selectResponsavel.trim() === "");

            let hasError = selectedOptions.length === 0 || selectNomeUC.trim() === "" || selectCodUC.trim() === "" || 
                selectACNUC.trim() === "" || selectHoras.trim() === "" || selectResponsavel.trim() === "";

            if (hasError) {
                console.log("Form has errors");
                return;
            }
            const data = {
                nome_uc: selectNomeUC,
                curso_uc: selectedOptions,
                cod_uc: selectCodUC,
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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert(data.message);
                location.reload();
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
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
            
        });
    </script>
@endsection
