<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Employes;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use App\Models\Position;
use App\Models\Product;
use App\Models\SpendingProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'home',
            'pengeluaran' => PengeluaranKas::all(),
            'pemasukan' => PemasukanKas::all(),
        ]);
    }
}
