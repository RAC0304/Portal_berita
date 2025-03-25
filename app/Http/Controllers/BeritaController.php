<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $jumlahBerita = Berita::count();
        $beritas = Berita::latest()->paginate(10); // Tambahkan latest() untuk mengurutkan berita terbaru
        return view('berita.index', compact('beritas', 'jumlahBerita'));
    }

    public function create()
    {
        $jumlahBerita = Berita::count();
        return view('berita.create', compact('jumlahBerita'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'penulis' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
            'kategori' => 'required|in:Nasional,Internasional,Ekonomi,Olahraga,Teknologi,Hiburan,Gaya Hidup', // Validasi kategori
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads'), $namaGambar);
        } else {
            $namaGambar = null; // Jika tidak ada gambar yang diunggah
        }

        // Simpan data ke database
        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'penulis' => $request->penulis,
            'gambar' => $namaGambar,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function show($id)
    {
        $jumlahBerita = Berita::count();
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita', 'jumlahBerita'));
    }

    public function edit($id)
    {
        $jumlahBerita = Berita::count();
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita', 'jumlahBerita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'penulis' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori' => 'required|in:Nasional,Internasional,Ekonomi,Olahraga,Teknologi,Hiburan,Gaya Hidup',
        ]);

        // Jika ada permintaan untuk menghapus gambar
        if ($request->has('remove_gambar') && $request->remove_gambar == '1') {
            // Hapus gambar lama jika ada
            if ($berita->gambar && file_exists(public_path('uploads/' . $berita->gambar))) {
                unlink(public_path('uploads/' . $berita->gambar));
            }
            $berita->gambar = null; // Set kolom gambar ke null
        }

        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && file_exists(public_path('uploads/' . $berita->gambar))) {
                unlink(public_path('uploads/' . $berita->gambar));
            }

            // Upload gambar baru
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads'), $namaGambar);
            $berita->gambar = $namaGambar;
        }

        // Update data lainnya
        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->penulis = $request->penulis;
        $berita->kategori = $request->kategori;
        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->gambar && file_exists(public_path('uploads/' . $berita->gambar))) {
            unlink(public_path('uploads/' . $berita->gambar));
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $jumlahBerita = Berita::count();

        // Gunakan paginate() agar hasilnya bisa dipaginasi
        $beritas = Berita::where('judul', 'like', "%$query%")
                        ->orWhere('isi', 'like', "%$query%")
                        ->orWhere('kategori', 'like', "%$query%")
                        ->latest()
                        ->paginate(10);

        // Tambahkan parameter jumlahBerita ke view
        return view('berita.index', compact('beritas', 'jumlahBerita', 'query'));
    }

    // Tambahan method untuk filter berdasarkan kategori
    public function filterByCategory($category)
    {
        $jumlahBerita = Berita::count();
        $beritas = Berita::where('kategori', $category)
                        ->latest()
                        ->paginate(10);

        return view('berita.index', compact('beritas', 'jumlahBerita', 'category'));
    }
}