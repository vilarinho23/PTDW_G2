<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   
    <title>Início</title>
</head>
<body>
    @include('partials._headDocente')
    
    <div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="rounded p-4 shadow-lg" style="background-color: #D9D9D9" >
            <div class="text-center p-4">
                <p class="p-5" id="texto-mensagem">Existem restrições por preencher</p>
                <button type="button" id="botao-preencher">Preencher</button>
            </div>
            
        </div>
    </div>

    
</body>
</html>
