// Caminhos para as páginas definidos no Blade

const botaoDocente = document.getElementById("docente-button");
botaoDocente?.addEventListener('click', () => {
    window.location.href = docenteUrl;
})

const botaoComissao = document.getElementById("comissao-button");
botaoComissao?.addEventListener('click', () => {
    window.location.href = comissaoUrl;
})

const botaoLogOut = document.getElementById("logOut-button");
botaoLogOut?.addEventListener('click', () => {
    window.location.href = logOutUrl;
})

const botaoPreencher = document.getElementById("preencher-button");
botaoPreencher?.addEventListener('click', () => {
    window.location.href = preencherUrl;
})
