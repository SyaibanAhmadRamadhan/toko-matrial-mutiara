<?php

namespace App\Http\Controllers;

use App\Exports\ExportPemasukanKas;
use App\Models\PemasukanKas;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanController extends Controller
{
    public function index()
    {
        if (isset($_GET['dari'])  && isset($_GET['sampai'])) {
            return view('after-revisi.pemasukan-kas.index', [
                'title' => 'pemasukan-kas',
                'pemasukan' => PemasukanKas::where("tanggal_masuk", ">=", $_GET['dari'])->where("tanggal_masuk", "<=", $_GET['sampai'])->get()
            ]);
        }
        // dd(phpinfo());
        return view('after-revisi.pemasukan-kas.index', [
            'title' => 'pemasukan-kas',
            'pemasukan' => PemasukanKas::orderBy("tanggal_masuk", 'desc')->get()
        ]);
    }

    public function export($type)
    {

        if ($_GET['dari'] != "" && $_GET['sampai'] != "") {
            if ($type == "excel") {
                return Excel::download(new ExportPemasukanKas($_GET['dari'], $_GET['sampai']), 'pemasukan kas.xlsx');
            }
            $all = PemasukanKas::where("tanggal_masuk", ">=", $_GET['dari'])->where("tanggal_masuk", "<=", $_GET['sampai'])->get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_masuk;
            }
            $pdf = FacadePdf::loadView('after-revisi.export.pemasukan', [
                'pemasukan' =>  PemasukanKas::where("tanggal_masuk", ">=", $_GET['dari'])->where("tanggal_masuk", "<=", $_GET['sampai'])->orderBy('tanggal_masuk', 'ASC')->get(),
                'title' => 'pemasukan',
                'total' => $total,
                'type' => 'pdf',
                'dari' => $_GET['dari'],
                'sampai' => $_GET['sampai'],
            ]);
            return $pdf->download('pemasukan kas.pdf');
        } else {
            if ($type == "excel") {
                return Excel::download(new ExportPemasukanKas("", ""), 'pemasukan kas.xlsx');
            }
            $all = PemasukanKas::get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_masuk;
            }
            $pdf = FacadePdf::loadView('after-revisi.export.pemasukan', [
                'pemasukan' =>  PemasukanKas::orderBy("tanggal_masuk", 'ASC')->get(),
                'title' => 'pemasukan',
                'total' => $total,
                'type' => 'pdf',
                'dari' => PemasukanKas::orderBy('tanggal_masuk', 'ASC')->first()->tanggal_masuk,
                'sampai' => PemasukanKas::orderBy('tanggal_masuk', 'DESC')->first()->tanggal_masuk,
            ]);
            return $pdf->download('pemasukan kas.pdf');
        }
    }

    public function create()
    {
        return view('after-revisi.pemasukan-kas.create', [
            'title' => 'pemasukan-kas',
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'tanggal_masuk' => 'required',
            'uang_masuk' => 'required',
            'deskripsi' => 'required',
            'keterangan' => 'required',
        ]);

        $purchasePrice = preg_replace('/[^0-9]/', '', $request->uang_masuk);
        PemasukanKas::create([
            "keterangan" => $validasi["keterangan"],
            "deskripsi" => $validasi["deskripsi"],
            "tanggal_masuk" => $validasi["tanggal_masuk"],
            "uang_masuk" => $purchasePrice,
        ]);


        return redirect()->back()->with("success", "created pemasukan kas successfuly");
    }

    public function show($id)
    {

        $pemasukan = PemasukanKas::where('id', $id)->first();
        if ($pemasukan == null) {
            abort(404);
        }

        return view('after-revisi.pemasukan-kas.update', [
            'title' => 'pemasukan-kas',
            'pemasukan' => $pemasukan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'tanggal_masuk' => 'required',
            'uang_masuk' => 'required',
            'deskripsi' => 'required',
            'keterangan' => 'required',
        ]);

        $purchasePrice = preg_replace('/[^0-9]/', '', $request->uang_masuk);
        PemasukanKas::where('id', $id)->update([
            "keterangan" => $validasi["keterangan"],
            "tanggal_masuk" => $validasi["tanggal_masuk"],
            "deskripsi" => $validasi["deskripsi"],
            "uang_masuk" => $purchasePrice,
        ]);


        return redirect()->back()->with("success", "updated pemasukan kas successfuly");
    }

    public function delete($id)
    {
        $pemasukan = PemasukanKas::where('id', $id)->first();
        if ($pemasukan == null) {
            abort(404);
        }
        $pemasukan->delete();

        return redirect()->back()->with("success", "delete pemasukan kas successfuly");
    }
}
