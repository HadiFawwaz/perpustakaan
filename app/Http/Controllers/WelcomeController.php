<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class WelcomeController extends Controller
{


    public function index()
    {
        $buku = Buku::latest()->take(4)->get(); // ambil 4 buku terbaru
        return view('welcome', compact('buku'));
    }
}
