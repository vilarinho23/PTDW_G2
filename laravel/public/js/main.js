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


const botoesSeguinte = document.getElementsByClassName("botao-seguinte");
Array.from(botoesSeguinte).forEach(botao => {
    botao.addEventListener('click', () => {
        const btnTabAtiva = document.querySelector("#myTab > .nav-item > .active");
        const tabAtiva = btnTabAtiva.parentElement;

        const tabSeguinte = tabAtiva.nextElementSibling;
        if (tabSeguinte == null) return;

        const btnTabSeguinte = tabSeguinte.firstElementChild;
        btnTabSeguinte.dispatchEvent(new Event('click'));
    });
});

const botaoSubmeter = document.getElementById("botao-submeter");
botaoSubmeter?.addEventListener('click', () => {
    const form = document.getElementById("form-restricoes");
    form.submit();
})
