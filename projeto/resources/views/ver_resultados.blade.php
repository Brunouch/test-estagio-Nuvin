<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Resultados</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
            font-size: large;
        }
        th {
            background-color: black;
            color: white;
        }
        button {
            
            font-size: 15px;
        }
    </style>
</head>
<body>
    <h2>Conteúdo do Arquivo CSV</h2>
    <table>
        <thead>
            <tr>
                <th>Tabela de registros</th>
            </tr>
        </thead>
        <tbody>
            @foreach (explode("\n", $contents) as $linha)
                <tr>
                    <td>{{ $linha }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <form action="{{ route('enviar_informacoes') }}">
        <button type="submit">Home</button>
    </form>

    <br>
    <form method="GET" action="{{ route('exportar_resultados') }}">
    <button type="submit">Exportar Resultados</button>
    </form>
    
</body>
</html>
