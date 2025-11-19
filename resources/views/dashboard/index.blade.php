@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-3">KOMIK</h3>

<div class="row g-3">

    @foreach ($comics as $comic)
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <a href="{{ route('comic.show', $comic->id) }}" class="text-decoration-none text-dark">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('uploads/comics/'.$comic->cover_image) }}" 
                         class="card-img-top" 
                         alt="{{ $comic->title_original }}"
                         style="height: 220px; object-fit: cover;">
                    <div class="card-body p-2">
                        <h6 class="card-title text-center mb-0">{{ $comic->title_original }}</h6>
                    </div>
                </div>
            </a>
        </div>
    @endforeach

</div>

@endsection
