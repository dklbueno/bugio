<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campanhas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Campanhas</h1>
        <a href="/export" class="btn btn-success mb-3">Exportar para Excel</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Contagem Imobiliária</th>
                    <th>Contagem de Silos</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($campaings as $campaing)
                    <tr>
                        <td>{{ $campaing['id'] }}</td>
                        <td>{{ $campaing['name'] }}</td>
                        <td>{{ $campaing['realty_count'] }}</td>
                        <td>{{ $campaing['silo_count'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Nenhuma campanha encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
