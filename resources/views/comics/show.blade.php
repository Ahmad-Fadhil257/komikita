@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-4">

        <img src="{{ asset('uploads/comics/'.$comic->cover_image) }}" 
             class="img-fluid rounded shadow"
             alt="{{ $comic->title_original }}">

    </div>

    <div class="col-md-8">

        <table class="table table-borderless mt-3">
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

        @guest
            <a href="/login" class="btn btn-primary mt-3 w-50">+ Tambah Bookmark</a>
        @endguest

        @auth
            <form method="POST" action="/bookmark/add" class="mt-3">
                @csrf
                <input type="hidden" name="comic_id" value="{{ $comic->id }}">
                <button type="submit" class="btn btn-primary w-50">
                    + Tambah Bookmark
                </button>
            </form>
        @endauth

    </div>
</div>

@endsection
