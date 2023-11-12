<!DOCTYPE html>
<html lang="en">
    @include('partials._head',["titulo"=>"Docente"])
<body>
    @include('partials._headerDocente')
    
    <div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="rounded p-4" style="background-color: #D9D9D9" >
            <div class="text-center p-4">
                <p class="p-5" id="texto-mensagem">Existem restrições por preencher</p>
                <button type="button" class="button-style" style="width: 150px; height: 40px;">Preencher</button>
            </div>
        </div>
    </div>

    
</body>
</html>
