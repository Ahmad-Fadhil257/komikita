@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">KOMIK</h3>

    @if (auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('comic.create') }}" class="btn btn-primary fw-bold">
            <i class="bi bi-plus-circle me-1"></i> Tambah Komik
        </a>
    @endif
</div>

@if(request('search'))
    <div class="mb-4">
        <a href="{{ route('comic.index') }}"
           class="text-decoration-none text-dark d-inline-flex align-items-center">
            <i class="bi bi-arrow-left-circle-fill me-2 fs-4"></i>
            <span class="fw-bold">Kembali ke Daftar Komik</span>
        </a>
    </div>
@endif

<div class="row g-3">
@foreach ($comics as $comic)
    <div class="col-6 col-md-4 col-lg-3 col-xl-2">

        <div class="card h-100 shadow-sm">

            {{-- Cover --}}
            <a href="{{ route('comic.show', $comic->id) }}" class="text-decoration-none">
                <img src="{{ asset($comic->cover_image) }}"
                     class="card-img-top"
                     alt="{{ $comic->title_original }}"
                     style="height:220px; object-fit:cover;">
            </a>

            {{-- Title --}}
            <div class="card-body text-center p-2">
                <h6 class="fw-bold mb-2 text-truncate"
                    title="{{ $comic->title_original }}">
                    {{ $comic->title_original }}
                </h6>

                {{-- Admin Buttons --}}
                @if (auth()->check() && auth()->user()->role === 'admin')
                    <div class="d-flex justify-content-center gap-2 mt-2">
                        <a href="{{ route('comic.edit', $comic->id) }}"
                           class="btn btn-sm btn-warning text-white fw-bold">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <button class="btn btn-sm btn-danger fw-bold"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $comic->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" id="deleteModal{{ $comic->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Hapus Komik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus komik:
                    <strong>{{ $comic->title_original }}</strong> ?
                </div>

                <div class="modal-footer">
                    <form action="{{ route('comic.destroy', $comic->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach
</div>

@endsection
