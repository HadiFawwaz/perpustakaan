<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $buku = Buku::where('status', 'tersedia')->latest()->get();
        return view('dashboard', compact('buku'));
    }
}
