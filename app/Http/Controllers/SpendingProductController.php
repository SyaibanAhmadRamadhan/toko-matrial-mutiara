<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\SpendingProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SpendingProductController extends Controller
{
    public function index()
    {
        return view('pembelian-product.index', [
            'title' => 'product',
            'spendingProducts' => SpendingProduct::all()
        ]);
    }

    public function create()
    {
        return view('pembelian-product.create', [
            'title' => 'pembelian-product',
            "products" => Product::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'product' => 'required',
            'purchase_total' => 'required',
            'purchase_price' => 'required',
            'status' => 'required',
        ]);

        $purchasePrice = preg_replace('/[^0-9]/', '', $request->purchase_price);
        SpendingProduct::create([
            "id_product" => $validasi["product"],
            "purchase_total" => $validasi["purchase_total"],
            "status" => $validasi["status"],
            "purchase_price" => $purchasePrice,
            "total_spending_money" => $purchasePrice * $validasi["purchase_total"],
        ]);

        if ($request->status == 'paid') {
            $product = Product::where('id', $validasi['product'])->first();
            Product::where('id', $validasi['product'])->update([
                'stock_product' => $product->stock_product + $validasi['purchase_total']
            ]);
        }

        return redirect()->back()->with("success", "created pembelian Product successfuly");
    }

    public function show($id)
    {

        $spendingProduct = SpendingProduct::where('id', $id)->first();
        if ($spendingProduct == null) {
            abort(404);
        }

        return view('pembelian-product.update', [
            'title' => 'pembelian-product',
            'spendingProduct' => $spendingProduct,
            "products" => Product::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'product' => 'required',
            'purchase_total' => 'required',
            'purchase_price' => 'required',
            'status' => 'required',
        ]);

        $purchasePrice = preg_replace('/[^0-9]/', '', $request->purchase_price);
        $spendingBeforeUpdate = SpendingProduct::where('id', $id)->first();
        SpendingProduct::where('id', $id)->update([
            "id_product" => $validasi["product"],
            "purchase_total" => $validasi["purchase_total"],
            "status" => $validasi["status"],
            "purchase_price" => $purchasePrice,
            "total_spending_money" => $purchasePrice * $validasi["purchase_total"],
        ]);

        if ($request->status == 'paid' && $spendingBeforeUpdate->status != 'paid') {
            // dd("if");
            $product = Product::where('id', $validasi['product'])->first();
            Product::where('id', $validasi['product'])->update([
                'stock_product' => $product->stock_product + $validasi['purchase_total']
            ]);
        } elseif ($request->status == 'unpaid' && $spendingBeforeUpdate->status == 'paid') {
            // dd("elif1");
            $product = Product::where('id', $validasi['product'])->first();
            Product::where('id', $validasi['product'])->update([
                'stock_product' => $product->stock_product - $validasi['purchase_total']
            ]);
        } elseif ($request->status == 'pending' && $spendingBeforeUpdate->status == 'paid') {
            // dd("elif2");
            $product = Product::where('id', $validasi['product'])->first();
            Product::where('id', $validasi['product'])->update([
                'stock_product' => $product->stock_product - $validasi['purchase_total']
            ]);
        }


        return redirect()->back()->with("success", "updated pembelian product successfuly");
    }

    public function delete($id)
    {
        $spendingProduct = SpendingProduct::where('id', $id)->first();
        if ($spendingProduct == null) {
            abort(404);
        }
        $product = Product::where('id', $spendingProduct->id_product)->first();
        Product::where('id', $product->id)->update([
            'stock_product' => $product->stock_product - $spendingProduct->purchase_total
        ]);
        $spendingProduct->delete();

        return redirect()->back()->with("success", "delete product successfuly");
    }
}
