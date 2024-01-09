@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Submissão de $nomeDocente ($numFunc)"])
@endsection
@section('header')
@include('partials._headerComissao')
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-center">
    <div class="p-5" style="min-height: 80vh;">
        <div class="text-center fs-4 fw-bold mb-4">{{ $numFunc }} - {{ $nomeDocente }}</div>

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
                        </div>
                        <div class="d-flex gap-4 mt-5">
                            <p><strong>Software Necessário:</strong></p>
                            {{-- software_necessario --}}
                            <div class="input-group input-group-md">
                                <textarea class="form-control" rows="3" disabled readonly>{{$uc->software_necessario ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end position-absolute" style="bottom: 30px; right: 30px;">
                        <button type="button" class="button-style botao-seguinte" style="width: 130px; height: 30px;">Seguinte</button>
                    </div>
                </div>
            @endforeach

            {{-- Tab para impedimentos --}}
            <div class="tab-pane fade tabela shadow-lg p-3 mb-5 bg-white rounded position-relative" id="impedimentos" role="tabpanel"
                aria-labelledby="impedimentos-tab">
                <div class="container mt-4">
                    <p class="text-center mb-4"><strong>Impedimentos do Docente</strong></p>
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
                                <tr>
                                    <th scope="col">{{$parteDia->value}}</th>
                                    @foreach ($diasSemana as $dia)
                                        @php
                                            $checked = in_array($dia->value . '_' . $parteDia->value, $impSelected) ? 'checked' : '';
                                        @endphp
                            
                                        @if (!($dia->value == 'sabado' && $parteDia->value == 'noite'))
                                            <td><input class="form-check-input impedimento-check" type="checkbox" name="{{$fieldName}}[]" value="{{$dia->value}}_{{$parteDia->value}}" aria-label="..." {{$checked}} disabled style="opacity: 1"></td>
                                        @else
                                            <td></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end position-absolute" style="bottom: 30px; right: 30px">
                    <button type="button" onclick="window.location.href = '{{ route('submissoes') }}'" class="button-style botao-fechar" style="width: 130px; height: 30px;">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
