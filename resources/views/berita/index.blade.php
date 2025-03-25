@extends('layouts.home') {{-- Meng-extend view ke layout home --}}

@section('content')
<style>

</style>
@vite(['resources/css/beranda.css', 'resources/js/navbar.js']) {{-- Memanggil file css dan js yang telah di compile oleh vite --}}
<div class="container">
     <!-- Content placeholder -->
     <div class="content">
        <h1>Selamat Datang di Portal Berita Online</h1>
    </div>

    <div class="news-section">
        <h2>Berita Terbaru</h2>
        <div class="news-grid">
            @foreach ($beritas as $berita)
            <div class="news-article" data-category="{{ strtolower($berita->kategori) }}">
                <div class="news-card">
                    @if ($berita->gambar)
                        <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="Gambar Berita">
                    @else
                        <img src="{{ asset('images/default-news.jpg') }}" alt="Default Berita">
                    @endif
                    <h3>{{ $berita->judul }}</h3>
                    <p>{{ Str::limit($berita->isi, 100) }}</p>
                    <a href="{{ route('berita.show', $berita->id) }}" class="read-more">Baca Selengkapnya</a>
                </div>
            </div>
            @endforeach
        </div>
        {{-- //Jika tidak ada berita dalam kategori ini, maka akan muncul pesan berikut --}}
        <div id="no-results-message" style="display:none;" class="text-center mt-5">
            <h3>Tidak ada berita dalam kategori ini.</h2>
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
