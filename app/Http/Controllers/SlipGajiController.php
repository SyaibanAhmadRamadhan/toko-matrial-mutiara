<?php

namespace App\Http\Controllers;

use App\Models\Employes;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF;

class SlipGajiController extends Controller
{
    public function index()
    {
        return view('slip-gaji.index', [
            'title' => 'slip-gaji',
            'employes' => Employes::all()
        ]);
    }

    public function cetak(Request $request)
    {
        $pdf = PDF::loadView('export.gajiKaryawan', [
            'employe' =>  Employes::where('id', $request->name)->first(),
        ]);
        return $pdf->download('USERS Language.pdf');
    }
}
