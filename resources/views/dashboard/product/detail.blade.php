@extends('layouts.main')
@section('title', 'Detail Produk')
@section('subtitle', 'Pastikan informasi produk dengan benar')


@section('content')

 

    <!-- Product Detail Content -->
    <div class="w-full h-full mx-auto px-4 sm:px-6 lg:px-8">

        <div class="py-6 flex gap-3 mb-2">
            <button 
                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                >
               <a href="{{ url('dashboard/products') }}">
                 <i class="fas fa-arrow-left mr-2"></i>
                Kembali
               </a>
            </button>
            <form action="{{ route("products.destroy", $productDetail->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button 
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 dark:bg-red-500 border border-transparent rounded-lg hover:bg-red-700 dark:hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
            >
                <i class="fas fa-trash mr-2"></i>
                Hapus Produk
            </button>
            </form>
        </div>

        <div class="flex justify-center items-center mb-6">
            <!-- Basic Information -->
            <div
                class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
              
                       <div class="flex justify-center mb-6">
                    <img src="{{ asset('uploads/products/' . $productDetail->image) }}"
                        class="w-full h-auto max-h-[500px] object-contain rounded-lg border" alt="Bukti Pembayaran">
                </div>
                
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Produk</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Produk</label>
                        <p class="text-gray-900 dark:text-white">{{ $productDetail->name}}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                        <p class="text-gray-900 dark:text-white">{{ $productDetail->category }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reseller</label>
                        <p class="text-gray-900 dark:text-white">{{ $productDetail->reseller->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga</label>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($productDetail->price, '0', ',', '.') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stok
                            Tersedia</label>
                        <p class="text-gray-900 dark:text-white">{{ $productDetail->stock }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                         @if ($productDetail->stock > 0)
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50 rounded-full">Aktif</span>
                                @else
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-900/50 rounded-full">Tidak
                                        Aktif</span>
                                @endif
                    </div>
                </div>


            </div>



        </div>
    </div>

@endsection
