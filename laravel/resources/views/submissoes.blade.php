<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
    <title>Atribuição de Uc's</title>
</head>
<body>
    @include('partials._headComissao')

    <div class="container-sm">
        <div class="d-flex justify-content-center mt-5 gap-5 p-4 text-center w-75 mx-auto" >
            <div class="border rounded d-flex flex-column gap-2 px-4 py-2 " style=" background-color:#D9D9D9">
                <p class="m-0"><strong>Formulários Submetidos</strong></p>
                <p class="m-0">numero</p>
            </div>
            <div class="border rounded d-flex flex-column gap-2 px-4 py-2 " style=" background-color:#D9D9D9">
                <p class="m-0"><strong>Formulários Submetidos</strong></p>
                <p class="m-0">numero</p>
            </div>
            <div class="d-flex flex-column align-items-center gap-3 ps-5">
                <div class="h-50">
                    <button type="button" class="button-style" style="width: 200px;height: 40px">Definir Data de Término</button>
                    
                </div>
                <div class="h-50">
                    <button type="button" class="button-style" style="width: 200px;height: 40px">Transferir Subsmissões</button>
                    
                </div>
            </div>
        </div>

        <div class="w-75 mx-auto">
            <div class="d-flex justify-content-between gap-2 mt-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group rounded">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    </div>
                    <div>
                        <img src="images/search-interface-symbol.png" alt="search">
                    </div>
                </div>
    
                <div class="d-flex align-items-center me-5">
                    <p class="m-0"> <strong>Data de Conclusão:</strong> data</p>
                </div>
            </div>
    
            <table class="table table-striped mt-5">
                
                <tbody>
                    <tr>
                        <td class="w-50">999999 - NOME DOCENTE</td>
                        <td class="w-50">19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>23-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>23-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                    <tr>
                        <td>999999 - NOME DOCENTE</td>
                        <td>19-01-2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>

    
</body>
</html>