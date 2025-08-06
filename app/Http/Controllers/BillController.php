<?php

namespace App\Http\Controllers;

use App\Models\Bill;


class BillController extends Controller
{
    public function index()
    {
        $billTrashed = Bill::onlyTrashed()->get();
        $bills = Bill::with(['sale.saleItems', 'reseller'])
            ->latest()
            ->get();
        return view('dashboard.bill.index', compact('bills', 'billTrashed'));
    }

    public function show($id)
    {
        $billDetail = Bill::with(['sale.saleItems.product', 'reseller.product'])
            ->withTrashed()
            ->find($id);
        return view('dashboard.bill.detail', compact('billDetail'));
    }


    public function destroy(string $id)
    {
        $bill = Bill::find($id);
        $bill->delete(); // soft delete (tidak hapus permanen)

        toast('Bill Berhasil Dihapus!', 'success');
        return redirect()->back();
    }
}
