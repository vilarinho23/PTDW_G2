<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
    <title>Página Sem UC Atribuídas - Docente</title>
</head>
<body>
    @include('partials._headDocente')
    
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 60vh;">
    <h1 class="mt-4">Sem Unidades Currculares Associadas</h1>
    <p class="mt-3">Em caso de dúvida: <a href="geral@ua.pt" class="link-underline link-underline-hover">geral@ua.pt</a></p> 
</div>

</body>
</html>