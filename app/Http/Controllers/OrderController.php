<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Bill;
use App\Models\Product;
use App\Models\Reseller;
use App\Models\Sale;
use App\Models\Sale_item;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        $resellers = Reseller::all();
        $orders = Sale::with(['reseller', 'saleItems.product'])
            ->latest()
            ->get();
        $search = $request->query('search');
        $orderSearch = Sale::whereHas('reseller', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();
        return view('dashboard.order.index', compact('resellers', 'products', 'orders', 'orderSearch'));
    }

    public function show($id)
    {
        $orderDetail = Sale::with(['reseller', 'saleItems.product'])->find($id);

        return view('dashboard.order.detail', compact('orderDetail'));
    }

    public function store(StoreOrderRequest $request)
    {
        $request->validated();

        $reseller = Reseller::findOrFail($request['reseller_id']);
        $orderDate = Carbon::parse($request['order_date']);
        $total = 0;

        // Validasi stok & kepemilikan produk
        foreach ($request['items'] as $item) {
            $product = Product::find($item['product_id']);

            if (!$product || $product->reseller_id !== $reseller->id || $product->stock < $item['quantity']) {
                Alert::error('Gagal Membuat Pesanan', 'Produk tidak tersedia pada vendor ' . $reseller->name . ' atau stok tidak mencukupi.');
                return back();
            }
        }

        // Buat atau cari tagihan
        $bill = Bill::firstOrCreate(
            [
                'reseller_id' => $reseller->id,
                'status' => 'Belum Bayar',
            ],
            [
                'id' => Str::uuid(),
                'total_amount' => 0,
                'amount_paid' => 0,
                'total_quantity' => 0,
            ],
        );

        // Cari atau buat order berdasarkan reseller, tanggal, dan bill
        $order = Sale::firstOrCreate(
            [
                'reseller_id' => $reseller->id,
                'bill_id' => $bill->id,
                'order_date' => $orderDate,
            ],
            [
                'id' => Str::uuid(),
                'total_amount' => 0,
            ],
        );

        // Tambahkan item ke dalam order
        foreach ($request['items'] as $item) {
            $product = Product::where('id', $item['product_id'])->where('reseller_id', $reseller->id)->firstOrFail();

            $quantity = $item['quantity'];
            $price = $product->price;
            $subtotal = $price * $quantity;

            $existingItem = Sale_item::where('sale_id', $order->id)->where('product_id', $product->id)->first();

            if ($existingItem) {
                $existingItem->quantity += $quantity;
                $existingItem->subtotal += $subtotal;
                $existingItem->save();
            } else {
                $order->saleItems()->create([
                    'id' => Str::uuid(),
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
            }

            // Kurangi stok produk
            $product->stock -= $quantity;
            $product->save();

            $total += $subtotal;
        }

        // Update total amount pada order dan bill
        $order->update([
            'total_amount' => $order->total_amount + $total,
        ]);

        $bill->update([
            'total_amount' => $bill->total_amount + $total,
            'total_quantity' => $bill->total_quantity + array_sum(array_column($request['items'], 'quantity')),
        ]);

        // Kirim pesan ke reseller via WhatsApp
        $message = "📦 *Order Baru dari Admin Kantin*   \n";
        $message .= "👤 *Nama Reseller:* {$reseller->name}\n";
        $message .= '📅 *Tanggal:* ' . $orderDate->format('d-m-Y') . "\n\n";
        $message .= "🛒 *Pesanan:*\n";

        foreach ($order->saleItems as $item) {
            $message .= "- {$item->product->name} : Rp" . number_format($item->price) . " x {$item->quantity} = Rp" . number_format($item->quantity * $item->price) . "\n";
        }

        $message .= "\n💰 *Total:* Rp" . number_format($order->total_amount, 0, ',', '.') . "\n";
        $message .= "\n🙏 *Silakan siapkan barangnya ya!*";

        $text = rawurlencode($message);
        $nomorTujuan = '62' . ltrim($reseller->phone, '0');

        return redirect("https://wa.me/{$nomorTujuan}?text={$text}");
    }

    public function destroy(string $id)
    {
        $id = Sale::find($id);

        $id->delete();

        toast('Pesanan Berhasil Dihapus!', 'success');
        return redirect()->route('orders.index');
    }
}
