<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>{{ $data['title'] }}</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-widtj, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        thead th {
            text-align: center;
            background-color: #CCCCCC;
        }
        tbody td {
            text-align: center;
            font-size: 14px;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div style="width: 100%"><h2>{{ $data['title'] }}</h2></div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('author.entity') }}</th>

                    <th>{{ __('book.entity.fields.titulo') }}</th>
                    <th>{{ __('book.entity.fields.editora') }}</th>
                    <th>{{ __('book.entity.fields.edicao') }}</th>
                    <th>{{ __('book.entity.fields.anopublicacao') }}</th>
                    <th>{{ __('book.entity.fields.valor') }}</th>
                    <th>{{ __('subject.entity') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['bookStore'] as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nome'] }}</td>
                        <td>{{ $item['titulo'] }}</td>
                        <td>{{ $item['editora'] }}</td>
                        <td>{{ $item['edicao'] }}</td>
                        <td>{{ $item['anopublicacao'] }}</td>
                        <td>@toMoney($item['valor'])</td>
                        <td>{{ $item['assuntos'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
