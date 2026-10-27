<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
    <h3>Data Biodata</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('biodata.create') }}" class="btn btn-primary mb-3">+ Tambah</a>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Profesi</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($biodata as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($b->foto)
                            <img src="{{ asset('storage/' . $b->foto) }}" width="60" class="rounded">
                        @endif
                    </td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->profesi }}</td>
                    <td>{{ $b->email }}</td>
                    <td>
                        <a href="{{ route('biodata.show', $b->id) }}" class="btn btn-info btn-sm">Lihat CV</a>
                        <a href="{{ route('biodata.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('biodata.destroy', $b->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
