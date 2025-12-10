@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Navigasi kembali --}}
    <div class="mb-4">
        <a href="/" class="text-decoration-none text-dark d-inline-flex align-items-center">
            <i class="bi bi-arrow-left-circle-fill me-2" style="font-size: 1.5rem;"></i>
            <span class="fw-bold">Kembali ke Daftar Komik</span>
        </a>
    </div>

    <h3 class="mb-4 fw-bold">Pengaturan Akun & Profil</h3>

    <div class="row g-4">

        {{-- Sidebar Profil --}}
        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0">

                <div class="text-center">

                    {{-- Foto Profil --}}
                    @if ($user->profile_image)
                        <img src="{{ asset($user->profile_image) }}"
                             class="rounded-circle mb-3 shadow-sm"
                             width="120" height="120" style="object-fit: cover;">
                    @else
                        <i class="bi bi-person-circle display-1 text-primary mb-3"></i>
                    @endif

                    <h5 class="fw-bold">{{ $user->name }}</h5>
                    <p class="text-muted small">{{ $user->email }}</p>
                    <span class="badge bg-secondary mb-3">{{ $user->role }}</span>
                </div>

                <hr>

                {{-- Form update profil --}}
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-2">
                        <label class="form-label small fw-bold">Nama Baru</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Foto Profil</label>
                        <input type="file" class="form-control" name="profile_image">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password Baru (opsional)</label>
                        <input type="password" class="form-control" name="password">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>

                    <button class="btn btn-primary w-100 mb-3 fw-bold">
                        <i class="bi bi-floppy me-2"></i> Update Profil
                    </button>
                </form>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger w-100 fw-bold">
                        <i class="bi bi-box-arrow-right me-2"></i> Keluar (Logout)
                    </button>
                </form>

            </div>
        </div>

        {{-- Sidebar Kanan (Bookmark, History, Settings) --}}
        <div class="col-md-8">

            <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="bookmark-tab" data-bs-toggle="tab" data-bs-target="#bookmark" type="button" role="tab">
                        <i class="bi bi-bookmark-fill me-1"></i> Bookmark Saya
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                        <i class="bi bi-clock-history me-1"></i> Riwayat Dibuka
                    </button>
                </li>
            </ul>

            <div class="tab-content">

                {{-- Bookmark --}}
                <div class="tab-pane fade show active" id="bookmark">
                    <div class="card p-3 shadow-sm border-0">
                        <h5 class="fw-bold">Daftar Bookmark Komik</h5>
                        <hr>

                        <div class="list-group list-group-flush">
                            @forelse ($bookmarks as $b)
                                <div class="list-group-item d-flex align-items-center">
                                    <img src="{{ asset($b->comic->cover_image) }}"
                                         width="60"
                                         class="me-3 rounded shadow-sm"
                                         style="aspect-ratio: 2/3; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <a href="{{ route('comic.show', $b->comic->id) }}" class="text-decoration-none text-dark fw-bold">
                                            {{ $b->comic->title_original }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-muted p-3">Anda belum menambahkan bookmark.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- History --}}
                <div class="tab-pane fade" id="history">
                    <div class="card p-3 shadow-sm border-0">
                        <h5 class="fw-bold">Aktivitas Terbaru Anda</h5>
                        <hr>

                        <div class="list-group list-group-flush">
                            @forelse ($history as $h)
                                <div class="list-group-item d-flex align-items-center">
                                    <img src="{{ asset($h->comic->cover_image) }}"
                                         width="60" class="me-3 rounded shadow-sm"
                                         style="aspect-ratio: 2/3; object-fit: cover;">

                                    <div class="flex-grow-1">
                                        <a href="{{ route('comic.show', $h->comic->id) }}" class="text-decoration-none text-dark fw-bold">
                                            {{ $h->comic->title_original }}
                                        </a>
                                        <small class="d-block text-muted">
                                            Terakhir dibuka: {{ $h->updated_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted p-3">Riwayat membaca Anda masih kosong.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
