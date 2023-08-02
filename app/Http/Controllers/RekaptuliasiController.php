<?php

namespace App\Http\Controllers;

use App\Exports\RekaptulasiExport;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class RekaptuliasiController extends Controller
{
    public function index()
    {
        $total = 0;
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        if (isset($_GET['dari'])  && isset($_GET['sampai'])) {
            $pengeluaran = PengeluaranKas::where("tanggal_keluar", ">=", $_GET['dari'])->where("tanggal_keluar", "<=", $_GET['sampai'])->get()->toArray();
            $pemasukan = PemasukanKas::where("tanggal_masuk", ">=", $_GET['dari'])->where("tanggal_masuk", "<=", $_GET['sampai'])->get()->toArray();
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
            return view('after-revisi.rekaptulasi-kas.index', [
                'title' => 'rekaptulasi-kas',
                'total' => $total,
                'totalPengeluaran' => $totalPengeluaran,
                'totalPemasukan' => $totalPemasukan,
                'data' => $data
            ]);
        }

        $pemasukan = PemasukanKas::orderBy("tanggal_masuk", 'desc')->get()->toArray();
        $pengeluaran = PengeluaranKas::orderBy("tanggal_keluar", 'desc')->get()->toArray();
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
        return view('after-revisi.rekaptulasi-kas.index', [
            'title' => 'rekaptulasi-kas',
            'totalPengeluaran' => $totalPengeluaran,
            'totalPemasukan' => $totalPemasukan,
            'total' => $total,
            'data' => $data
        ]);
    }

    public function export($type)
    {
        if ($_GET['dari'] != "" && $_GET['sampai'] != "") {
            if ($type == "excel") {
                return Excel::download(new RekaptulasiExport($_GET['dari'], $_GET['sampai']), 'rekaptulasi kas.xlsx');
            }

            $total = 0;
            $totalPemasukan = 0;
            $totalPengeluaran = 0;
            $pengeluaran = PengeluaranKas::where("tanggal_keluar", ">=", $_GET['dari'])->where("tanggal_keluar", "<=", $_GET['sampai'])->get()->toArray();
            $pemasukan = PemasukanKas::where("tanggal_masuk", ">=", $_GET['dari'])->where("tanggal_masuk", "<=", $_GET['sampai'])->get()->toArray();
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
            $pdf = FacadePdf::loadView('after-revisi.export.rekaptulasi', [
                'title' => 'rekaptulasi',
                'total' => $total,
                'type' => 'pdf',
                'dari' => $_GET['dari'],
                'sampai' => $_GET['sampai'],
                'totalPengeluaran' => $totalPengeluaran,
                'totalPemasukan' => $totalPemasukan,
                'total' => $total,
                'data' => $data
            ]);
            return $pdf->download('pengeluaran kas.pdf');
        } else {
            if ($type == "excel") {
                return Excel::download(new RekaptulasiExport("", ""), 'rekaptulasi kas.xlsx');
            }
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
            $pdf = FacadePdf::loadView('after-revisi.export.rekaptulasi', [
                'title' => 'rekaptulasi',
                'total' => $total,
                'type' => 'pdf',
                'sampai' => $data[count($data) - 1]["tanggal"],
                'dari' => $data[0]["tanggal"],
                'totalPengeluaran' => $totalPengeluaran,
                'totalPemasukan' => $totalPemasukan,
                'total' => $total,
                'data' => $data
            ]);
            return $pdf->download('pengeluaran kas.pdf');
        }
    }
}
