<!DOCTYPE html>
<html>
<head>
    <title>Ekspor Nilai Murid</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #4e73df;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #e3e6f0;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4e73df;
            color: white;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f8f9fc;
        }
        tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }
    </style>
</head>
<body>
    <h1>Daftar Nilai Saya</h1>
    <table>
        <thead>
            <tr>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Predikat</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $n)
                <tr>
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
