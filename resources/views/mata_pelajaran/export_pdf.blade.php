<!DOCTYPE html>
<html lang="id">
<head>
    <title>Export Mata Pelajaran</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <h1>Daftar Mata Pelajaran</h1>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Mata Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $m)
                <tr>
                    <td>{{ $m->kode }}</td>
                    <td>{{ $m->mata_pelajaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>