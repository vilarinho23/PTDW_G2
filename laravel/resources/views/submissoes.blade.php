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
            <p class="m-0">numero</p>
        </div>
        <div class="border rounded d-flex flex-column gap-2 px-4 py-2 " style=" background-color:#D9D9D9">
            <p class="m-0"><strong>Formulários Pendentes</strong></p>
            <p class="m-0">numero</p>
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

    <div class="w-75 mx-auto">
        <div class="d-flex justify-content-between gap-2 mt-3">
            <div class="d-flex align-items-center gap-2">
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search">
                </div>
                <div>
                    <img src="{{ asset('images/search-interface-symbol.svg') }}" alt="search">
                </div>
            </div>

            <div class="d-flex align-items-center me-5">
                <p class="m-0"> <strong>Data de Conclusão:</strong> 22/22/2222</p>
            </div>
        </div>

        <table class="table table-striped mt-5">

            <tbody>
                <tr>
                    <td class="w-50">999999 - NOME DOCENTE</td>
                    <td class="w-50">19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>23-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>23-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
                <tr>
                    <td>999999 - NOME DOCENTE</td>
                    <td>19-01-2023</td>
                </tr>
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
            <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker gap-3">
                <label for="escolher-data" class="d-flex justify-content-center align-items-center mb-3 ml-2">Data:
                    <input id="escolher-data" type="date" name="escolher-data" class="ms-3">
                </label>
            </div>
            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;">Confirmar</button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@endsection
