<?php

namespace App\Exports;

use App\Models\PemasukanKas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ExportPemasukanKas implements FromView, WithColumnWidths
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
            $all = PemasukanKas::where("tanggal_masuk", ">=", $this->dari)->where("tanggal_masuk", "<=", $this->sampai)->get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_masuk;
            }
            return view('after-revisi.export.pemasukan', [
                'pemasukan' =>  PemasukanKas::where("tanggal_masuk", ">=", $this->dari)->where("tanggal_masuk", "<=", $this->sampai)->orderBy('tanggal_masuk', 'ASC')->get(),
                'title' => 'pemasukan',
                'total' => $total,
                'type' => 'excel',
                'dari' => $this->dari,
                'sampai' => $this->sampai,
            ]);
        } else {
            $all = PemasukanKas::get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_masuk;
            }
            // dd($total);
            return view('after-revisi.export.pemasukan', [
                'pemasukan' =>  PemasukanKas::orderBy("tanggal_masuk", 'asc')->get(),
                'title' => 'pemasukan',
                'total' => $total,
                'type' => 'excel',
                'dari' => PemasukanKas::orderBy('tanggal_masuk', 'ASC')->first()->tanggal_masuk,
                'sampai' => PemasukanKas::orderBy('tanggal_masuk', 'DESC')->first()->tanggal_masuk,
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
