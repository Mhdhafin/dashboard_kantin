<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\RestoreBillController;
use App\Http\Controllers\UserController;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Reseller;
use App\Models\Sale;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', function () {

        $topResellers = Reseller::whereHas('bill', function ($query) {
            $query->where('amount_paid', '>', 0);
        })
            ->with('bill')
            ->get();

        $resellers = Reseller::all();
        $products = Product::where('stock', '>', 0)->get();
        $orders = Sale::with(['reseller', 'saleItems.product'])
            ->latest()
            ->get();
        $payments = Payment::where('amount', '>', 0)->sum('amount');
        return view('dashboard.index', compact('resellers','topResellers', 'products', 'orders', 'payments'));
    })->name('dashboard.index');

    // Route::get('/dashboard/products/{id}/detail', [ProductController::class, 'show'])->name('product.detail');
    Route::resource('/dashboard/products', ProductController::class);
    Route::resource('/dashboard/resellers', ResellerController::class);
    Route::resource('/dashboard/orders', OrderController::class);
    Route::resource('/dashboard/bills', BillController::class);
    Route::resource('/dashboard/payments', PaymentController::class);

    // Restore satuan (per id)
    Route::put('/dashboard/restore/bills/{id}', [RestoreBillController::class, 'restore'])->name('bill.restore');
    // Restore semua
    Route::put('/dashboard/restore/bills', [RestoreBillController::class, 'restoreAll'])->name('bill.restore.all');

    Route::get('/export/payments', [ExportController::class, 'exportPayments'])->name('payments.export');
    Route::get('/export/orders', [ExportController::class, 'exportOrders'])->name('orders.export');
    Route::get('/export/bills', [ExportController::class, 'exportBills'])->name('bills.export');

    Route::resource('/dashboard/users', UserController::class);
});

// Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/logout/{id}', [AuthController::class, 'logout'])->name('logout');
