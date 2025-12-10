@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Tambah Komik Baru</h3>

    <form action="{{ route('comic.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label fw-bold">Judul (Original)</label>
                <input type="text" name="title_original" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Judul (Indonesia)</label>
                <input type="text" name="title_indonesia" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Cover Komik</label>
                <input type="file" name="cover_image" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Genre</label>
                <select name="genre_id" class="form-select" required>
                    <option value="">-- Pilih Genre --</option>
                    @foreach ($genres as $g)
                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Tipe</label>
                <select name="type" class="form-select" required>
                    <option value="Manga">Manga</option>
                    <option value="Manhwa">Manhwa</option>
                    <option value="Manhua">Manhua</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Konsep Cerita</label>
                <input type="text" name="story_concept" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Penulis</label>
                <input type="text" name="author" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Rating Umur</label>
                <input type="number" name="age_rating" class="form-control" required>
            </div>

        </div>

        <button class="btn btn-success mt-4 fw-bold">
            <i class="bi bi-check-circle me-2"></i> Simpan Komik
        </button>

    </form>
</div>
@endsection
