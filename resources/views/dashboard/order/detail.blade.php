@extends('layouts.main')
@section('title', 'Detail Produk')
@section('subtitle', 'Pastikan informasi produk dengan benar')


@section('content')

    {{-- <div class="mb-8">
    

     <!-- Status Badge -->
     <div class="flex items-center space-x-4">
         <span
             class="inline-flex px-3 py-1 text-sm font-medium text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50 rounded-full">
             <i class="fas fa-check-circle mr-2"></i>
             Aktif
         </span>
         <span
             class="inline-flex px-3 py-1 text-sm font-medium text-orange-800 bg-orange-100 dark:text-orange-200 dark:bg-orange-900/50 rounded-full">
             <i class="fas fa-utensils mr-2"></i>
             Makanan Utama
         </span>
     </div>
 </div> --}}

    <!-- Product Detail Content -->
    <div class="w-full h-full mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-6 flex gap-3 mb-4">
        <a href="{{ url('dashboard/orders') }}">
            <button
                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </button>
        </a>

        <form action="/dashboard/orders/{{ $orderDetail->id }}" method="post">
            @csrf
            @method('DELETE')
            <button
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 dark:bg-red-500 border border-transparent rounded-lg hover:bg-red-700 dark:hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                <i class="fas fa-trash mr-2"></i>Hapus Pesanan
            </button>
        </form>
    </div>

    <!-- Produk List -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Detail Produk Dipesan</h2>

        <!-- Item List -->
        <div class="space-y-4">
            @foreach($orderDetail->saleItems as $item)
                <div class="flex items-center gap-4 border-b border-gray-200 dark:border-gray-600 pb-4">
                    <img src="{{ asset('/uploads/products/' . $item->product->image) }}" alt="Produk" class="w-20 h-20 object-cover rounded-md">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</p>
                        <p class="text-xs  text-gray-900 dark:text-white">RP. {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Reseller: {{ $item->product->reseller->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-900 dark:text-white">Jumlah: <span class="font-medium">{{ $item->quantity }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total dan Tanggal -->
        <div class="mt-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Order:</p>
                <p class="text-md font-semibold text-gray-900 dark:text-white">{{ $orderDetail->created_at->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total:</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($orderDetail->total, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>


@endsection
