<?php

namespace App\Http\Controllers;

use App\Models\Kasbon;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'home',
            'pengeluaran' => PengeluaranKas::all(),
            'pemasukan' => PemasukanKas::all(),
            'kasbon' => Kasbon::all()
        ]);
    }
}
