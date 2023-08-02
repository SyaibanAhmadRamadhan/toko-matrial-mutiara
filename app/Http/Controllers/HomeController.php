<?php

namespace App\Http\Controllers;

use App\Models\Kasbon;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;

class HomeController extends Controller
{
    public function index()
    {
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        $totalKasbon = 0;
        $pemasukan = PemasukanKas::all();
        $pengeluaran = PengeluaranKas::all();
        $kasbon = Kasbon::all();
        foreach ($pemasukan as $key => $x) {
            $totalPemasukan = $totalPemasukan + $x->uang_masuk;
        }
        foreach ($pengeluaran as $key => $x) {
            $totalPengeluaran = $totalPengeluaran + $x->uang_keluar;
        }
        foreach ($kasbon as $key => $x) {
            $totalKasbon = $totalKasbon + $x->uang_kasbon;
        }
        return view('index', [
            'title' => 'home',
            'pengeluaran' => $pengeluaran,
            'pemasukan' => $pemasukan,
            'kasbon' => $kasbon,
            'totalPengeluaran' => $totalPengeluaran,
            'totalPemasukan' => $totalPemasukan,
            'totalKasbon' => $totalKasbon
        ]);
    }
}
