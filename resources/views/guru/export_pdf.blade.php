<!DOCTYPE html>
<html lang="id">
<head>
    <title>Export Guru</title>
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
    <h1>Daftar Guru</h1>
    <table>
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>No Telp</th>
                <th>Tanggal Lahir</th>
                <th>Kode Mapel</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $g)
                <tr>
                    <td>{{ $g->nip }}</td>
                    <td>{{ $g->nama }}</td>
                    <td>{{ $g->email }}</td>
                    <td>{{ $g->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $g->no_telp }}</td>
                    <td>{{ $g->tgl_lahir }}</td>
                    <td>{{ $g->kode }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>