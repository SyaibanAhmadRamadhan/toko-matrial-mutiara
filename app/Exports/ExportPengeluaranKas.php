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
    private $dari;
    private $sampai;

    public function __construct(string $dari, string $sampai)
    {
        $this->sampai = $sampai;
        $this->dari = $dari;
    }

    public function view(): View
    {
        if ($this->dari != "" && $this->sampai != "") {
            $all = PengeluaranKas::where("tanggal_keluar", ">=", $this->dari)->where("tanggal_keluar", "<=", $this->sampai)->get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_keluar;
            }
            return view('after-revisi.export.pengeluaran', [
                'pengeluaran' =>  PengeluaranKas::where("tanggal_keluar", ">=", $this->dari)->where("tanggal_keluar", "<=", $this->sampai)->orderBy('tanggal_keluar', 'ASC')->get(),
                'title' => 'pengeluaran',
                'total' => $total,
                'type' => 'excel',
                'dari' => $this->dari,
                'sampai' => $this->sampai,
            ]);
        } else {
            $all = PengeluaranKas::get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_keluar;
            }
            // dd($total);
            return view('after-revisi.export.pengeluaran', [
                'pengeluaran' =>  PengeluaranKas::orderBy("tanggal_keluar", 'asc')->get(),
                'title' => 'pengeluaran',
                'total' => $total,
                'type' => 'excel',
                'dari' => PengeluaranKas::orderBy('tanggal_keluar', 'ASC')->first()->tanggal_keluar,
                'sampai' => PengeluaranKas::orderBy('tanggal_keluar', 'DESC')->first()->tanggal_keluar,
            ]);
        }
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
