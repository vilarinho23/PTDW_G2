@extends('partials._document')

@section('head')
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>[GRUPO 2] Serviço de Autenticação Web</title>
<link rel="stylesheet" type="text/css" href="//static.ua.pt/idp/main.min.css?20170731">

<style>
body
{
    background-image: none; background-color: #000;
}
.txt-red { color: #f00; }
.txt-upper { text-transform: uppercase; }
</style>
@endsection

@section('content')
<div id="container">
    <div id="header">
        <h1 class="txt-red">Grupo 2 IDP</h1>
        <p>Esta é uma página de autenticação "falsa", criada para autenticar os utilizadores no nosso sistema (GRDESTGA).</p>
        <p class="txt-red txt-upper">Não introduza as suas credenciais reais (isto não é o IDP oficial da UA).</p>
        {{--<img src="https://static.ua.pt/idp/logo/ua.gif" alt="Universidade de Aveiro">--}}
        {{--
        <div class="language">
            <a data-lang="pt" href="#">pt</a>
            <a data-lang="en" href="#">en</a>
        </div>
        --}}
    </div>

    <div class="content">
        <div class="margin-bottom">
            <p>
                Está a aceder ao serviço:<br>
                <span class="service-name">Gestor de Restrições dos Docentes da ESTGA</span>
            </p>
        </div>

        <div class="error">
            <p>
                @error('credentials')
                {{ $message }}
                @enderror

                @error('j_username', 'j_password')
                Utilizador ou palavra-passe inválidos.
                @enderror
            </p>
        </div>

        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">
                <label for="username">Utilizador</label>
                <input class="form-element form-field" id="username" name="j_username" type="email" value="" required>
            </div>

            <div class="row">
                <label for="password">Palavra-passe</label>
                <input class="form-element form-field" id="password" name="j_password" type="password" value="" required>

                {{--
                <a>Esqueceu-se da palavra-passe?</a>
                --}}
            </div>

            {{--
            <div>
                <label class="checkbox">
                    <input type="checkbox" name="donotcache" value="1">
                    Não guardar autenticação
                </label>
            </div>

            <div class="margin-bottom">
                <label class="checkbox">
                    <input id="_shib_idp_revokeConsent" type="checkbox" name="_shib_idp_revokeConsent" value="true">
                    Remover permissões de partilha de informação concedidas previamente.
                </label>
            </div>
            --}}

            <div class="row">
                <button id="btnLogin" class="form-element form-button" type="submit"
                    onClick="this.childNodes[0].nodeValue='A autenticar, por favor aguarde...'">
                    Autenticar
                </button>
            </div>

            {{--
            <div class="row">
                <button class="form-element form-button" type="submit" name="_eventId_authn/AutenticacaoGov">
                    Chave Móvel Digital | Cartão de Cidadão
                </button>
            </div>
            --}}
        </form>

        {{--
        <div class="help"><a target="_blank" href="http://www.ua.pt/stic/page/22826">Precisa de ajuda?</a></div>
        <div class="legal"><a href="#">Aviso legal</a></div>
        <div class="clear-both"></div>
        --}}
    </div>

    {{--
    <div id="footer"></div>
    <div class="funding">
        <a href="http://www.poci-compete2020.pt" target="_blank" class="compete">
            <img src="https://static.ua.pt/idp/logo/compete.gif" alt="Compete 2020">
        </a>
    </div>
    --}}
</div>
@endsection
