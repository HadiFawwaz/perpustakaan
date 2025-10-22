<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // Admin lihat semua buku (dengan search & filter)
    public function index(Request $request)
    {
        // Ambil parameter dari request
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        // Query dasar
        $query = Buku::query();

        // Filter pencarian judul atau penulis
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if (!empty($kategori)) {
            $query->where('kategori', $kategori);
        }

        // Ambil hasil
        $buku = $query->latest()->get();

        return view('jaga.index', compact('buku', 'search', 'kategori'));
    }

    // Form tambah buku
    public function create()
    {
        return view('jaga.buku.create');
    }

    // Simpan buku
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer',
            'status' => 'required',
            'deskripsi' => 'required',
            'sampul' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->hasFile('sampul')
            ? $request->file('sampul')->store('sampul', 'public')
            : null;

        Buku::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'sampul' => $path,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('jaga.buku.edit', compact('buku'));
    }

    // Update buku
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer',
            'status' => 'required',
            'deskripsi' => 'required',
            'sampul' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('sampul')) {
            if ($buku->sampul) {
                Storage::disk('public')->delete($buku->sampul);
            }
            $buku->sampul = $request->file('sampul')->store('sampul', 'public');
        }

        $buku->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    // Hapus buku
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku->sampul) Storage::disk('public')->delete($buku->sampul);
        $buku->delete();
        return back()->with('success', 'Buku dihapus!');
    }

    // Siswa lihat daftar buku
    public function listForStudent(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $query = Buku::where('stok', '>', 0);

        if (!empty($search)) {
            $query->where('judul', 'like', "%{$search}%");
        }

        if (!empty($kategori)) {
            $query->where('kategori', $kategori);
        }

        $buku = $query->latest()->get();

        return view('siswa.dashboard', compact('buku', 'search', 'kategori'));
    }

    // Detail buku siswa / admin
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('jaga.buku.show', compact('buku'));
    }
}
