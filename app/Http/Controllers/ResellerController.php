<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResellerRequest;
use App\Models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ResellerController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->query('search');

        $resellerSearch = Reseller::where('name', 'LIKE', '%' . $search . '%')->get();

        $resellers = Reseller::latest()->get();

        return view('dashboard.reseller.index', compact('resellers', 'resellerSearch'));
    }

    public function store(StoreResellerRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('qris_image')) {
            $file = $request->file('qris_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/qris'), $filename);
            $data['qris_image'] = $filename;
        } 

        Reseller::create($data);

        toast('Reseller Berhasil Ditambahkan!', 'success');
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $id = Reseller::find($id);
       if ($id->image) {
            Storage::disk('public')->delete('uploads/qris/' . $id->image);
        }

        $id->delete();

        toast('Reseller Berhasil Dihapus!', 'success');
        return redirect()->back();
    }
}


    
