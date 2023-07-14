<?php

namespace App\Http\Controllers;

use App\Exports\KasbonExport;
use App\Models\Kasbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class KasbonController extends Controller
{
    public function index()
    {
        if (isset($_GET['dari'])  && isset($_GET['sampai'])) {
            return view('after-revisi.kasbon.index', [
                'title' => 'kasbon',
                'kasbon' => Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->get()
            ]);
        }
        // dd(phpinfo());
        return view('after-revisi.kasbon.index', [
            'title' => 'kasbon',
            'kasbon' => Kasbon::orderBy("tanggal_kasbon", 'desc')->get()
        ]);
    }

    public function export($type)
    {
        if ($_GET['dari'] != "" && $_GET['sampai'] != "") {
            if ($type == "excel") {
                return Excel::download(new KasbonExport($_GET['dari'], $_GET['sampai']), 'kasbon kas.xlsx');
            }
            $all = Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_kasbon;
            }
            $pdf = FacadePdf::loadView('after-revisi.export.kasbon', [
                'kasbon' =>  Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->orderBy('tanggal_kasbon', 'ASC')->get(),
                'title' => 'kasbon',
                'type' => 'pdf',
                'total' => $total,
                'dari' => $_GET['dari'],
                'sampai' => $_GET['sampai'],
            ]);
            return $pdf->download('kasbon kas.pdf');
        } else {
            if ($type == "excel") {
                return Excel::download(new KasbonExport("", ""), 'kasbon kas.xlsx');
            }
            $all = Kasbon::get();
            $total = 0;
            foreach ($all as $key => $x) {
                $total += $x->uang_kasbon;
            }
            $pdf = FacadePdf::loadView('after-revisi.export.kasbon', [
                'kasbon' =>  Kasbon::orderBy("tanggal_kasbon", 'ASC')->get(),
                'title' => 'kasbon',
                'total' => $total,
                'type' => 'pdf',
                'dari' => Kasbon::orderBy('tanggal_kasbon', 'ASC')->first()->tanggal_kasbon,
                'sampai' => Kasbon::orderBy('tanggal_kasbon', 'DESC')->first()->tanggal_kasbon,
            ]);
            // dd('kot');
            return $pdf->download('kasbon kas.pdf');
        }
    }

    public function create()
    {
        return view('after-revisi.kasbon.create', [
            'title' => 'kasbon',
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'tanggal_kasbon' => 'required',
            'uang_kasbon' => 'required',
            'nama' => 'required',
            'no_telepon' => 'required',
            'keterangan' => 'required',
        ]);

        $kasbonPrice = preg_replace('/[^0-9]/', '', $request->uang_kasbon);
        Kasbon::create([
            "tanggal_kasbon" => $validasi["tanggal_kasbon"],
            "uang_kasbon" => $kasbonPrice,
            "nama" => $validasi["nama"],
            "no_telepon" => $validasi["no_telepon"],
            "keterangan" => $validasi["keterangan"],
        ]);


        return redirect()->back()->with("success", "created kasbon successfuly");
    }

    public function show($id)
    {

        $kasbon = Kasbon::where('id', $id)->first();
        if ($kasbon == null) {
            abort(404);
        }

        return view('after-revisi.kasbon.update', [
            'title' => 'kasbon',
            'kasbon' => $kasbon,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'tanggal_kasbon' => 'required',
            'uang_kasbon' => 'required',
            'nama' => 'required',
            'no_telepon' => 'required',
            'keterangan' => 'required',
        ]);

        $kasbonPrice = preg_replace('/[^0-9]/', '', $request->uang_kasbon);
        Kasbon::where('id', $id)->update([
            "tanggal_kasbon" => $validasi["tanggal_kasbon"],
            "uang_kasbon" => $kasbonPrice,
            "nama" => $validasi["nama"],
            "no_telepon" => $validasi["no_telepon"],
            "keterangan" => $validasi["keterangan"],
        ]);


        return redirect()->back()->with("success", "updated kasbon successfuly");
    }

    public function delete($id)
    {
        $kasbon = Kasbon::where('id', $id)->first();
        if ($kasbon == null) {
            abort(404);
        }
        $kasbon->delete();

        return redirect()->back()->with("success", "delete kasbon successfuly");
    }
}
