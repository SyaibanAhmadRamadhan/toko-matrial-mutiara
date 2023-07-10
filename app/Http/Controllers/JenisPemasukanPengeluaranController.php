<?php

namespace App\Http\Controllers;

use App\Models\JenisPemasukanPengeluaranKas;
use Illuminate\Http\Request;

class JenisPemasukanPengeluaranController extends Controller
{
    public function index()
    {
        return view('after-revisi.jenis-pemasukan-pengeluaran-kas.index', [
            'title' => 'jenis-pemasukan-pengeluaran-kas',
            "jenisPemasukanPengeluaranKas" => JenisPemasukanPengeluaranKas::all()
        ]);
    }

    public function create()
    {
        return view('after-revisi.jenis-pemasukan-pengeluaran-kas.create', [
            'title' => 'jenis-pemasukan-pengeluaran-kas'
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|max:100|unique:jenis_pemasukan_pengeluaran_kas,name',
            "status" => "required",
        ]);

        JenisPemasukanPengeluaranKas::create([
            "name" => $validasi["name"],
            "jenis" => $validasi["status"],
        ]);

        return redirect()->back()->with("success", "created jenis pemasukan pengeluaran kas category successfuly");
    }

    public function show($id)
    {

        $jenisPemasukanPengeluaranKas = JenisPemasukanPengeluaranKas::where('id', $id)->first();
        if ($jenisPemasukanPengeluaranKas == null) {
            abort(404);
        }
        return view('after-revisi.jenis-pemasukan-pengeluaran-kas.update', [
            'title' => 'jenis-pemasukan-pengeluaran-kas',
            "jenisPemasukanPengeluaranKas" => $jenisPemasukanPengeluaranKas
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'name' => 'required|max:100|unique:jenis_pemasukan_pengeluaran_kas,name,' . $id,
            "status" => "required",
        ]);

        JenisPemasukanPengeluaranKas::where('id', $id)->update([
            "name" => $validasi["name"],
            "jenis" => $validasi["status"],
        ]);

        return redirect()->back()->with("success", "update jenis pemasukan pengeluaran kas category successfuly");
    }

    public function delete($id)
    {
        $jenisPemasukanPengeluaranKas = JenisPemasukanPengeluaranKas::where('id', $id)->first();
        if ($jenisPemasukanPengeluaranKas == null) {
            abort(404);
        }
        $jenisPemasukanPengeluaranKas->delete();

        return redirect()->back()->with("success", "delete jenis pemasukan pengeluaran kas category successfuly");
    }
}
