@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Gestor de Submissões"])
@endsection
@section('header')
@include('partials._headerComissao')
@endsection

@section('content')
<div class="container-sm">
    <div class="d-flex pt-5 pb-3 text-center justify-content-center w-75 mx-auto gap-5" >
        <div class="d-flex align-items-center">
            <div class="border rounded d-flex flex-column gap-2 px-4 py-2 ms-2 border border-dark border-2 hover" style="background-color:#D9D9D9" id="btnsubmetidas">
                <p class="m-0 px-5"><strong>Submetidas</strong></p>
                <p class="m-0 fs-5">{{ $nrSubmissoes }}</p>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="border rounded d-flex flex-column gap-2 px-4 py-2 ms-5 hover" style="background-color:#D9D9D9" id="btnpendente">
                <p class="m-0 px-4"><strong>Não Submetidas</strong></p>
                <p class="m-0 fs-5">{{ $nrPorSubmeter }}</p>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center mx-auto justify-content-around mt-4 w-75">
        <div class="h-50">
            <button type="button" class="button-style" style="width: 230px;height: 40px" data-bs-toggle="modal" data-bs-target="#modalTerminar">Definir Data de Conclusão</button>
        </div>
        <div class="h-50">
            <button id="transferirBtn" type="button" class="button-style" style="width: 230px;height: 40px">Eliminar Submissões</button>
        </div>
        <div class="h-50">
            <button id="csrirBtn" type="button" class="button-style" style="width: 230px;height: 40px">Transferir Submissões</button>
        </div>
    </div>
    <div class="w-75 mx-auto mt-5" id="tableContainer">
        <div class="d-flex justify-content-between mt-3">
            <div class="input-group w-25">
                <input type="search" class="form-control rounded searchInput" id="searchInput" placeholder="Número/Nome Docente" aria-label="Search">
            </div>
            <div class="d-flex align-items-center w-25" id="ordemBtn">
                <label for="sortDropdown" class="me-2">Ordem:</label>
                <select class="form-select" id="sortDropdown">
                    <option value="desc">Mais Recente</option>
                    <option value="asc">Mais Antigo</option>
                </select>
            </div>

            <div class="d-flex align-items-center" id="dataContainer">
                @if ($dataConclusao)
                    <p class="m-0"><strong>Data de Conclusão:</strong> {{ $dataConclusao }}</p>
                @else
                    <p class="m-0"><strong>Data de Conclusão:</strong> Sem Data Definida</p>
                @endif
            </div>
        </div>
        <div class="tableFixHead mt-2">
            <table class="table"  id="tableSubmissoes">
                <thead>
                    <tr>
                        <th class="text-center col-3">Nº</th>
                        <th class="text-start">Nome Docente</th>
                        <th class="text-center aligned-td">Data</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissoes->sortBy('data_submissao', SORT_REGULAR, false) as $item)
                        <tr class="hover listrow" data-num-func="{{ $item->num_func }}">
                            <td class="col-3">{{ $item->num_func }}</td>
                            <td class="text-start">{{ $item->nome_docente }}</td>
                            <td class="aligned-td">{{ $item->data_submissao->format('d-m-Y') }}</td>
                            <td><img src="{{ asset('images/arrow.svg') }}" alt="Ver Mais"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @php
                $block = count($submissoes) == 0 ? "d-block" : "d-none";
            @endphp
            <p id="noResultsMessageSubmissoes" class="text-center mt-5 {{ $block }}">Sem resultados.</p>
            
            <table class="table" id="tablePendentes">
                <thead>
                    <tr>
                        <th class="text-center col-3">Nº</th>
                        <th class="text-start">Nome Docente</th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendentes as $item)
                        <tr class="hover listrow" data-num-func="{{ $item->num_func }}">
                            <td class="col-3">{{ $item->num_func }}</td>
                            <td class="text-start">{{ $item->nome_docente }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @php
                $block = count($pendentes) == 0 ? "d-block" : "d-none";
            @endphp
            <p id="noResultsMessagePendentes" class="text-center mt-5 {{ $block }}">Sem resultados.</p>
        </div>
    </div>

</div>

<div class="modal" id="modalTerminar" tabindex="-1" aria-labelledby="modalTerminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto" id="modalTerminarLabel">Definir Data de Conclusão</h5>
            </div>
            <form id="updateForm">
                @csrf
                <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker gap-3">
                    <label for="escolher-data" class="d-flex justify-content-center align-items-center mb-3 ml-2">
                        Data:
                        <input id="escolher-data" type="date" name="escolher-data" class="ms-3">
                    </label>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" onclick="updateData()" class="mx-2 button-style" style="width: 130px; height: 30px;">Confirmar</button>
                    <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var lista = [];
    document.addEventListener('DOMContentLoaded', function() {
        $("#tablePendentes").hide();
        var searchInput = document.getElementById('searchInput');
        var tableRows = document.querySelectorAll('.table tbody tr');
        var sortDropdown = document.getElementById('sortDropdown');

        $('.listrow').click(function () {
            var numFuncValue = $(this).data('num-func');
            console.log(numFuncValue);

            const url = "{{ route('submissoes.restricoes', '') }}/" + numFuncValue;

            window.location.href = url;
        });

        function getlistNumbers(){
            var docentes = @json($submissoes);
            for (var docente in docentes) {
                lista.push(docentes[docente]["num_func"]);
            }
        }

        function sortTableByDate(order) {
            var tbody = document.querySelector('.table tbody');
            var rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort(function(a, b) {
                var dateA = parseDate(a.querySelector('td:nth-last-child(2)').textContent);
                var dateB = parseDate(b.querySelector('td:nth-last-child(2)').textContent);

                if (order === 'asc') {
                    return dateA - dateB;
                } else {
                    return dateB - dateA;
                }
            });
            rows.forEach(function(row) {
                tbody.appendChild(row);
            });
        }

        function parseDate(dateString) {
            var parts = dateString.split('-');
            return new Date(parts[2], parts[1] - 1, parts[0]);
        }

        function renderTable() {
            var searchText = searchInput.value.toLowerCase();
            var matchingRows = 0;

            tableRows.forEach(function(row) {
                var numFunc = row.querySelector('td:first-child').textContent.toLowerCase();
                var nomeDoc = row.querySelector('td:nth-child()').textContent.toLowerCase();

                if (numFunc.includes(searchText) || nomeDoc.includes(searchText)) {
                    row.style.display = 'table-row';
                    matchingRows++;
                } else {
                    row.style.display = 'none';
                }
            });

            var noResultsMessage = document.getElementById('noResultsMessage');
            if (matchingRows === 0) {
                if (!noResultsMessage) {
                    noResultsMessage = document.createElement('p');
                    noResultsMessage.id = 'noResultsMessage';
                    noResultsMessage.classList.add('text-center', 'mt-5');
                    noResultsMessage.textContent = 'Sem resultados.';
                    document.getElementById('tableContainer').appendChild(noResultsMessage);
                }

                noResultsMessage.style.display = 'block';
            } else {
                if (noResultsMessage) {
                    noResultsMessage.style.display = 'none';
                }
            }
        }

        function initializeModal() {
            $('#modalTerminar').on('hidden.bs.modal', function () {
                var modalMessage = document.getElementById('modalMessageDiv');
                var modalDateInput = document.getElementById("escolher-data");
                modalDateInput.value = "";
                if (modalMessage) {
                    modalMessage.remove();
                }
            });
        }

        searchInput.addEventListener('input', function() {
            renderTable();
        });
        sortDropdown.addEventListener('change', function() {
            var selectedValue = sortDropdown.value;
            sortTableByDate(selectedValue);
        });

        getlistNumbers();
        initializeModal();
        sortTableByDate('desc');
    });

    function updateData() {
        var chosenDateStr = document.getElementById("escolher-data").value;
        var chosenDate = new Date(chosenDateStr);
        var currentDate = new Date();

        var modalMessageDiv = document.getElementById("modalMessage");
        if (modalMessageDiv) {
            modalMessageDiv.remove();
        }

        if (chosenDate > currentDate) {
            var formattedChosenDate = `${chosenDate.getDate()}/${chosenDate.getMonth() + 1}/${chosenDate.getFullYear()}`;

            fetch('{{ route ('submeter.data')}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    chosenDate: formattedChosenDate,
                }),
            })
            .then(response => response.json())
            .then(data => {
                var modalMessageDiv = document.getElementById("modalMessageDiv");
                if (!modalMessageDiv) {
                    var modalMessageDiv = document.createElement('div');
                    modalMessageDiv.id = "modalMessageDiv";
                    modalMessageDiv.classList.add('text-center', 'text-success');
                    modalMessageDiv.innerText = 'Data atualizada com sucesso!';
                    var modalContent = document.getElementById("date-picker-example");
                    modalContent.appendChild(modalMessageDiv);
                }else{
                    modalMessageDiv.classList.remove('text-danger');
                    modalMessageDiv.classList.add('text-success');
                    modalMessageDiv.innerText = 'Data atualizada com sucesso!';
                }

                setTimeout(function () {
                    $('#modalTerminar').modal('hide');
                }, 3000);

                var dataConclusaoElement = document.getElementById('dataContainer');
                if (dataConclusaoElement) {
                    dataConclusaoElement.innerHTML = '<p class="m-0"><strong>Data de Conclusão:</strong> ' + data.newDate + '</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            var modalMessageDiv = document.getElementById("modalMessageDiv");
            if (!modalMessageDiv) {
                var modalMessageDiv = document.createElement('div');
                modalMessageDiv.id = "modalMessageDiv";
                modalMessageDiv.classList.add('text-center', 'text-danger');
                modalMessageDiv.innerText = 'A data deve ser futura!';
                var modalContent = document.getElementById("date-picker-example");
                modalContent.appendChild(modalMessageDiv);
            }
        }
    }

    $("#transferirBtn").click(() => {
        const url = "{{ route('export.all') }}";
        window.location.href = url;
    });

    $("#btnsubmetidas").click(() => {
        $("#tableSubmissoes").show();
        $("#tablePendentes").hide();
        $("#ordemBtn").removeClass("invisible");
        $("#btnsubmetidas").addClass("border border-dark border-2");
        $("#btnpendente").removeClass("border border-dark border-2");
        $('#noResultsMessageSubmissoes').removeClass('d-none').addClass('d-block');
        $('#noResultsMessagePendente').removeClass('d-block').addClass('d-none');
    });


    $("#btnpendente").click(() => {
        $("#tableSubmissoes").hide();
        $("#tablePendentes").show();
        $("#ordemBtn").addClass("invisible");
        $("#btnsubmetidas").removeClass("border border-dark border-2");
        $("#btnpendente").addClass("border border-dark border-2");
        $('#noResultsMessagePendente').removeClass('d-none').addClass('d-block');
        $('#noResultsMessageSubmissoes').removeClass('d-block').addClass('d-none');
    });
</script>
@endsection
