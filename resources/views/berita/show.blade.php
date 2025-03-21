@extends('layouts.app')

@section('content')
<style>
    .berita-detail {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 0 auto;
}

.berita-gambar {
    width: 100%;
    border-radius: 8px;
    margin-bottom: 20px;
}

.no-image {
    background-color: #f4f4f4;
    padding: 20px;
    text-align: center;
    border-radius: 8px;
    margin-bottom: 20px;
    color: #555;
}

.berita-content {
    padding: 0 20px;
}

.berita-judul {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #333;
}

.berita-penulis {
    font-size: 1.2em;
    color: #777;
    margin-bottom: 20px;
}

.berita-isi {
    font-size: 1.1em;
    line-height: 1.6;
    color: #555;
    margin-bottom: 30px;
}

.btn-secondary {
    background-color: #6c757d;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

@media (max-width: 768px) {
    .berita-judul {
        font-size: 2em;
    }

    .berita-penulis {
        font-size: 1em;
    }

    .berita-isi {
        font-size: 1em;
    }
}

</style>
<div class="content">
    <div class="berita-detail">
        @if ($berita->gambar)
            <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="Gambar Berita" class="img-fluid berita-gambar">
        @else
            <div class="no-image">
                <p>Tidak ada gambar</p>
            </div>
        @endif

        <div class="berita-content">
            <h1 class="berita-judul">{{ $berita->judul }}</h1>
            <p class="berita-penulis">Penulis: {{ $berita->penulis }}</p>
            <p class="berita-isi">{{ $berita->isi }}</p>
            <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
