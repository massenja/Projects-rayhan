<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laporan data project</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .subtitle {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<body>
    <h2>LAPORAN DATA PROJECT</h2>
    <div class="subtitle">Tanggal Cetak: {{date('d-m-Y')}}</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Project</th>
                <th>Deskripsi</th>
                <th>Teknologi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $index => $project)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($project->image && file_exists(public_path('images/' . $project->image)))
                            <img src="{{ public_path('images/' . $project->image) }}" alt="Foto Project" width="100">
                        @else
                            <p>No Image Available</p>
                        @endif
                    </td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->teknologi }}</td>
                    <td>{{ $project->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>