<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV {{ $biodata->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #e9ecef;
        }

        .cv {
            max-width: 950px;
            background: #fff;
            overflow: hidden;
            border-radius: 12px;
        }

        .side {
            background: #1f2d3d;
            color: #fff;
            padding: 32px 24px;
        }

        .photo {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #3b82a0;
            background: #dee2e6;
        }

        .main {
            padding: 36px;
        }

        .name {
            font-size: 2.2rem;
            font-weight: 800;
            text-transform: uppercase;
            line-height: 1.1;
        }

        .title {
            color: #3b82a0;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: .95rem;
            border-bottom: 2px solid #3b82a0;
            padding-bottom: 4px;
            margin: 24px 0 12px;
        }

        .side .title {
            color: #fff;
            border-color: #3b82a0;
        }

        .skill-badge {
            background: #3b82a0;
            color: #fff;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: .8rem;
            display: inline-block;
            margin: 2px;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="cv mx-auto shadow">
            <div class="row g-0">

                {{-- SIDEBAR --}}
                <div class="col-md-4 side text-center">
                    @if ($biodata->foto)
                        <img src="{{ asset('storage/' . $biodata->foto) }}" class="photo mb-3">
                    @else
                        <div class="photo mb-3 mx-auto"></div>
                    @endif
                    <form action="{{ route('biodata.foto', $biodata->id) }}" method="POST"
                        enctype="multipart/form-data" class="mb-3">
                        @csrf
                        <input type="file" name="foto" id="inputFoto" accept="image/*" class="d-none"
                            onchange="this.form.submit()">
                        <label for="inputFoto" class="btn btn-outline-light btn-sm">Ganti Foto</label>
                    </form>

                    <h4 class="mb-0">{{ $biodata->nama }}</h4>
                    <div class="text-info mb-3">{{ $biodata->profesi }}</div>

                    <div class="title text-start">Kontak</div>
                    <div class="small text-start">
                        <div class="mb-1">📧 {{ $biodata->email }}</div>
                        <div class="mb-1">📞 {{ $biodata->telepon }}</div>
                        <div class="mb-1">📍 {{ $biodata->alamat }}</div>
                    </div>

                    <div class="title text-start">Skills</div>
                    <div class="text-start">
                        @foreach (explode(',', $biodata->skill) as $s)
                            <span class="skill-badge">{{ trim($s) }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- KONTEN --}}
                <div class="col-md-8 main">
                    @if (session('success'))
                        <div class="alert alert-success py-2 small">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small">
                            @foreach ($errors->all() as $e)
                                <div>{{ $e }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="name">{{ $biodata->nama }}</div>

                    <div class="title">Profile</div>
                    <p class="small">{{ $biodata->tentang }}</p>

                    <div class="title">Education</div>
                    <p class="small">{{ $biodata->pendidikan }}</p>

                    {{-- PENGALAMAN --}}
                    <div class="title">Experience</div>
                    @foreach ($biodata->pengalaman as $p)
                        <div class="mb-3 small">
                            <strong>{{ $p->posisi }}</strong> &ndash; {{ $p->perusahaan }}
                            <span class="text-secondary">({{ $p->tahun }})</span>
                            <button class="btn btn-link btn-sm p-0 ms-2" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $p->id }}">edit</button>
                            <form action="{{ route('pengalaman.destroy', $p->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus pengalaman ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-link btn-sm text-danger p-0 ms-1">hapus</button>
                            </form>
                        </div>

                        {{-- Modal edit --}}
                        <div class="modal fade" id="edit{{ $p->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('pengalaman.update', $p->id) }}" method="POST"
                                    class="modal-content">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h6 class="modal-title">Edit Pengalaman</h6>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="perusahaan" class="form-control mb-2"
                                            value="{{ $p->perusahaan }}" required>
                                        <input type="text" name="posisi" class="form-control mb-2"
                                            value="{{ $p->posisi }}" required>
                                        <input type="text" name="tahun" class="form-control"
                                            value="{{ $p->tahun }}" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary btn-sm">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <form action="{{ route('pengalaman.store') }}" method="POST" class="row g-2 mb-2">
                        @csrf
                        <input type="hidden" name="biodata_id" value="{{ $biodata->id }}">
                        <div class="col-12"><input type="text" name="perusahaan" class="form-control form-control-sm"
                                placeholder="Perusahaan / Organisasi" required></div>
                        <div class="col-7"><input type="text" name="posisi" class="form-control form-control-sm"
                                placeholder="Posisi" required></div>
                        <div class="col-5"><input type="text" name="tahun" class="form-control form-control-sm"
                                placeholder="Tahun" required></div>
                        <div class="col-12"><button class="btn btn-outline-primary btn-sm">+ Tambah
                                Pengalaman</button>
                        </div>
                    </form>

                    {{-- DOKUMEN --}}
                    <div class="title">Dokumen / Sertifikat</div>
                    <ul class="small">
                        @foreach ($biodata->dokumen as $d)
                            <li class="mb-1">
                                <a href="{{ asset('storage/' . $d->file) }}" target="_blank">{{ $d->nama }}</a>
                                <button type="button" class="btn btn-link btn-sm p-0 ms-2" data-bs-toggle="modal"
                                    data-bs-target="#editDok{{ $d->id }}">edit</button>
                                <form action="{{ route('dokumen.destroy', $d->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-link btn-sm text-danger p-0 ms-1">hapus</button>
                                </form>
                            </li>

                            {{-- Modal edit dokumen --}}
                            <div class="modal fade" id="editDok{{ $d->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('dokumen.update', $d->id) }}" method="POST"
                                        enctype="multipart/form-data" class="modal-content">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h6 class="modal-title">Edit Dokumen</h6>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label small">Nama dokumen</label>
                                            <input type="text" name="nama" class="form-control mb-2"
                                                value="{{ $d->nama }}" required>
                                            <label class="form-label small">Ganti file (kosongkan jika tidak
                                                diganti)</label>
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </ul>

                    <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data"
                        class="row g-2">
                        @csrf
                        <input type="hidden" name="biodata_id" value="{{ $biodata->id }}">
                        <div class="col-12"><input type="text" name="nama"
                                class="form-control form-control-sm"
                                placeholder="Nama dokumen (mis. Sertifikat Laravel)" required></div>
                        <div class="col-12"><input type="file" name="file"
                                class="form-control form-control-sm" required></div>
                        <div class="col-12"><button class="btn btn-outline-primary btn-sm">+ Upload Dokumen</button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('biodata.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
