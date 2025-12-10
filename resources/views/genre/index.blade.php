@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Manajemen Genre</h3>

    <form action="{{ route('genre.store') }}" method="POST" class="d-flex gap-2 mb-3">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="Nama Genre Baru" required>
        <button class="btn btn-primary">Tambah</button>
    </form>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th style="width:50px;">ID</th>
                <th>Nama Genre</th>
                <th style="width:200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $g)
            <tr>
                <td>{{ $g->id }}</td>
                <td>{{ $g->name }}</td>
                <td>

                    {{-- EDIT --}}
                    <form action="{{ route('genre.update', $g->id) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="text" name="name" class="form-control" value="{{ $g->name }}" required>
                        <button class="btn btn-success btn-sm">Update</button>
                    </form>

                    {{-- DELETE --}}
                    <form action="{{ route('genre.delete', $g->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100">Hapus</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
