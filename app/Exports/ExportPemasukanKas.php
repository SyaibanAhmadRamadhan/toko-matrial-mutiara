<?php

namespace App\Exports;

use App\Models\PemasukanKas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ExportPemasukanKas implements FromView, WithColumnWidths
{

    public function view(): View
    {
        $all = PemasukanKas::get();
        $total = 0;
        foreach ($all as $key => $x) {
            $total += $x->uang_masuk;
        }
        // dd($total);
        return view('after-revisi.export.pemasukan', [
            'pemasukan' =>  PemasukanKas::orderBy("tanggal_masuk", 'desc')->get(),
            'title' => 'pemasukan',
            'total' => $total
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 16,
            'B' => 16,
            'C' => 30,
            'D' => 28,
        ];
    }
}
