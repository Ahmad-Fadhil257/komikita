@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Profil Saya</h3>

    <div class="row">
        <!-- Profile Box -->
        <div class="col-md-4">
            <div class="card p-3">
                
                <div class="text-center">
                    <img src="{{ $user->profile_image ? asset($user->profile_image) : 'https://via.placeholder.com/120' }}" 
                         class="rounded-circle mb-3" width="120">

                    <h5>{{ $user->name }}</h5>
                    <p class="text-muted mb-3">User Role: {{ $user->role }}</p>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-2">
                        <label>Nama Baru</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label>Foto Profil</label>
                        <input type="file" class="form-control" name="profile_image">
                    </div>

                    <button class="btn btn-primary w-100">Update Profil</button>
                </form>
            </div>
        </div>

        <!-- Bookmark & History -->
        <div class="col-md-8">

            <!-- Bookmark -->
            <div class="card mb-4 p-3">
                <h5>Bookmark Saya</h5>
                <hr>

                @forelse ($bookmarks as $b)
                    <div class="d-flex mb-2">
                        <img src="{{ asset($b->comic->cover_image) }}" width="60" class="me-3">
                        <div>
                            <strong>{{ $b->comic->title_original }}</strong><br>
                            <a href="{{ route('comic.show', $b->comic->id) }}">Lihat Komik</a>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada bookmark.</p>
                @endforelse
            </div>

            <!-- History -->
            <div class="card p-3">
                <h5>Riwayat Dibuka</h5>
                <hr>

                @forelse ($history as $h)
                    <div class="d-flex mb-2">
                        <img src="{{ asset($h->comic->cover_image) }}" width="60" class="me-3">
                        <div>
                            <strong>{{ $h->comic->title_original }}</strong><br>
                            <small class="text-muted">Terakhir dibuka: {{ $h->updated_at->diffForHumans() }}</small><br>
                            <a href="{{ route('comic.show', $h->comic->id) }}">Lihat Komik</a>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada history.</p>
                @endforelse

            </div>

        </div>
    </div>

</div>
@endsection
