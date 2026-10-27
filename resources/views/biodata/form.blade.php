<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Biodata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h3>{{ isset($biodata) ? 'Edit' : 'Tambah' }} Biodata</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
        </div>
    @endif

    <form action="{{ isset($biodata) ? route('biodata.update', $biodata->id) : route('biodata.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($biodata)) @method('PUT') @endif

        @foreach (['nama', 'profesi', 'email', 'telepon', 'alamat', 'pendidikan', 'skill'] as $f)
            <div class="mb-3">
                <label class="form-label text-capitalize">{{ $f }}</label>
                <input type="text" name="{{ $f }}" class="form-control"
                       value="{{ old($f, $biodata->$f ?? '') }}">
            </div>
        @endforeach

        <div class="mb-3">
            <label class="form-label">Tentang Saya</label>
            <textarea name="tentang" class="form-control" rows="4">{{ old('tentang', $biodata->tentang ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" name="foto" class="form-control">
            @if (isset($biodata) && $biodata->foto)
                <img src="{{ asset('storage/'.$biodata->foto) }}" width="100" class="mt-2 rounded">
            @endif
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('biodata.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
