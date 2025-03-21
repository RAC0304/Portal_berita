@extends('layouts.admin')

@section('content')
@vite(['resources/css/create.css','resources/js/create.js'])
<div class="container">
    <div class="berita-container">
        <h1 class="berita-title">Tambah Berita</h1>
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="edit-form">
            @csrf
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="isi">Isi</label>
                <textarea name="isi" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="Nasional" selected>Nasional</option>
                    <option value="Internasional">Internasional</option>
                    <option value="Ekonomi">Ekonomi</option>
                    <option value="Olahraga">Olahraga</option>
                    <option value="Teknologi">Teknologi</option>
                    <option value="Hiburan">Hiburan</option>
                    <option value="Gaya Hidup">Gaya Hidup</option>
                </select>
            </div>
            <button type="submit" class="btn btn-submit">Simpan</button>
        </form>
    </div>
</div>
@endsection
