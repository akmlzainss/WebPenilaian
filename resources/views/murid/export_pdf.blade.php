<!DOCTYPE html>
<html lang="id">
<head>
    <title>Export Murid</title>
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
    <h1>Daftar Murid</h1>
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>No Telp</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $m)
                <tr>
                    <td>{{ $m->nis }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->kelas }}</td>
                    <td>{{ $m->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $m->no_telp }}</td>
                    <td>{{ $m->tgl_lahir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>