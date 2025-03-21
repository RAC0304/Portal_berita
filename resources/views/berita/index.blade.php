@extends('layouts.app')

@section('content')
<style>
    .welcome-content {
        text-align: center;
        padding: 50px 20px;
        background-color: #f9f9f9;
    }

    .welcome-content h1 {
        font-size: 2.5em;
        margin-bottom: 20px;
    }

    .welcome-content p {
        font-size: 1.2em;
        color: #555;
    }

    .news-section {
        padding: 40px 20px;
        background-color: #fff;
    }

    .news-section h2, .categories-section h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2em;
    }

    .news-grid, .categories-grid {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .news-card, .category-card {
        width: 30%;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        background-color: #fff;
    }

    .news-card img {
        width: 100%;
        height: 200px;
        width: 100%;
    }

    .news-card h3, .category-card h3 {
        padding: 15px;
        font-size: 1.5em;
    }

    .news-card p, .category-card p {
        padding: 0 15px 15px;
        color: #555;
    }

    .read-more {
        display: block;
        padding: 10px 15px;
        background-color: #e74c3c;
        color: white;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        margin: 15px;
        transition: background-color 0.3s ease;
    }

    .read-more:hover {
        background-color: #c0392b;
    }

    .categories-section {
        padding: 40px 20px;
        background-color: #f9f9f9;
    }

    .category-card {
        text-align: center;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .news-card, .category-card {
            width: 100%;
            margin-bottom: 20px;
        }
    }
</style>
<div class="container">
     <!-- Content placeholder -->
     <div class="content">
        <h1>Selamat Datang di Portal Berita Online</h1>
        <p>Ini adalah contoh halaman beranda portal berita dengan navbar animasi.</p>
    </div>

    <div class="news-section">
        <h2>Berita Terbaru</h2>
        <div class="news-grid">
            @foreach ($beritas as $berita )
            <div class="news-card">
                @if ($berita->gambar)
                    <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="Gambar Berita" width="50">
                @else
                    Tidak ada gambar
                @endif
                <h3>{{$berita->judul}}</h3>
                <p>{{$berita->isi}}</p>
                <a href="{{ route('berita.show', $berita->id) }}" class="read-more"> Baca Selengkapnya</a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="categories-section">
        <h2>Kategori Berita</h2>
        <div class="categories-grid">
            <div class="category-card">
                <h3>Nasional</h3>
                <p>Berita terkini seputar dalam negeri.</p>
            </div>
            <div class="category-card">
                <h3>Internasional</h3>
                <p>Berita terkini seputar luar negeri.</p>
            </div>
            <div class="category-card">
                <h3>Ekonomi</h3>
                <p>Berita terkini seputar ekonomi dan bisnis.</p>
            </div>
            <div class="category-card">
                <h3>Olahraga</h3>
                <p>Berita terkini seputar olahraga.</p>
            </div>
        </div>
    </div>
</div>
@endsection
