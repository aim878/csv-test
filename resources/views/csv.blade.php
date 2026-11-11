<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transactions</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 2rem; }
        table { border-collapse: collapse; font-size: 14px; }
        th, td { border: 1px solid #ccc; padding: 4px 8px; text-align: left; white-space: nowrap; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Transactions ({{ $data->count() }})</h1>
    <table>
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($columns as $column)
                        <td>{{ $row[$column] }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
