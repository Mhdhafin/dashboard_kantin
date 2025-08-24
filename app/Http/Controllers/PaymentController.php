<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Generator\StringManipulation\Pass\Pass;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->query('search');
        $paymentSearch = Payment::whereHas('reseller', function($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();

        

        $payment_paid = Payment::sum('amount');
        $payments = Payment::with('bill.reseller')->latest()->get();
        $paymentCount = $payments->count();
        return view('dashboard.payment.index', compact('payments', 'payment_paid', 'paymentCount',  'paymentSearch'));
    }


     public function show($id)
    {
      $paymentDetail = Payment::with('saleItems')->find($id);
        
        return view('dashboard.payment.detail', compact('paymentDetail'));
    }


    public function store(StorePaymentRequest $request)
{
    $data = $request->validated();

    $bill = Bill::findOrFail($data['bill_id']); // gunakan array, bukan object
   

    // Upload file bukti pembayaran
    if ($request->hasFile('payment_proof')) {
        $file = $request->file('payment_proof');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/payments'), $filename);
        $data['payment_proof'] = $filename;
    }
     if ($data['amount'] == $bill->total_amount) {

     // Buat payment
    Payment::create($data);

    // Hitung ulang total amount paid
    $totalPaid = $data['amount'] + $bill->amount_paid;

    $bill->amount_paid = $totalPaid;

    // Update status sesuai jumlah yang sudah dibayar
    if ($totalPaid >= $bill->total_amount) {
        $bill->status = 'Lunas';
    } else {
        $bill->status = 'Belum Bayar';
    }

    $bill->save();
    toast('Pembayaran Berhasil Ditambahkan!', 'success');

    return redirect()->route('payments.index');
    }

   Alert::error('Jumlah Pembayaran Tidak Sesuai', 'Gagal Menambahkan Pembayaran');
    return redirect()->back();

   
}


    // public function update(StorePaymentRequest $request, $id) {

    //     $consignment = $request->only('amount');

    //     Payment::find($id)->update($consignment);

    //     toast('Consignment Berhasil!', 'success');
    //     return redirect()->route('payments.index');

    // }



    public function destroy(string $id)
    {
        $id = Payment::findOrFail($id);

        if ($id->payment_proof) {
            Storage::disk('public')->delete('uploads/payments/' . $id->payment_proof);
        }

        $id->delete();

        toast('Pembayaran Berhasil Dihapus!', 'success');
        return redirect()->route('payments.index');
    }
}
