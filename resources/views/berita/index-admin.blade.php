{{-- Memanggil layout admin.blade.php --}}
@extends('layouts.admin')
{{-- ----- --}}
@section('content')
@vite(['resources/css/index.css', 'resources/js/index.js']) {{-- Memanggil file css dan js yang telah di compile oleh vite --}}
<div class="container">
    <h1>Daftar Berita</h1>
    <a href="{{ route('berita.create') }}" class="btn btn-primary">Tambah Berita</a>
    <table class="table table-secondary table-striped mt-3">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Penulis</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beritas as $berita)
            <tr>
                <td>{{ $berita->judul }}</td>
                <td>
                    @if ($berita->gambar)
                        <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="Gambar Berita" width="50">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>{{ $berita->penulis }}</td>
                <td class="text-center">
                    <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-info">Lihat</a>
                    <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
