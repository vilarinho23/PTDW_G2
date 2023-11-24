@extends('partials._document')
@section('head')
@include('partials._head', ["titulo" => "Docente"])
@endsection
@section('header')
@include('partials._headerDocente')
@endsection

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh">
    @if ($dataConclusao == null)
        <h1 class="mt-4">Data de conclusão por definir</h1>
    @elseif ($ucs->isEmpty())
        <h1 class="mt-4">Sem Unidades Curriculares Associadas</h1>
        <p class="mt-3">Em caso de dúvida: <a href="mailto:geral@ua.pt" class="link-underline link-underline-hover">geral@ua.pt</a></p>
    @else
        <div class="rounded p-4" style="background-color: #D9D9D9;min-width: 500px">
            <div class="text-center p-4">
                @if ($dataSubmissao == null)
                    @php $nomeBotao = "Preencher"; @endphp

                    <p class="p-5"><strong>Existem restrições por preencher</strong></p>
                @else
                    @php $nomeBotao = "Editar"; @endphp

                    <h4 class="h-4" id="texto-restricoes">Restrições</h4>
                    <p class="p-5" id="texto-mensagem">
                        Submetido: {{ $dataSubmissao->format('d/m/Y h:i') }}
                    </p>
                @endif

                <button type="button" class="button-style" style="width: 150px; height: 40px;" id="preencher-button">
                    {{ $nomeBotao }}
                </button>
            </div>
        </div>
    @endif
</div>
@endsection
