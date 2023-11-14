const botaoDocente = document.getElementById("docente-button");
botaoDocente?.addEventListener('click', () => {
    window.location.href = '/docente'
})

const botaoComissao = document.getElementById("comissao-button");
botaoComissao?.addEventListener('click', () => {
    window.location.href = '/submissoes'
})

const botaoLogOut = document.getElementById("logOut-button");
botaoLogOut?.addEventListener('click', () => {
    window.location.href = '/'
})

const botaoPreencher = document.getElementById("preencher-button");
botaoPreencher?.addEventListener('click', () => {
    window.location.href = '/restricoes'
})
