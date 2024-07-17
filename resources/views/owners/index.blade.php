<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proprietários</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Proprietários</h1>
        
        <div class="d-flex justify-content-between">
        <form id="searchForm" class="form-inline" action="/campaing-owners" method="get">
            <input type="text" id="campaing_id" name="campaing_id" class="form-control" style="width: 400px;" placeholder="Buscar">
            <button type="submit" class="btn btn-primary" style="width: 150px;">Buscar</button>
        </form>
        <button onclick="exportReport()" class="btn btn-success mb-3">Exportar para Excel</button>
        </div>

        <h3>{{ $campaing_name }}</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Documento</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($owners as $owner)
                    <tr>
                        <td>{{ $owner['name'] }}</td>
                        <td>{{ $owner['email'] }}</td>
                        <td>{{ $owner['document'] }}</td>
                        <td>{{ $owner['city'] }}</td>
                        <td>{{ $owner['uf'] }}</td>
                        <td>{{ $owner['street'] }}, {{ $owner['address_numner'] }}</td>                        
                        <td>{{ $owner['phone'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Nenhum proprietário encontrado!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function exportReport()
        {
            var campaingId = "{{ request()->campaing_id }}"

            if(! campaingId) {
                campaingId = $("#campaing_id").val()
            }

            if(! campaingId) {
                alert("Necessário realizar busca!")
                return false
            }

            window.location.href = "{{ route('export-owners') }}" + "?campaing_id=" + campaingId
        }
    </script>
</body>
</html>
