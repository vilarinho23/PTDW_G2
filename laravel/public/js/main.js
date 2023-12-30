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

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector('.form-control.rounded');
    const tableRows = document.querySelectorAll('.table tbody tr');

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();

        tableRows.forEach(function (row) {
            const docenteNome = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            const ucNome = row.querySelector('td:nth-child(7)').innerText.toLowerCase();

            if (docenteNome.includes(searchTerm) || ucNome.includes(searchTerm)) { row.style.display = ''; }
            else { row.style.display = 'none'; }
        });
    });
});

function mostrarValorSelecionado(selectElement, indice) {
    if (indice == 1) {
        var labelElement = document.getElementById("inputAtribuirNomeDocente");
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        labelElement.innerHTML = selectedOption.getAttribute('data-nome-docente');
    } else {
        var labelElement = document.getElementById("inputAtribuirNomeUc");
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        labelElement.innerHTML = selectedOption.getAttribute('data-nome-uc');
    }
}

document.addEventListener("DOMContentLoaded", function () {
    var dropdownAtribuirNFuncionario = document.getElementById("dropdownAtribuirNFuncionario");
    var dropdownAtribuirCodUc = document.getElementById("dropdownAtribuirCodUc");

    mostrarValorSelecionado(dropdownAtribuirNFuncionario, 1);
    mostrarValorSelecionado(dropdownAtribuirCodUc, 2);
});

$(document).ready(function () {
    $('#confirmarBtn').click(function () {
        var fileInput = $('#fileUploadCarregar')[0];
        var file = fileInput.files[0];
        if (!file) { return; }
        var reader = new FileReader();
        reader.onload = function (e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, { type: 'binary' });
            var sheetName = workbook.SheetNames[0];
            var sheet = workbook.Sheets[sheetName];
            var jsonData = XLSX.utils.sheet_to_json(sheet);

            jsonData.forEach(function (row) {
                $.ajax({
                    type: 'POST', url: atribuicaoUcsStoreRoute,
                    data: { '_token': csrfToken, 'dropdownAtribuirNFuncionario': row['n.º Func'], 'dropdownAtribuirCodUc': row['cód UC'], 'inputAtribuirPerc': row['Perc'] },
                    success: function (response) { location.reload(); },
                });
            });
        };
        reader.readAsBinaryString(file);
    });
});