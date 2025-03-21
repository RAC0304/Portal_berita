@extends('layouts.admin')

@section('content')
@vite(['resources/css/edit.css','resources/js/edit.js'])
<div class="container">
    <div class="berita-container">
        <h1 class="berita-title">Edit Berita</h1>
        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $berita->judul }}" required>
            </div>
            <div class="form-group">
                <label for="isi">Isi</label>
                <textarea name="isi" class="form-control" required>{{ $berita->isi }}</textarea>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" class="form-control" value="{{ $berita->penulis }}" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="Nasional" {{ $berita->kategori == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Internasional" {{ $berita->kategori == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                    <option value="Ekonomi" {{ $berita->kategori == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                    <option value="Olahraga" {{ $berita->kategori == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                    <option value="Teknologi" {{ $berita->kategori == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                    <option value="Hiburan" {{ $berita->kategori == 'Hiburan' ? 'selected' : '' }}>Hiburan</option>
                    <option value="Gaya Hidup" {{ $berita->kategori == 'Gaya Hidup' ? 'selected' : '' }}>Gaya Hidup</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                @if ($berita->gambar)
                <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="Gambar Berita" width="100" class="mt-2">
                @endif
                <div>
                    <input type="file" name="gambar" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</div>
@endsection
