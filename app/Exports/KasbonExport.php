<?php

namespace App\Exports;

use App\Models\Kasbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Contracts\View\View;

class KasbonExport implements FromView, WithColumnWidths
{
    private $dari;
    private $sampai;
    private $filter;

    public function __construct(string $dari, string $sampai, string $filter)
    {
        $this->sampai = $sampai;
        $this->dari = $dari;
        $this->filter = $filter;
    }

    public function view(): View
    {
        if ($this->dari != "" && $this->sampai != "") {
            if ($this->filter == "semua") {
                $all = Kasbon::where("tanggal_kasbon", ">=", $this->dari)->where("tanggal_kasbon", "<=", $this->sampai)->get();
                $total = 0;
                foreach ($all as $key => $x) {
                    $total += $x->uang_kasbon;
                }
                return view('after-revisi.export.kasbon', [
                    'kasbon' =>  Kasbon::where("tanggal_kasbon", ">=", $this->dari)->where("tanggal_kasbon", "<=", $this->sampai)->orderBy('status', 'ASC')->orderBy('tanggal_kasbon', 'ASC')->get(),
                    'title' => 'kasbon',
                    'total' => $total,
                    'type' => 'excel',
                    'dari' => $this->dari,
                    'sampai' => $this->sampai,
                ]);
            } else {
                $all = Kasbon::where("tanggal_kasbon", ">=", $this->dari)->where("tanggal_kasbon", "<=", $this->sampai)->where("status", $this->filter)->get();
                $total = 0;
                foreach ($all as $key => $x) {
                    $total += $x->uang_kasbon;
                }
                return view('after-revisi.export.kasbon', [
                    'kasbon' =>  Kasbon::where("tanggal_kasbon", ">=", $this->dari)->where("tanggal_kasbon", "<=", $this->sampai)->where("status", $this->filter)->orderBy('tanggal_kasbon', 'ASC')->get(),
                    'title' => 'kasbon',
                    'total' => $total,
                    'type' => 'excel',
                    'dari' => $this->dari,
                    'sampai' => $this->sampai,
                ]);
            }
        } else {
            if ($this->filter == "semua") {
                $all = Kasbon::get();
                $total = 0;
                foreach ($all as $key => $x) {
                    $total += $x->uang_kasbon;
                }
                return view('after-revisi.export.kasbon', [
                    'kasbon' =>  Kasbon::orderBy('status', 'ASC')->orderBy("tanggal_kasbon", 'asc')->get(),
                    'title' => 'kasbon',
                    'total' => $total,
                    'type' => 'excel',
                    'dari' => Kasbon::orderBy('tanggal_kasbon', 'ASC')->first()->tanggal_kasbon,
                    'sampai' => Kasbon::orderBy('tanggal_kasbon', 'DESC')->first()->tanggal_kasbon,
                ]);
            } else {
                $all = Kasbon::where("status", $this->filter)->get();
                $total = 0;
                foreach ($all as $key => $x) {
                    $total += $x->uang_kasbon;
                }
                return view('after-revisi.export.kasbon', [
                    'kasbon' =>  Kasbon::where("status", $this->filter)->orderBy('status', 'ASC')->orderBy("tanggal_kasbon", 'asc')->get(),
                    'title' => 'kasbon',
                    'total' => $total,
                    'type' => 'excel',
                    'dari' => Kasbon::where("status", $this->filter)->orderBy('tanggal_kasbon', 'ASC')->first()->tanggal_kasbon,
                    'sampai' => Kasbon::where("status", $this->filter)->orderBy('tanggal_kasbon', 'DESC')->first()->tanggal_kasbon,
                ]);
            }
        }
    }

    public function columnWidths(): array
    {
        return [
            'A' => 16,
            'B' => 16,
            'B' => 28,
            'C' => 30,
            'D' => 28,
            'E' => 25,
            'F' => 25,
        ];
    }
}
