<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'title' => 'product',
            'products' => Product::all()
        ]);
    }

    public function create()
    {
        return view('product.create', [
            'title' => 'product',
            "categoryProducts" => CategoryProduct::all(),
            "suppliers" => Supplier::all()
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'supplier' => 'required',
            'category_product' => 'required',
            'name' => 'required|unique:products,name',
            'selling_price' => 'required',
            // 'stock_product' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sellingPriceInt = preg_replace('/[^0-9]/', '', $request->selling_price);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        Product::create([
            "supplier_id" => $validasi["supplier"],
            "product_category_id" => $validasi["category_product"],
            "name" => $validasi["name"],
            "selling_price" => $sellingPriceInt,
            "stock_product" => 0,
            "image" => $imageName,
        ]);

        return redirect()->back()->with("success", "created Product successfuly");
    }

    public function show($id)
    {

        $product = Product::where('id', $id)->first();
        if ($product == null) {
            abort(404);
        }
        return view('product.update', [
            'title' => 'product',
            'product' => $product,
            "categoryProducts" => CategoryProduct::all(),
            "suppliers" => Supplier::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'supplier' => 'required',
            'category_product' => 'required',
            'name' => 'required|unique:products,name,' . $id,
            'selling_price' => 'required',
            // 'stock_product' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $product = Product::where('id', $id)->first();
        $sellingPriceInt = preg_replace('/[^0-9]/', '', $request->selling_price);
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            Product::where('id', $id)->update([
                "supplier_id" => $validasi["supplier"],
                "product_category_id" => $validasi["category_product"],
                "name" => $validasi["name"],
                "selling_price" => $sellingPriceInt,
                "image" => $imageName,
            ]);
            unlink("images/" . $product->image);
        } else {
            Product::where('id', $id)->update([
                "supplier_id" => $validasi["supplier"],
                "product_category_id" => $validasi["category_product"],
                "name" => $validasi["name"],
                "selling_price" => $sellingPriceInt,
            ]);
        }


        return redirect()->back()->with("success", "updated product successfuly");
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product == null) {
            abort(404);
        }
        unlink("images/" . $product->image);
        $product->delete();

        return redirect()->back()->with("success", "delete product successfuly");
    }
}
