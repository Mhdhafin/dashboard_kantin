@extends('layouts.main')
@section('title', 'Pembayaran')
@section('subtitle', 'Kelola pembayaran anda kepada reseller')

@section('content')
    {{-- @dd($payments) --}}
    <!-- Filter Tabs -->
    {{-- <div class="mb-6">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex space-x-8">
                            <button class="border-blue-500 text-blue-600 dark:text-blue-400 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                Semua Pembayaran
                                <span class="ml-2 bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 py-0.5 px-2.5 rounded-full text-xs font-medium">15</span>
                            </button>
                            <button class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                Berhasil
                                <span class="ml-2 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 py-0.5 px-2.5 rounded-full text-xs font-medium">12</span>
                            </button>
                            <button class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                Pending
                                <span class="ml-2 bg-yellow-100 dark:bg-yellow-900/50 text-yellow-600 dark:text-yellow-400 py-0.5 px-2.5 rounded-full text-xs font-medium">2</span>
                            </button>
                            <button class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                Gagal
                                <span class="ml-2 bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 py-0.5 px-2.5 rounded-full text-xs font-medium">1</span>
                            </button>
                        </nav>
                    </div>
                </div> --}}

    <!-- Search and Filter Bar -->
    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 max-w-lg">
            <form action="{{ route('payments.index') }}" method="GET">
                <div class="relative flex">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="text-gray-400 dark:text-gray-500 fas fa-search"></i>
                    </div>
                    <input type="text" name="search" placeholder="Cari produk..."
                        class="block w-full py-2 pl-10 pr-3 border border-gray-300 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500">




                    <button
                        class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-l-0 border-gray-300 dark:border-gray-600 rounded-r-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        Search
                    </button>
                </div>
            </form>

        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('payments.export') }}"
                class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600">
                <i class="fas fa-download mr-2"></i> Export Excel
            </a>
            {{-- <button class="">
                <i class="fas fa-download mr-2"></i>
                Export
            </button> --}}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Pembayaran -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pembayaran</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ count($payments) }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Bulan ini</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                    <i class="text-blue-600 dark:text-blue-400 fas fa-credit-card"></i>
                </div>
            </div>
        </div>

        <!-- Total Dibayar -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Dibayar</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">RP.
                        {{ number_format($payment_paid, '0', ',', '.') ?? 0 }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $paymentCount }} pembayaran</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-lg">
                    <i class="text-green-600 dark:text-green-400 fas fa-check-circle"></i>
                </div>
            </div>
        </div>


    </div>

    <!-- Payments Table -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Riwayat Pembayaran</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Daftar pembayaran yang telah dilakukan ke reseller</p>
        </div>

        <!-- Desktop Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Reseller
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Tanggal Pembayaran
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Terbayar
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Keterangan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Bukti Pembayaran
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Aksi
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Payment Row 1 -->
                    @forelse ($paymentSearch ?? $payments as $payment)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">
                                <div class="flex gap-2 items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                        <i class="fas fa-store "></i>
                                    </div>
                                    <span>{{ $payment->bill->reseller->name }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900 dark:text-white">{{ $payment->paid_at }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">RP.
                                {{ number_format($payment->amount, '0', ',', '.') }}</td>


                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900 dark:text-white">{{ $payment->notes ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($payment->amount > 0)
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50 rounded-full">Berhasil</span>
                                @else
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-900/50 rounded-full">Gagal</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ asset('/uploads/payments/' . $payment->payment_proof) }}"
                                    class="w-32 h-20 object-cover" alt="">
                            </td>
                            <td class="px-6 py-4">
                                <div class="relative inline-block text-left">
                                    <button
                                        class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                                        onclick="toggleActionDropdown('dropdown-{{ $payment->id }}')">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div id="dropdown-{{ $payment->id }}"
                                        class="absolute  -right-16 z-10 -mt-4 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform scale-95">
                                        <div class="py-1">
                                            <a href="{{ url('/dashboard/payments/' . $payment->id) }}"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-eye mr-3 text-blue-500"></i>
                                                Detail
                                            </a>
                                            <a href="{{ asset('/uploads/payments/' . $payment->payment_proof) }}"
                                                download="{{ $payment->payment_proof }}"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-download mr-3 text-purple-500"></i>
                                                Download Bukti
                                            </a>
                                            <a href="#"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-receipt mr-3 text-green-500"></i>
                                                Kwitansi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Tidak ada pembayaran ditemukan.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


    </div>
@endsection
