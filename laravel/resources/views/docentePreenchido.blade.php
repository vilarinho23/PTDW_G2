<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Docente Preenchido</title>
</head>
<body>
@include('partials._headDocente')
    
    <div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="rounded p-4" style="background-color: #D9D9D9; width: 35%;">
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