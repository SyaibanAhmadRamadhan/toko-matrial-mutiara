<?php

namespace App\Exports;

use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ExportPengeluaranKas implements FromView, WithColumnWidths
{

    public function view(): View
    {
        $all = PengeluaranKas::get();
        $total = 0;
        foreach ($all as $key => $x) {
            $total += $x->uang_keluar;
        }
        // dd($total);
        return view('after-revisi.export.pengeluaran', [
            'pengeluaran' =>  PengeluaranKas::orderBy("tanggal_keluar", 'desc')->get(),
            'title' => 'pengeluaran',
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
