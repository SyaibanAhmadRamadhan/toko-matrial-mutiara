<?php

namespace App\Http\Controllers;

use App\Exports\ExportPengeluaranKas;
use App\Models\PengeluaranKas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{
    public function index()
    {
        if (isset($_GET['dari'])  && isset($_GET['sampai'])) {
            return view('after-revisi.pengeluaran-kas.index', [
                'title' => 'pemasukan-kas',
                'pengeluaran' => PengeluaranKas::where("tanggal_keluar", ">=", $_GET['dari'])->where("tanggal_keluar", "<=", $_GET['sampai'])->get()
            ]);
        }

        return view('after-revisi.pengeluaran-kas.index', [
            'title' => 'pengeluaran-kas',
            'pengeluaran' => PengeluaranKas::all()
        ]);
    }

    public function export($type)
    {


        if ($_GET['dari'] != "" && $_GET['sampai'] != "") {
            if ($type == "excel") {
                return Excel::download(new ExportPengeluaranKas($_GET['dari'], $_GET['sampai']), 'pemasukan kas.xlsx');
            }
            $all = PengeluaranKas::where("tanggal_keluar", ">=", $_GET['dari'])->where("tanggal_keluar", "<=", $_GET['sampai'])->get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_keluar;
            }
            $pdf = FacadePdf::loadView('after-revisi.export.pengeluaran', [
                'pengeluaran' =>  PengeluaranKas::where("tanggal_keluar", ">=", $_GET['dari'])->where("tanggal_keluar", "<=", $_GET['sampai'])->orderBy('tanggal_keluar', 'ASC')->get(),
                'title' => 'pengeluaran',
                'total' => $total,
                'type' => 'pdf',
                'dari' => $_GET['dari'],
                'sampai' => $_GET['sampai'],
            ]);
            return $pdf->download('pengeluaran kas.pdf');
        } else {
            if ($type == "excel") {
                return Excel::download(new ExportPengeluaranKas("", ""), 'pengeluaran kas.xlsx');
            }
            $all = PengeluaranKas::get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_keluar;
            }
            $pdf = FacadePdf::loadView('after-revisi.export.pengeluaran', [
                'pengeluaran' =>  PengeluaranKas::orderBy("tanggal_keluar", 'ASC')->get(),
                'title' => 'pengeluaran',
                'total' => $total,
                'type' => 'pdf',
                'dari' => PengeluaranKas::orderBy('tanggal_keluar', 'ASC')->first()->tanggal_keluar,
                'sampai' => PengeluaranKas::orderBy('tanggal_keluar', 'DESC')->first()->tanggal_keluar,

            ]);
            return $pdf->download('pengeluaran kas.pdf');
        }
    }

    public function create()
    {
        return view('after-revisi.pengeluaran-kas.create', [
            'title' => 'pengeluaran-kas',
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'uang_keluar' => 'required',
            'tanggal_keluar' => 'required',
            'deskripsi' => 'required',
            'keterangan' => 'required',
        ]);

        $purchasePrice = preg_replace('/[^0-9]/', '', $request->uang_keluar);
        PengeluaranKas::create([
            "keterangan" => $validasi["keterangan"],
            "deskripsi" => $validasi["deskripsi"],
            "tanggal_keluar" => $validasi["tanggal_keluar"],
            "uang_keluar" => $purchasePrice,
        ]);


        return redirect()->back()->with("success", "created pengeluaran kas successfuly");
    }

    public function show($id)
    {

        $pengeluaran = PengeluaranKas::where('id', $id)->first();
        if ($pengeluaran == null) {
            abort(404);
        }

        return view('after-revisi.pengeluaran-kas.update', [
            'title' => 'pengeluaran-kas',
            'pengeluaran' => $pengeluaran,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'tanggal_keluar' => 'required',
            'uang_keluar' => 'required',
            'deskripsi' => 'required',
            'keterangan' => 'required',
        ]);

        $purchasePrice = preg_replace('/[^0-9]/', '', $request->uang_keluar);
        PengeluaranKas::where('id', $id)->update([
            "keterangan" => $validasi["keterangan"],
            "deskripsi" => $validasi["deskripsi"],
            "tanggal_keluar" => $validasi["tanggal_keluar"],
            "uang_keluar" => $purchasePrice,
        ]);


        return redirect()->back()->with("success", "updated pengeluaran kas successfuly");
    }

    public function delete($id)
    {
        $pemasukan = PengeluaranKas::where('id', $id)->first();
        if ($pemasukan == null) {
            abort(404);
        }
        $pemasukan->delete();

        return redirect()->back()->with("success", "delete pengeluaran kas successfuly");
    }
}
