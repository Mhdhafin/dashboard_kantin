<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class RestoreBillController extends Controller
{
    
    public function restore($id)
    {
        $bill = Bill::onlyTrashed()->findOrFail($id);
        $bill->restore();

        toast('Tagihan berhasil dikembalikan!', 'success');
        return redirect()->back();
    }

    public function restoreAll()
    {
        Bill::onlyTrashed()->restore();

        FacadesAlert::success('Success', 'Semua Tagihan berhasil dikembalikan!');
        return redirect()->back();
    }
}
