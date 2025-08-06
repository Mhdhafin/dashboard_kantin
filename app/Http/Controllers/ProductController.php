<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Reseller;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $resellers = Reseller::all();
        $products = Product::latest()->get();
        $search = $request->query('search');

        
        $productSearch = Product::where('name', 'like', '%' . $search . '%')->get();
        
        
        return view('dashboard.product.index', compact('products', 'resellers', 'productSearch'));
    }



    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $data['image'] = $filename;
        }

        Product::create($data);

        toast('Produk Berhasil Ditambahkan!', 'success');
        return redirect()->back();
    }

    public function update(StoreProductRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $data['image'] = $filename;
        }

        Product::find($id)->update($data);

        toast('Berhasil Mengubah Produk!', 'success');

        return redirect()->back();
    }

    public function show($id)
    {
        $productDetail = Product::find($id);

        return view('dashboard.product.detail', compact('productDetail'));
    }


    public function destroy(string $id)
    {
        $id = Product::find($id);

        if ($id->image) {
            Storage::disk('public')->delete('uploads/products/' . $id->image);
        }

        $id->delete();

        toast('Berhasil Menghapus Produk!', 'success');
        return redirect()->route('products.index');
    }
}
