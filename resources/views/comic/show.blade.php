@extends('layouts.app')

@section('content')

<div class="container">

    {{-- Panah Kembali --}}
    <div class="mb-4 ">
        <a href="{{ route('comic.index') }}"
           class="text-decoration-none text-dark d-inline-flex align-items-center">
            <i class="bi bi-arrow-left-circle-fill me-2 fs-4"></i>
            <span class="fw-bold">Kembali ke Daftar Komik</span>
        </a>
    </div>

    <div class="row justify-content-center">

        {{-- COVER --}}
        <div class="text-center mb-4">
            <img src="{{ asset($comic->cover_image) }}"
                 class="img-fluid rounded shadow"
                 alt="{{ $comic->title_original }}"
                 style="max-height:420px;">
        </div>

        {{-- DETAIL --}}
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-8">
            <table class="table table-borderless">
                <tr>
                    <th class="w-25">Judul Asli</th>
                    <td>{{ $comic->title_original }}</td>
                </tr>
                <tr>
                    <th>Judul Indo</th>
                    <td>{{ $comic->title_indonesia }}</td>
                </tr>
                <tr>
                    <th>Jenis Komik</th>
                    <td>{{ $comic->type }}</td>
                </tr>
                <tr>
                    <th>Konsep Cerita</th>
                    <td>{{ $comic->story_concept }}</td>
                </tr>
                <tr>
                    <th>Pengarang</th>
                    <td>{{ $comic->author }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $comic->status }}</td>
                </tr>
                <tr>
                    <th>Umur Pembaca</th>
                    <td>{{ $comic->age_rating }}+</td>
                </tr>
                <tr>
                    <th>Genre</th>
                    <td>
                        @if($comic->genre)
                            <span class="badge bg-secondary">{{ $comic->genre->name }}</span>
                        @else
                            <span class="text-muted">Tidak ada genre</span>
                        @endif
                    </td>
                </tr>
            </table>
    </div>
</div>
            {{-- Admin Buttons --}}
            @if (auth()->check() && auth()->user()->role === 'admin')
                <div class="d-flex justify-content-center gap-2 mt-3 mb-4">
                    <a href="{{ route('comic.edit', $comic->id) }}"
                       class="btn btn-warning fw-bold text-white">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>

                    <button class="btn btn-danger fw-bold"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                        <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                </div>
            @endif

            {{-- Bookmark --}}
            <div class="text-center">
                @guest
                    <a href="/login" class="btn btn-primary mt-3 w-40">
                        + Tambah Bookmark
                    </a>
                @endguest

                @auth
                    <form method="POST" action="/bookmark/add" class="mt-3">
                        @csrf
                        <input type="hidden" name="comic_id" value="{{ $comic->id }}">
                        <button type="submit" class="btn btn-primary w-40">
                            + Tambah Bookmark
                        </button>
                    </form>
                @endauth
            </div>
    </div>
</div>

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Komik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Apakah Anda yakin ingin menghapus komik:
                <strong>{{ $comic->title_original }}</strong> ?
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary fw-bold" data-bs-dismiss="modal">
                    Batal
                </button>

                <form action="{{ route('comic.destroy', $comic->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger fw-bold">Hapus</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
