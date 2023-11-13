<!DOCTYPE html>
<html lang="en">
    @include('partials._head',["titulo"=>"Docente Preenchido"])

<body>
    @include('partials._headerDocente')
    
    <div class="d-flex align-items-center justify-content-center" style="min-height: 80vh">
        <div class="rounded p-4" style="background-color: #D9D9D9;min-width: 500px">
            <div class="text-center p-4">
                <h4 class="h-4" id="texto-restricoes">Restrições</h4>
                <p class="p-5" id="texto-mensagem">Submetido: 10-12-2024</p>
                <button type="button" class="button-style" style="width: 150px; height: 40px;">Editar</button>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>