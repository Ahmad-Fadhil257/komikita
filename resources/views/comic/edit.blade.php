@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Edit Komik</h3>

    <form action="{{ route('comic.update', $comic->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label fw-bold">Judul (Original)</label>
                <input type="text" class="form-control" name="title_original" value="{{ $comic->title_original }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Judul (Indonesia)</label>
                <input type="text" class="form-control" name="title_indonesia" value="{{ $comic->title_indonesia }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Cover Komik</label>
                <input type="file" class="form-control" name="cover_image">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti.</small>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Genre</label>
                <select class="form-select" name="genre_id" required>
                    @foreach ($genres as $g)
                        <option value="{{ $g->id }}" {{ $comic->genre_id == $g->id ? 'selected' : '' }}>
                            {{ $g->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Tipe</label>
                <select class="form-select" name="type" required>
                    <option {{ $comic->type == 'Manga' ? 'selected' : '' }}>Manga</option>
                    <option {{ $comic->type == 'Manhwa' ? 'selected' : '' }}>Manhwa</option>
                    <option {{ $comic->type == 'Manhua' ? 'selected' : '' }}>Manhua</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Status</label>
                <select class="form-select" name="status" required>
                    <option {{ $comic->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option {{ $comic->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Rating Umur</label>
                <input type="number" class="form-control" name="age_rating" value="{{ $comic->age_rating }}" required>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Konsep Cerita</label>
                <input type="text" class="form-control" name="story_concept" value="{{ $comic->story_concept }}" required>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Penulis</label>
                <input type="text" class="form-control" name="author" value="{{ $comic->author }}" required>
            </div>

        </div>

<form action="{{ route('comic.update', $comic->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <button class="btn btn-success mt-4 fw-bold">
        Simpan Perubahan
    </button>
</form>

    </form>

</div>
@endsection
