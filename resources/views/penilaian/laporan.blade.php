<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #8fa8ff;
            color: #000:
        }
        center{
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <center>Laporan Data Penilai</center>
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">NO</th>
              <th scope="col">Nama Mahasiswa</th>
              <th scope="col">Jurusan</th>
              <th scope="col">Kriteria</th>
              <th scope="col">Nilai</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($penilaian as $no => $hasil)
              <tr>
                <td scope="row">{{ $no+1 }}</td>
                <td>{{ $hasil-> Mahasiswa -> nama }}</td>
                <td>{{ $hasil-> Jurusan -> nama_jurusan }}</td>
                <td>{{ $hasil-> Kriteria -> nama_kriteria }}</td>
                <td>{{ $hasil-> nilai}}</td>
              </tr> 
            @endforeach
          </tbody>
      </table>
</body>
</html>
