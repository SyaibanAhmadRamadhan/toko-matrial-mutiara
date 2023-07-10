<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.index', [
            'title' => 'supplier',
            "suppliers" => Supplier::all()
        ]);
    }

    public function create()
    {
        return view('supplier.create', [
            'title' => 'supplier'
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|max:100|unique:suppliers,name',
            "email" => "required",
            "phone" => "required",
            "address" => "required",
        ]);

        Supplier::create([
            "name" => $validasi["name"],
            "email" => $validasi["email"],
            "phone" => $validasi["phone"],
            "address" => $validasi["address"],
        ]);

        return redirect()->back()->with("success", "created supplier successfuly");
    }

    public function show($id)
    {

        $supplier = Supplier::where('id', $id)->first();
        if ($supplier == null) {
            abort(404);
        }
        return view('supplier.update', [
            'title' => 'supplier',
            "supplier" => $supplier
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'name' => 'required|max:100|unique:suppliers,name,' . $id,
            "email" => "required",
            "phone" => "required",
            "address" => "required",
        ]);

        Supplier::where('id', $id)->update([
            "name" => $validasi["name"],
            "email" => $validasi["email"],
            "phone" => $validasi["phone"],
            "address" => $validasi["address"],
        ]);

        return redirect()->back()->with("success", "update supplier successfuly");
    }

    public function delete($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        if ($supplier == null) {
            abort(404);
        }
        $supplier->delete();

        return redirect()->back()->with("success", "delete supplier successfuly");
    }
}
