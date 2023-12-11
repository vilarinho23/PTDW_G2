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

                    <div class="tab-pane fade tabela shadow-lg p-5 mb-5 bg-white rounded {{$active}}" id="{{$id}}"
                        role="tabpanel" aria-labelledby="{{$ariaLabelledBy}}">
                        <div class="d-flex">
                            <p class="w-50"><strong>UC: </strong>{{$uc->cod_uc}} - {{$uc->nome_uc}}</p>
                            <p class="w-25"><strong>Cursos: </strong>{{$cursosUc}}</p>
                            <p class="w-25"><strong>Percentagem de horas: </strong>{{$percentagemHoras}}%</p>
                        </div>
                        <p><strong>Docente Responsável: </strong>{{$docenteResponsavel}}</p>

                        <div>
                            <p class="mt-5"><strong>Utilização de Laboratórios:</strong></p>
                            <div class="p-1">
                                <div class="gap-5 d-flex">
                                    <strong>Para Aula: </strong>
                                    <div class="d-flex gap-2">
                                        {{-- utilizacao_laboratorios --}}
                                        @if ($isResponsavel)
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
                                        @else
                                            {{$uc->utilizacao_laboratorios ?? ''}}
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex gap-3">
                                    <p><strong>Laboratórios Possíveis: </strong></p>
                                    <div class="d-flex gap-2">
                                        {{-- laboratorios --}}
                                        @php $laboratoriosUc = $uc->laboratorios->pluck('designacao_lab'); @endphp
                                        @if ($isResponsavel)
                                            @php $fieldName = "${id}_laboratorios"; @endphp
                                            <select class="form-select" multiple name="{{$fieldName}}[]">
                                                @php
                                                    $labSelected = old($fieldName) ?? [];
                                                    if (old("_token") == null) $labSelected = $laboratoriosUc->toArray() ?? [];
                                                @endphp
                                                @foreach ($laboratorios as $lab)
                                                    @php $selected = in_array($lab->designacao_lab, $labSelected) ? 'selected' : ''; @endphp

                                                    <option value="{{$lab->designacao_lab}}" {{$selected}}>{{$lab->designacao_lab}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            {{$laboratoriosUc->implode(', ') ?? ''}}
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex gap-5">
                                    <p><strong>Para Avaliação:</strong></p>
                                    <div class="d-flex gap-2">
                                        {{-- sala_avaliacoes --}}
                                        @if ($isResponsavel)
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
                                        @else
                                            {{$uc->sala_avaliacoes ?? ''}}
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex gap-4 mt-5">
                                    <p><strong>Software Necessário:</strong></p>
                                    {{-- software_necessario --}}
                                    @php
                                        $fieldName = "${id}_software_necessario";
                                        $disabled = $isResponsavel ? '' : 'disabled readonly';
                                    @endphp

                                    <div class="input-group input-group-md">
                                        <textarea class="form-control" name="{{$fieldName}}" rows="3" {{$disabled}}>{{
                                            old($fieldName, $uc->software_necessario) ?? ''
                                        }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="button-style botao-seguinte">Seguinte</button>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Tab para impedimentos --}}
                <div class="tab-pane fade tabela shadow-lg p-3 mb-5 bg-white rounded" id="impedimentos" role="tabpanel"
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

                                    $impSelected = old($fieldName) ?? [];
                                    if (old("_token") == null) $impSelected = $restricoes->map(function ($restricao) {
                                        return ($restricao->dia_semana->value) . '_' . ($restricao->parte_dia->value);
                                    })->toArray();
                                @endphp
                                @foreach ($partesDia as $parteDia)
                                    @php $parteDia = $parteDia->value; @endphp
                                    <tr>
                                        <th scope="col">{{$parteDia}}</th>
                                        @foreach ($diasSemana as $dia)
                                            @php
                                                $dia = $dia->value;

                                                $checked = in_array($dia . '_' . $parteDia, $impSelected) ? 'checked' : '';
                                                $disabled = $dia == 'sabado' && $parteDia == 'noite' ? 'disabled' : '';
                                            @endphp

                                            <td><input class="form-check-input impedimento-check" type="checkbox" name="{{$fieldName}}[]" value="{{$dia}}_{{$parteDia}}" aria-label="..." {{$checked}} {{$disabled}}></td>
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
                    <div class="d-flex justify-content-end mt-5">
                        <button type="button" class="button-style" data-bs-toggle="modal"
                            data-bs-target="#submeterModal">Submeter</button>
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
