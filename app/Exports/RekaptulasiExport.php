<?php

namespace App\Exports;

use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Contracts\View\View;

class RekaptulasiExport implements FromView, WithColumnWidths
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
            $total = 0;
            $totalPemasukan = 0;
            $totalPengeluaran = 0;
            $pengeluaran = PengeluaranKas::where("tanggal_keluar", ">=", $this->dari)->where("tanggal_keluar", "<=", $this->sampai)->get()->toArray();
            $pemasukan = PemasukanKas::where("tanggal_masuk", ">=", $this->dari)->where("tanggal_masuk", "<=", $this->sampai)->get()->toArray();
            $data = array_merge($pemasukan, $pengeluaran);
            for ($i = 0; $i < count($data); $i++) {
                if (isset($data[$i]["tanggal_masuk"])) {
                    $totalPemasukan = $totalPemasukan + $data[$i]["uang_masuk"];
                    $data[$i]["tanggal"] = $data[$i]["tanggal_masuk"];
                    unset($data[$i]["tanggal_masuk"]);
                }
                if (isset($data[$i]["tanggal_keluar"])) {
                    $totalPengeluaran = $totalPengeluaran + $data[$i]["uang_keluar"];
                    $data[$i]["tanggal"] = $data[$i]["tanggal_keluar"];
                    unset($data[$i]["tanggal_keluar"]);
                }
            }
            $tanggal = array();
            for ($i = 0; $i < count($data); $i++) {
                $tanggal[$i] = $data[$i]["tanggal"];
            }
            array_multisort($tanggal, SORT_ASC, $data);
            return view('after-revisi.export.rekaptulasi', [
                'title' => 'rekaptulasi',
                'total' => $total,
                'type' => 'excel',
                'totalPengeluaran' => $totalPengeluaran,
                'totalPemasukan' => $totalPemasukan,
                'total' => $total,
                'data' => $data,
                'dari' => $this->dari,
                'sampai' => $this->sampai,
            ]);
        } else {
            $total = 0;
            $totalPemasukan = 0;
            $totalPengeluaran = 0;
            $pengeluaran = PengeluaranKas::get()->toArray();
            $pemasukan = PemasukanKas::get()->toArray();
            $data = array_merge($pemasukan, $pengeluaran);
            for ($i = 0; $i < count($data); $i++) {
                if (isset($data[$i]["tanggal_masuk"])) {
                    $totalPemasukan = $totalPemasukan + $data[$i]["uang_masuk"];
                    $data[$i]["tanggal"] = $data[$i]["tanggal_masuk"];
                    unset($data[$i]["tanggal_masuk"]);
                }
                if (isset($data[$i]["tanggal_keluar"])) {
                    $totalPengeluaran = $totalPengeluaran + $data[$i]["uang_keluar"];
                    $data[$i]["tanggal"] = $data[$i]["tanggal_keluar"];
                    unset($data[$i]["tanggal_keluar"]);
                }
            }
            $tanggal = array();
            for ($i = 0; $i < count($data); $i++) {
                $tanggal[$i] = $data[$i]["tanggal"];
            }
            array_multisort($tanggal, SORT_ASC, $data);
            return view('after-revisi.export.rekaptulasi', [
                'title' => 'rekaptulasi',
                'total' => $total,
                'type' => 'excel',
                'sampai' => $data[count($data) - 1]["tanggal"],
                'dari' => $data[0]["tanggal"],
                'totalPengeluaran' => $totalPengeluaran,
                'totalPemasukan' => $totalPemasukan,
                'total' => $total,
                'data' => $data
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
            'E' => 28,
            'F' => 28,
        ];
    }
}
