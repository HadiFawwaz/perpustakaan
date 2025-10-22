<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Admin lihat semua peminjaman
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'buku']);

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter tanggal
        if ($request->start_date) {
            $query->where('tanggal_pinjam', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->where('tanggal_pinjam', '<=', $request->end_date);
        }

        $peminjaman = $query->get();

        return view('jaga.peminjaman.index', compact('peminjaman'));
    }

    // Form pinjam (siswa)
    public function create($id)
    {
        $buku = Buku::findOrFail($id);
        $siswa = Auth::user();
        return view('jaga.peminjaman.create', compact('buku', 'siswa'));
    }

    // Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam'
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < $request->jumlah) {
            return back()->with('error', 'Stok buku tidak mencukupi!');
        }

        $buku->decrement('stok', $request->jumlah);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        return redirect()->route('dashboard')->with('success', 'Buku berhasil dipinjam!');
    }

    // Admin ubah status
    public function updateStatus(Request $request, $id)
    {
        // Cek role
        if (Auth::user()->role !== 'jaga' && Auth::user()->role !== 'admin') {
            return back()->with('error', 'Anda tidak memiliki akses untuk mengubah status!');
        }

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();

        return back()->with('success', 'Status peminjaman diperbarui!');
    }
    // Tampilkan detail peminjaman
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])->findOrFail($id);

        // Optional: hanya user terkait atau admin/jaga yang bisa lihat
        if (Auth::user()->role === 'siswa' && Auth::id() !== $peminjaman->user_id) {
            return back()->with('error', 'Anda tidak memiliki akses untuk melihat peminjaman ini!');
        }

        return view('jaga.peminjaman.show', compact('peminjaman'));
    }
}
