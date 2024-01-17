@extends('partials._document')
@section('head')
@include('partials._head', ['titulo' => 'Restrições'])
@endsection
@section('header')
@include('partials._headerDocente')
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-center">
    <div class="p-5" style="min-height: 80vh;">
        {{-- Erros --}}
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach

        <form method="POST" action="{{route('restricoesSubmeter')}}" id="form-restricoes">
            @csrf

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                {{-- Tab para cada UC --}}
                @foreach ($ucs as $uc)
                    @php
                        $active = $loop->first ? 'active' : '';
                        $ariaControls = 'uc' . $uc->cod_uc;
                        $dataBsTarget = '#' . $ariaControls;
                        $id = $ariaControls . '-tab';
                    @endphp

                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-black {{$active}}" data-bs-toggle="tab" data-bs-target="{{$dataBsTarget}}" id="{{$id}}"
                            type="button" role="tab" aria-selected="false" aria-controls="{{$ariaControls}}">
                            {{$uc->nome_uc}}
                        </button>
                    </li>
                @endforeach

                {{-- Tab para impedimentos --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-black" id="impedimentos-tab" data-bs-toggle="tab"
                        data-bs-target="#impedimentos" type="button" role="tab" aria-controls="impedimentos"
                        aria-selected="false">Restrições</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                {{-- Tab para cada UC --}}
                @foreach ($ucs as $uc)
                    @php
                        $active = $loop->first ? 'active show' : '';
                        $id = 'uc' . $uc->cod_uc;
                        $ariaLabelledBy = $id . '-tab';

                        $cursosUc = $uc->cursos->pluck('acron_curso')->implode(', ');
                        $percentagemHoras = $uc->pivot->perc_horas ?? 0;
                        $docenteResponsavel = $uc->responsavel->nome_docente;

                        $isResponsavel = $uc->isresponsavel ?? false;
                    @endphp

                    <div class="tab-pane fade tabela shadow-lg p-5 mb-5 bg-white position-relative rounded {{$active}}" id="{{$id}}"
                        role="tabpanel" aria-labelledby="{{$ariaLabelledBy}}">
                        <div class="d-flex">
                            <p class="w-50"><strong>UC: </strong>{{$uc->cod_uc}} - {{$uc->nome_uc}}</p>
                            <p class="w-25"><strong>Cursos: </strong>{{$cursosUc}}</p>
                            <p class="w-25"><strong>Percentagem de horas: </strong>{{$percentagemHoras}}%</p>
                        </div>
                        <p><strong>Docente Responsável: </strong>{{$docenteResponsavel}}</p>

                        <div>
                            <p class="mt-5"><strong>Utilização de Laboratórios:</strong></p>
                            <div class="ms-4">
                                @if ($isResponsavel)
                                    <div class="d-flex gap-3">
                                        <div class="d-flex flex-column gap-4">
                                            <div class="d-flex gap-3 align-items-center">
                                                <strong class="align-items-center">Para Aula: </strong>
                                                <div>
                                                    {{-- utilizacao_laboratorios --}}
                                                    @php $fieldName = "${id}_utilizacao_laboratorios"; @endphp
                                                    <select class="form-select" name="{{$fieldName}}">
                                                        @php
                                                            $ulSelected = old($fieldName, $uc->utilizacao_laboratorios->value ?? '') ?? '';
                                                        @endphp
                                                        <option value="null">nao definido</option>
                                                        @foreach ($utilizacaoLab as $ul)
                                                            @php
                                                                $ul = $ul->value;
                                                                $selected = $ulSelected == $ul ? 'selected' : '';
                                                            @endphp
                                                            <option value="{{$ul}}" {{$selected}}>{{$ul}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-3 align-items-center">
                                                <strong>Para Avaliação:</strong>
                                                <div class="d-flex gap-2">
                                                    {{-- sala_avaliacoes --}}
                                                    @php $fieldName = "${id}_sala_avaliacoes"; @endphp
                                                    <select class="form-select" name="{{$fieldName}}">
                                                        @php
                                                            $saSelected = old($fieldName, $uc->sala_avaliacoes->value ?? '') ?? '';
                                                        @endphp
                                                        @foreach ($salaAvaliacoes as $sa)
                                                            @php
                                                                $sa = $sa->value;
                                                                $selected = $saSelected == $sa ? 'selected' : '';
                                                            @endphp
                                                            <option value="{{$sa}}" {{$selected}}>{{$sa}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex ms-5 gap-3">
                                            <p><strong>Laboratórios Possíveis: </strong></p>
                                            <div class="d-flex flex-column" style="max-height: 100px; overflow-y: auto;">
                                                {{-- laboratorios --}}
                                                @php
                                                    $fieldName = "${id}_laboratorios";

                                                    $oldLabs = old($fieldName) ?? [];
                                                    $laboratoriosUc = $uc->laboratorios->pluck('designacao_lab');

                                                    $labSelected = old("_token") ? $oldLabs : $laboratoriosUc->toArray();
                                                @endphp
                                                <ul class="list-unstyled mb-0">
                                                    @foreach ($laboratorios as $lab)
                                                        @php
                                                            $checked = in_array($lab->designacao_lab, $labSelected) ? 'checked' : '';
                                                            $labId = $fieldName . "_" . $loop->index;
                                                        @endphp
                                                        <li>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="{{$labId}}" name="{{$fieldName}}[]" value="{{$lab->designacao_lab}}" {{$checked}}>
                                                                <label class="form-check-label" for="{{$labId}}">{{$lab->designacao_lab}}</label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex gap-3">
                                        <p><strong>Para Aula: </strong></p>
                                        <div class="d-flex gap-2">
                                            {{-- aula --}}
                                            {{$uc->utilizacao_laboratorios ?? ''}}
                                        </div>
                                    </div>

                                    <div class="d-flex gap-3">
                                        <p><strong>Laboratórios Possíveis: </strong></p>
                                        <div class="d-flex gap-2">
                                            {{-- laboratorios --}}
                                            @php $laboratoriosUc = $uc->laboratorios->pluck('designacao_lab'); @endphp
                                            {{$laboratoriosUc->implode(', ') ?? ''}}
                                        </div>
                                    </div>

                                    <div class="d-flex gap-3">
                                        <p><strong>Para Avaliação:</strong></p>
                                        <div class="d-flex gap-2">
                                            {{-- sala_avaliacoes --}}
                                            {{$uc->sala_avaliacoes ?? ''}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex gap-4 mt-5">
                                <p><strong>Software Necessário:</strong></p>
                                {{-- software_necessario --}}
                                @php
                                    $fieldName = "${id}_software_necessario";
                                    $disabled = $isResponsavel ? '' : 'disabled readonly';
                                @endphp

                                <div class="input-group input-group-md">
                                    @php $softwareNecessario = old("_token") ? old($fieldName) : $uc->software_necessario; @endphp
                                    <textarea class="form-control" name="{{$fieldName}}" rows="3" {{$disabled}}>{{
                                        $softwareNecessario ?? ''
                                    }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end position-absolute" style="bottom: 30px; right: 30px;">
                            <button type="button" class="button-style botao-seguinte" style="width: 130px; height: 30px;">Seguinte</button>
                        </div>
                    </div>
                @endforeach

                {{-- Tab para impedimentos --}}
                <div class="tab-pane fade tabela shadow-lg p-3 mb-5 bg-white position-relative rounded" id="impedimentos" role="tabpanel"
                    aria-labelledby="impedimentos-tab">
                    <div class="container mt-4">
                        <p class="text-center mb-4"><strong>Assinalar Impedimentos</strong></p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Horário</th>
                                    @foreach ($diasSemana as $dia)
                                        <th scope="col">{{$dia}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $fieldName = 'impedimentos';
                                    $blocosSemAulas = ["sábado_noite"];

                                    $impOld = old($fieldName) ?? [];
                                    $impedimentos = $restricoes->map(function ($restricao) {
                                        return ($restricao->dia_semana->value) . '_' . ($restricao->parte_dia->value);
                                    });

                                    $impSelected = old("_token") ? $impOld : $impedimentos->toArray();
                                @endphp
                                @foreach ($partesDia as $parteDia)
                                    <tr>
                                        <th scope="col">{{$parteDia->value}}</th>
                                        @foreach ($diasSemana as $dia)
                                            @php
                                                $impValue = $dia->value . '_' . $parteDia->value;

                                                $checked = in_array($impValue, $impSelected) ? 'checked' : '';
                                                $semAulas = in_array($impValue, $blocosSemAulas);
                                            @endphp

                                            @if ($semAulas)
                                                <td></td>
                                            @else
                                                <td><input class="form-check-input impedimento-check" type="checkbox" name="{{$fieldName}}[]" value="{{$dia->value}}_{{$parteDia->value}}" aria-label="..." {{$checked}}></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex gap-3 ms-3 mt-5">
                        <div>
                            <img src="{{ asset('images/info.svg') }}" alt="info">
                        </div>
                        <p>Deve deixar pelo menos 2 blocos disponíveis.</p>
                    </div>
                    <div class="d-flex justify-content-end mt-5 position-absolute" style="bottom: 30px; right: 30px;">
                        <button type="button" class="button-style" data-bs-toggle="modal" id="submeterButton"
                            data-bs-target="#submeterModal" style="width: 130px; height: 30px;">Submeter</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="submeterModal" tabindex="-1" aria-labelledby="submeterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title mx-auto" id="submeterModalLabel">Submeter informações?</h5>
            </div>
            <div class="modal-footer d-flex justify-content-center border-0">
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" id="botao-submeter">Confirmar</button>
                <button type="button" class="mx-2 button-style" style="width: 130px; height: 30px;" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@endsection

