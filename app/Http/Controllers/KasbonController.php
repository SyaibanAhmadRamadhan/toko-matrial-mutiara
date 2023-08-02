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
        $total = 0;
        if (isset($_GET['dari'])  && isset($_GET['sampai']) && isset($_GET['status'])) {
            if ($_GET['status'] == "semua") {
                $kasbon =
                    Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->orderBy('status', 'ASC')->orderBy("tanggal_kasbon", 'ASC')->get();
            } else {
                $kasbon =
                    Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->where('status', $_GET['status'])->orderBy('status', 'ASC')->orderBy("tanggal_kasbon", 'ASC')->get();
            }
            foreach ($kasbon as $key => $x) {
                $total = $total + $x->uang_kasbon;
            }
            return view('after-revisi.kasbon.index', [
                'title' => 'kasbon',
                'kasbon' => $kasbon,
                'total' => $total
            ]);
        }

        $kasbon = Kasbon::orderBy('status', 'ASC')->orderBy("tanggal_kasbon", 'ASC')->get();
        foreach ($kasbon as $key => $x) {
            $total = $total + $x->uang_kasbon;
        }
        return view('after-revisi.kasbon.index', [
            'title' => 'kasbon',
            'kasbon' => $kasbon,
            'total' => $total
        ]);
    }

    public function export($type, $filter)
    {
        if ($_GET['dari'] != "" && $_GET['sampai'] != "") {
            if ($type == "excel") {
                return Excel::download(new KasbonExport($_GET['dari'], $_GET['sampai'], $filter), 'kasbon kas.xlsx');
            }
            if ($filter == "semua") {
                $all = Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->get();
                $total = 0;
                foreach ($all as $key => $x) {
                    $total += $x->uang_kasbon;
                }
                $pdf = FacadePdf::loadView('after-revisi.export.kasbon', [
                    'kasbon' =>  Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->orderBy('status', 'ASC')->orderBy('tanggal_kasbon', 'ASC')->get(),
                    'title' => 'kasbon',
                    'type' => 'pdf',
                    'total' => $total,
                    'dari' => $_GET['dari'],
                    'sampai' => $_GET['sampai'],
                    'filter' => $filter
                ]);
            } else {
                $all = Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->where('status', $filter)->get();
                $total = 0;
                foreach ($all as $key => $x) {
                    $total += $x->uang_kasbon;
                }
                $pdf = FacadePdf::loadView('after-revisi.export.kasbon', [
                    'kasbon' =>  Kasbon::where("tanggal_kasbon", ">=", $_GET['dari'])->where("tanggal_kasbon", "<=", $_GET['sampai'])->where('status', $filter)->orderBy('tanggal_kasbon', 'ASC')->get(),
                    'title' => 'kasbon',
                    'type' => 'pdf',
                    'total' => $total,
                    'dari' => $_GET['dari'],
                    'sampai' => $_GET['sampai'],
                    'filter' => $filter
                ]);
            }
            return $pdf->download('kasbon kas.pdf');
        } else {
            if ($type == "excel") {
                return Excel::download(new KasbonExport("", "", $filter), 'kasbon kas.xlsx');
            }
            if ($filter == "semua") {
                $all = Kasbon::get();
                $total = 0;
                foreach ($all as $key => $x) {
                    $total += $x->uang_kasbon;
                }
                $pdf = FacadePdf::loadView('after-revisi.export.kasbon', [
                    'kasbon' =>  Kasbon::orderBy('status', 'ASC')->orderBy("tanggal_kasbon", 'ASC')->get(),
                    'title' => 'kasbon',
                    'total' => $total,
                    'type' => 'pdf',
                    'dari' => Kasbon::orderBy('tanggal_kasbon', 'ASC')->first()->tanggal_kasbon,
                    'sampai' => Kasbon::orderBy('tanggal_kasbon', 'DESC')->first()->tanggal_kasbon,
                    'filter' => $filter
                ]);
            } else {
                $all = Kasbon::where('status', $filter)->get();
                $total = 0;
                foreach ($all as $key => $x) {
                    $total += $x->uang_kasbon;
                }
                $pdf = FacadePdf::loadView('after-revisi.export.kasbon', [
                    'kasbon' =>  Kasbon::where('status', $filter)->orderBy('status', 'ASC')->orderBy("tanggal_kasbon", 'ASC')->get(),
                    'title' => 'kasbon',
                    'total' => $total,
                    'type' => 'pdf',
                    'dari' => Kasbon::where("status", $filter)->orderBy('tanggal_kasbon', 'ASC')->first()->tanggal_kasbon,
                    'sampai' => Kasbon::where("status", $filter)->orderBy('tanggal_kasbon', 'DESC')->first()->tanggal_kasbon,
                    'filter' => $filter
                ]);
            }
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
            'status' => 'required',
            'nama' => 'required',
            'no_telepon' => 'required',
            'keterangan' => 'required',
        ]);

        $kasbonPrice = preg_replace('/[^0-9]/', '', $request->uang_kasbon);
        Kasbon::create([
            "tanggal_kasbon" => $validasi["tanggal_kasbon"],
            "uang_kasbon" => $kasbonPrice,
            "nama" => $validasi["nama"],
            "status" => $validasi["status"],
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
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        $kasbonPrice = preg_replace('/[^0-9]/', '', $request->uang_kasbon);
        Kasbon::where('id', $id)->update([
            "tanggal_kasbon" => $validasi["tanggal_kasbon"],
            "uang_kasbon" => $kasbonPrice,
            "nama" => $validasi["nama"],
            "status" => $validasi["status"],
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
