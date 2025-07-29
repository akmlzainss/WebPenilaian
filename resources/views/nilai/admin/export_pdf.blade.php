<!DOCTYPE html>
<html lang="id">
<head>
    <title>Export Nilai</title>
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
    <h1>Daftar Nilai</h1>
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Murid</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Predikat</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $n)
                <tr>
                    <td>{{ $n->nis }}</td>
                    <td>{{ $n->murid->nama ?? 'N/A' }}</td>
                    <td>{{ $n->mapel->mata_pelajaran ?? 'N/A' }}</td>
                    <td>{{ $n->nilai }}</td>
                    <td>{{ $n->predikat }}</td>
                    <td>{{ $n->semester }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>