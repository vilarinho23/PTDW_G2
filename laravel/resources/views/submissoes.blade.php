@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Submissões"])
@endsection
@section('header')
@include('partials._headerComissao')
@endsection

@section('content')
<div class="container-sm">
    <div class="d-flex justify-content-center mt-5 gap-5 p-4 text-center w-75 mx-auto" >
        <div class="border rounded d-flex flex-column gap-2 px-4 py-2 " style=" background-color:#D9D9D9">
            <p class="m-0"><strong>Formulários Submetidos</strong></p>
            <p class="m-0">{{ $nrSubmissoes }}</p>
        </div>
        <div class="border rounded d-flex flex-column gap-2 px-4 py-2 " style=" background-color:#D9D9D9">
            <p class="m-0"><strong>Formulários Pendentes</strong></p>
            <p class="m-0">{{ $nrPorSubmeter }}</p>
        </div>
        <div class="d-flex flex-column align-items-center gap-3 ps-5">
            <div class="h-50">
                <button type="button" class="button-style" style="width: 200px;height: 40px" data-bs-toggle="modal" data-bs-target="#modalTerminar">Definir Data de Término</button>

            </div>
            <div class="h-50">
                <button type="button" class="button-style" style="width: 200px;height: 40px">Transferir Subsmissões</button>

            </div>
        </div>
    </div>

    <div class="w-75 mx-auto" id="tableContainer">
        <div class="d-flex justify-content-between gap-2 mt-3">
            <div class="d-flex gap-4">
                <div class="input-group w-50">
                    <input type="search" class="form-control rounded" placeholder="Número" aria-label="Search" id="searchInput">
                </div>
                <div class="d-flex align-items-center w-50">
                    <label for="sortDropdown" class="me-2">Ordem:</label>
                    <select class="form-select" id="sortDropdown">
                        <option value="desc">Mais Recente</option>
                        <option value="asc">Mais Antigo</option>
                    </select>
                </div>
            </div>
    
            <div class="d-flex align-items-center me-2">
                @if ($dataConclusao)
                    <p class="m-0"><strong>Data de Conclusão:</strong> {{ $dataConclusao }}</p>
                @else
                    <p class="m-0"><strong>Data de Conclusão:</strong> Sem Data Definida</p>
                @endif
            </div>
        </div>
    
        <table class="table table-striped mt-2">
            <thead>
                <tr>
                    <th class="text-center">Nº</th>
                    <th class="text-start">Nome Docente</th>
                    <th class="text-center">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach(collect($submissoes)->sortBy('data_submissao', SORT_REGULAR, false) as $item)
                    <tr>
                        <td class="col-3">{{ $item['num_func'] }}</td>
                        <td class="text-start">{{ $item['nome_docente'] }}</td>
                        <td class="aligned-td">{{ \Carbon\Carbon::parse($item['data_submissao'])->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<div class="modal" id="modalTerminar" tabindex="-1" aria-labelledby="modalTerminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto" id="modalTerminarLabel">Definir Data de Término</h5>
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
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('searchInput');
        var tableRows = document.querySelectorAll('.table tbody tr');
        var sortDropdown = document.getElementById('sortDropdown');

        function sortTableByDate(order) {
            var tbody = document.querySelector('.table tbody');
            var rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort(function(a, b) {
                var dateA = parseDate(a.querySelector('td:last-child').textContent);
                var dateB = parseDate(b.querySelector('td:last-child').textContent);

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

                if (numFunc.includes(searchText)) {
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

        searchInput.addEventListener('input', function() {
            renderTable();
        });
        sortDropdown.addEventListener('change', function() {
            var selectedValue = sortDropdown.value;
            sortTableByDate(selectedValue);
        });
        sortTableByDate('desc');
    });

    function updateData() {
        var chosenDateStr = document.getElementById("escolher-data").value;
        var chosenDate = new Date(chosenDateStr);
        var currentDate = new Date();

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
                console.log('Server response:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
            var modal = new bootstrap.Modal(document.getElementById('modalTerminar'));
            modal.hide();
        } else {
            console.log('Chosen date must be in the future');
        }
    }
</script>
@endsection
