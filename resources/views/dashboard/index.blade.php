@extends('layouts.main')
@section('title', 'Halaman Dashboard')
@section('subtitle', 'Lihat statistik dan list dari pengelolaan kantin')

@section('content')
    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Reseller -->
            <div class="bg-white  dark:border-gray-700 dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium dark:text-gray-400 text-gray-600">Total Reseller</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ count($resellers) }}</p>
                        <p class="text-xs text-green-600 mt-1">
                            <i class="fas fa-arrow-up"></i> +12% dari bulan lalu
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Produk Aktif -->
            <div class="bg-white  dark:border-gray-700 dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium dark:text-gray-400 text-gray-600">Produk Aktif</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ count($products) }}</p>
                        <p class="text-xs text-green-600 mt-1">
                            <i class="fas fa-arrow-up"></i> +8% dari bulan lalu
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-box text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Pesanan Hari Ini -->
            <div class="bg-white  dark:border-gray-700 dark:bg-gray-800  rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium dark:text-gray-400 text-gray-600">Pesanan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ count($orders) }}</p>
                        <p class="text-xs text-green-600 mt-1">
                            <i class="fas fa-arrow-up"></i> +23% dari bulan lalu
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-orange-600"></i>
                    </div>
                </div>
            </div>

            <!-- Pendapatan Bulan Ini -->
            <div class="bg-white  dark:border-gray-700 dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium dark:text-gray-400 text-gray-600">Total Pengeluaran Bulan Ini</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($payments, '0', ',', '.') }}
                        </p>
                        <p class="text-xs text-green-600 mt-1">
                            <i class="fas fa-arrow-up"></i> +15% dari bulan lalu
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pesanan Terbaru -->
            <div
                class="lg:col-span-2 dark:bg-gray-800 dark:border-gray-700 bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold dark:text-white text-gray-800">Pesanan Terbaru</h3>
                            <p class="text-sm dark:text-gray-400 text-gray-500">Daftar pesanan terbaru dari reseller</p>
                        </div>
                        <button
                            class="px-4 py-2 bg-gray-800 dark:bg-gray-600 text-white text-sm rounded-lg hover:bg-gray-700 flex items-center space-x-2">
                            <i class="fas fa-eye"></i>
                            <span>Lihat Semua</span>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full ">
                        <thead class="bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
                            <tr>
                              
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium dark:text-gray-400 text-gray-500 uppercase tracking-wider">
                                    Reseller</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium dark:text-gray-400 text-gray-500 uppercase tracking-wider">
                                    Produk</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium dark:text-gray-400 text-gray-500 uppercase tracking-wider">
                                    Jumlah</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium dark:text-gray-400 text-gray-500 uppercase tracking-wider">
                                    Total</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium dark:text-gray-400 text-gray-500 uppercase tracking-wider">
                                    Tanggal Pesanan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:bg-gray-800 dark:border-gray-700 divide-gray-200">

                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gray-200  rounded-full flex items-center justify-center">
                                                <i class="text-xs fas fa-store font-medium"></i>
                                            </div>
                                            <span
                                                class="ml-3 text-sm font-medium dark:text-gray-400 text-gray-900">{{ $order->reseller->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900">
                                        @if ($order->saleItems->count() > 0)
                                            <ul class="list-disc pl-5">
                                                @foreach ($order->saleItems as $item)
                                                    <li>{{ $item->product->name }} ({{ $item->quantity }})</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900">
                                        {{ $order->saleItems->sum('quantity') }} items</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900"> RP.
                                        {{ number_format($order->total_amount, '0', ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $order->created_at->format('d-m-Y') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center  py-4 text-gray-500 dark:text-gray-400">
                                        Tidak ada pesanan ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                            {{-- </tr>
                                    {{-- <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                                    <span class="text-xs font-medium">O</span>
                                                </div>
                                                <span class="ml-3 text-sm font-medium dark:text-gray-400 text-gray-900">ORD-001</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm  dark:text-gray-400 text-gray-900">Toko Sari</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900">Nasi Gudeg</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900">25</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900">Rp 375,000</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-yellow-800 rounded-full">Menunggu</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                                    <span class="text-xs font-medium">O</span>
                                                </div>
                                                <span class="ml-3 text-sm font-medium dark:text-gray-400     text-gray-900">ORD-001</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm  dark:text-gray-400 text-gray-900">Toko Sari</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900">Nasi Gudeg</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900">25</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm dark:text-gray-400 text-gray-900">Rp 375,000</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Diproses</span>
                                        </td>
                                    </tr> --}}


                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Reseller -->
            <div class="bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700 shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold dark:text-gray-400 text-gray-800">Top Vendor</h3>
                            <p class="text-sm text-gray-500">Vendor dengan performa terbaik bulan ini</p>
                        </div>
                        <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-plus dark:text-gray-400 text-gray-600"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                    @forelse ($topResellers as $reseller )
                            <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-medium">T</span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium dark:text-gray-400 text-gray-900">{{ $reseller->name }}</p>
                                    {{-- <p class="text-xs text-gray-500">{{ $reseller->bill->sale->name }}</p> --}}
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium  dark:text-gray-400 text-gray-900">RP. {{ number_format($reseller->amount_paid, '0', ',', '.') }}</p>

                            </div>
                        </div>
                    @empty
                          <tr>
                                    <td colspan="8" class="text-center  py-4 text-gray-500 dark:text-gray-400">
                                        Tidak ada Top Vendor ditemukan.
                                    </td>
                                </tr>
                    @endforelse
                        
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
