@extends('layouts.main')
@section('title', 'Detail Tagihan')
@section('subtitle', 'Pastikan informasi tagihan dengan benar')


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
            <a href="{{ url('dashboard/bills') }}">
                <button
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </button>
            </a>

            <form action="/dashboard/bills/{{ $billDetail->id }}" method="post">
                @csrf
                @method('DELETE')
                <button
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 dark:bg-red-500 border border-transparent rounded-lg hover:bg-red-700 dark:hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                    <i class="fas fa-trash mr-2"></i>Hapus Pesanan
                </button>
            </form>
        </div>

        <!-- Produk List -->
        <div class="flex justify-center items-center mb-6">
            <div
                class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">

                <!-- Gambar Bukti Pembayaran -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('uploads/qris/' . $billDetail->reseller->qris_image) }}"
                        class="w-full h-auto max-h-[500px] object-contain rounded-lg border" alt="Bukti Pembayaran">
                </div>

                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Detail Pembayaran</h2>

                <div class="space-y-4">
                    @foreach ($billDetail->sale as $sale)
                        @foreach ($sale->saleItems as $item)
                            <div class="flex items-center gap-4 border-b border-gray-200 dark:border-gray-600 pb-4">
                                <img src="{{ asset('/uploads/products/' . $item->product->image) }}" alt="Produk"
                                    class="w-20 h-20 object-cover rounded-md">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $item->product->name }}</p>
                                    <p class="text-xs text-gray-900 dark:text-white">RP.
                                        {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-900 dark:text-white">Jumlah: <span
                                            class="font-medium">{{ $item->quantity }}</span></p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <div class="grid grid-cols-1 mt-5 md:grid-cols-2 gap-6">
                    <!-- Nama Reseller -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Reseller</label>
                        <p class="text-gray-900 dark:text-white">
                            {{ $billDetail->reseller->name ?? '-' }}
                        </p>
                    </div>

                    <!-- Tanggal Pembayaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal
                            Tagihan</label>
                        <p class="text-gray-900 dark:text-white">
                            {{ $billDetail->created_at->format('d M Y') }}</p>
                        </p>
                    </div>

                    <!-- Jumlah Tagihan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah
                            Tagihan</label>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            Rp {{ number_format($billDetail->total_amount, '0', ',', '.') }}
                        </p>
                    </div>

                    <!-- Jumlah Terbayar -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah Terbayar</label>
                        <p class="text-gray-900 dark:text-white">
                            RP. {{ number_format( $billDetail->amount_paid, '0', ',', '.') ?? 0 }}
                        </p>
                    </div>
                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status
                            Tagihan</label>
                        <p>
                            <span
                                class="inline-flex px-2 py-1 text-xs font-medium {{ $billDetail->status == 'Belum Bayar' ? 'text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-900/50' : 'text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50' }} rounded-full">
                                {{ $billDetail->status }}
                            </span>
                        </p>
                    </div>

                    <!-- Catatan Pembayaran -->

                </div>
            </div>
        </div>
    </div>


@endsection
