<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index()
    {
        return view('category-product.index', [
            'title' => 'category-product',
            "categoryProducts" => CategoryProduct::all()
        ]);
    }

    public function create()
    {
        return view('category-product.create', [
            'title' => 'category-product'
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|max:100|unique:product_categories,name',
            "description" => "required",
        ]);

        CategoryProduct::create([
            "name" => $validasi["name"],
            "description" => $validasi["description"],
        ]);

        return redirect()->back()->with("success", "created product category successfuly");
    }

    public function show($id)
    {

        $categoryProduct = CategoryProduct::where('id', $id)->first();
        if ($categoryProduct == null) {
            abort(404);
        }
        return view('category-product.update', [
            'title' => 'category-product',
            "categoryProduct" => $categoryProduct
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'name' => 'required|max:100|unique:product_categories,name,' . $id,
            "description" => "required",
        ]);

        CategoryProduct::where('id', $id)->update([
            "name" => $validasi["name"],
            "description" => $validasi["description"],
        ]);

        return redirect()->back()->with("success", "update product category successfuly");
    }

    public function delete($id)
    {
        $categoryProduct = CategoryProduct::where('id', $id)->first();
        if ($categoryProduct == null) {
            abort(404);
        }
        $categoryProduct->delete();

        return redirect()->back()->with("success", "delete product category successfuly");
    }
}
