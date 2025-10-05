@extends('layouts.main')

@section('title', 'Halaman Tagihan')
@section('subtitle', 'Kelola tagihan anda kepada reseller')

@section('content')
    {{-- @dd($bills) --}}
    <!-- Filter Tabs -->
    {{-- <div class="mb-6">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex space-x-8">
                            <button class="border-blue-500 text-blue-600 dark:text-blue-400 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                Semua Tagihan
                                <span class="ml-2 bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 py-0.5 px-2.5 rounded-full text-xs font-medium">18</span>
                            </button>
                            <button class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                Belum Dibayar
                                <span class="ml-2 bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 py-0.5 px-2.5 rounded-full text-xs font-medium">7</span>
                            </button>
                            <button class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                Jatuh Tempo
                                <span class="ml-2 bg-yellow-100 dark:bg-yellow-900/50 text-yellow-600 dark:text-yellow-400 py-0.5 px-2.5 rounded-full text-xs font-medium">3</span>
                            </button>
                            <button class="border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                Lunas
                                <span class="ml-2 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 py-0.5 px-2.5 rounded-full text-xs font-medium">8</span>
                            </button>
                        </nav>
                    </div>
                </div> --}}

    <!-- Search and Filter Bar -->
    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 max-w-lg">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="text-gray-400 dark:text-gray-500 fas fa-search"></i>
                </div>
                <input type="text" placeholder="Cari tagihan..."
                    class="block w-full py-2 pl-10 pr-3 border border-gray-300 dark:border-gray-600 rounded-l-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button
                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-l-0 border-gray-300 dark:border-gray-600 rounded-r-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <i class="mr-2 fas fa-filter"></i>
                Filter
            </button>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('bills.export') }}"
                class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600">
                <i class="fas fa-download mr-2"></i>
                Export
            </a>

            <button onclick="modal_bill_trashed.showModal()" id="createBillBtn"
                class="flex items-center px-4 disable py-2 space-x-2 text-white bg-gray-800 dark:bg-gray-600 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-500 focus:ring-2 focus:ring-gray-500">
                <i class="fas fa-recycle"></i>
                <span>Restore Tagihan</span>
            </button>

        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Tagihan -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Tagihan</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $bills->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count() }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Bulan ini</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                    <i class="text-blue-600 dark:text-blue-400 fas fa-file-invoice"></i>
                </div>
            </div>
        </div>

        <!-- Belum Dibayar -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Belum Dibayar</p>
                    {{-- <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">RP.
                        {{ number_format($bills->sum('total_amount'), '0', ',', '.') - number_format($bills->sum('amount_paid'), '0', ',', '.') }}</p> --}}
                    <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">RP.
                        {{ number_format($bills->where('status', 'Belum Bayar')->sum('total_amount'), '0', ',', '.') }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ count($bills) }} tagihan</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-red-100 dark:bg-red-900/50 rounded-lg">
                    <i class="text-red-600 dark:text-red-400 fas fa-exclamation-circle"></i>
                </div>
            </div>
        </div>


    </div>

    <!-- Bills Table -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Tagihan</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola tagihan pembayaran ke reseller</p>
        </div>

        <!-- Desktop Table -->
        <div class="overflow-x-auto">
            <table class="w-full ">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>

                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Reseller</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Tanggal Order</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Jumlah</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Total Tagihan</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Terbayar</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Bill Row 1 -->
                    @forelse ($bills as $bill)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">

                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="flex items-center justify-center w-10 h-10 bg-gray-300 dark:bg-gray-600 rounded-full">
                                        <i class="text-gray-600 dark:text-gray-300 fas fa-store"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $bill->reseller->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{ $bill->created_at->format('d M Y') }}</p>

                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                {{ $bill->total_quantity }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">RP.
                                {{ number_format($bill->total_amount, '0', ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm text-gray-900 dark:text-white">RP.
                                        {{ number_format($bill->amount_paid, '0', ',', '.') }}</p>

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-medium {{ $bill->status == 'Belum Bayar' ? 'text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-900/50' : 'text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50' }} rounded-full">{{ $bill->status }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="relative inline-block text-left">
                                    <button onclick="toggleActionDropdown('dropdown-{{ $bill->id }}')"
                                        class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                                        onclick="toggleActionDropdown(this)">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div id="dropdown-{{ $bill->id }}"
                                        class="absolute -right-16 z-10 -mt-4 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform scale-95"
                                        data-dropdown>
                                        <div class="py-1">
                                            <a href="{{ route('bills.show', $bill->id) }}"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-eye mr-3 text-blue-500"></i>
                                                Detail
                                            </a>
                                            <a onclick="document.getElementById('modal_pembayaran{{ $bill->id }}').showModal()"
                                                class="flex items-center cursor-pointer px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-credit-card mr-3 text-green-500"></i>
                                                Bayar
                                            </a>
                                            <a onclick="document.getElementById('modal_consignment{{ $bill->id }}').showModal()"
                                                class="flex items-center cursor-pointer px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-box mr-3 text-purple-500"></i>
                                                Consignment
                                            </a>
                                            <div class="flex hover:bg-red-50 dark:hover:bg-red-900/20">
                                                <form action="/dashboard/bills/{{ $bill->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="flex items-center px-4 py-2 text-sm text-red-600 dark:text-red-400 0">
                                                        <i class="fas fa-ban mr-3"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Tidak ada Tagihan ditemukan.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


    </div>

    @foreach ($bills as $bill)
        <dialog id="modal_pembayaran{{ $bill->id }}"
            class="modal px-4 py-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow-sm mt-6 overflow-scroll">
            <div class="modal-box">
                <form method="dialog">
                    <button onclick="modal_pembayaran.close()"
                        class="btn btn-sm btn-circle btn-ghost text-gray-900 dark:text-white absolute right-2 top-2">✕</button>
                </form>
                <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Bayar Tagihan
                    </h3>

                </div>
                <form action="{{ url('/dashboard/payments') }}" method="post" enctype="multipart/form-data"
                    class="mt-6 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <input type="hidden" name="bill_id" value="{{ $bill->id }}">


                        <!-- Reseller -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Reseller
                            </label>
                            <input type="text" value="{{ $bill->reseller->name }}" readonly
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <!-- Reseller -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tagihan
                            </label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                                </div>
                                <input value="{{ number_format($bill->total_amount, '0', ',', '.') }}" readonly
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0">
                            </div>
                        </div>



                        <div>
                            <label for="paid_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tanggal Pesan <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="paid_at" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>



                        <!-- Harga -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Bayar <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                                </div>
                                <input type="number" id="amount" name="amount" required min="0"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Keterangan <span class="text-white-500 text-sm">(Optional)</span>
                            </label>

                            <textarea name="notes" id="notes"
                                class="mt-2 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white  placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>

                        </div>
                        


                        <!-- Upload Gambar -->
                        <div class="sm:col-span-2">
                            <label class="block mt-4 text-sm">
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bukti
                                    Pembayaran</span>
                                <div class="flex items-center justify-center w-full">
                                    <label
                                        class="upload-wrapper flex flex-col relative py-4 items-center justify-center w-full h-64 border-2 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600 bg-gray-300 border-dashed rounded-lg cursor-pointer">
                                        <img class="img-preview w-full h-full hidden object-contain">
                                        <div class="flex flex-col file-area items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click to
                                                    upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                                800x400px)</p>
                                        </div>
                                        <input type="file" name="payment_proof" class="hidden image-input"
                                            onchange="previewImageEdit(event)">
                                    </label>
                                </div>
                            </label>
                        </div>
                        {{-- <div class="sm:col-span-2">
                            <label class="block mt-4 text-sm">
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bukti
                                    Pembayaran</span>
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col relative py-4 items-center justify-center w-full h-64 border-2 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600 bg-gray-300 border-dashed rounded-lg cursor-pointer ">
                                        <img id="img-preview" class="w-full h-full hidden object-contain">
                                        <div class="flex flex-col file items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click
                                                    to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                                800x400px)
                                            </p>
                                        </div>
                                        <input id="dropzone-file" name="payment_proof" onchange="previewImageEdit()"
                                            id="image imgInp" value="{{ old('payment_proof') }}" type="file"
                                            class="hidden image h-20" />
                                    </label>
                                </div>

                            </label>
                        </div> --}}
                    </div>


                    <!-- Modal Footer -->
                    <div
                        class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200 dark:border-gray-700">
                        <button onclick="modal_pembayaran.close()" type="button"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                            id="cancel-button">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                            id="save-button">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
    @endforeach

     @foreach ($bills as $bill)
        <dialog id="modal_consignment{{ $bill->id }}"
            class="modal px-4 py-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow-sm mt-6 overflow-scroll">
            <div class="modal-box">
                <form method="dialog">
                    <button onclick="modal_consignment.close()"
                        class="btn btn-sm btn-circle btn-ghost text-gray-900 dark:text-white absolute right-2 top-2">✕</button>
                </form>
                <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Consignment
                    </h3>

                </div>
                <form action="{{ url('/dashboard/bills', $bill->id)}}" method="post" 
                    class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <input type="hidden" name="bill_id" value="{{ $bill->id }}">


                        <!-- Reseller -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Reseller
                            </label>
                            <input type="text" value="{{ $bill->reseller->name }}" readonly
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <!-- Reseller -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tagihan
                            </label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                                </div>
                                <input value="{{ number_format($bill->total_amount, '0', ',', '.') }}" readonly
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0">
                            </div>
                        </div>



                        <!-- Harga -->
                        <div>
                            <label for="total_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Consignment <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                                </div>
                                <input type="number" id="total_amount" name="total_amount" required min="0"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0">
                            </div>
                        </div>
                  
                    </div>


                    <!-- Modal Footer -->
                    <div
                        class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200 dark:border-gray-700">
                        <button onclick="modal_consignment.close()" type="button"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                            id="cancel-button">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                            id="save-button">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
    @endforeach

    <dialog id="modal_bill_trashed"
        class="modal px-4 py-8 bg-gray-100 scroll-mt-48 dark:bg-gray-800 rounded-lg shadow-sm ">
        <div class="modal-box">
            <form method="dialog">
                <button onclick="modal_bill_trashed.close()"
                    class="btn btn-sm btn-circle font-bold btn-ghost text-gray-900 dark:text-white absolute right-4 top-2">✕</button>
            </form>
            <div class="flex items-center justify-between pb-4 mb-5 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Restore Tagihan
                </h3>

                <form action="{{ route('bill.restore.all') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button
                        class="px-4 py-2 text-sm mt-8 {{ $billTrashed->count() == 0 ? 'hidden' : '' }} font-medium text-white bg-green-600 dark:bg-green-500 border border-transparent rounded-lg hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                        <i class="fas fa-recycle mr-2"></i>
                        Restore All
                    </button>
                </form>

            </div>

            {{-- Tambahkan tabel --}}
            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Reseller</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Qty</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Total</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Dibayar</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                        @forelse ($billTrashed as $bill)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 bg-gray-300 dark:bg-gray-600 rounded-full">
                                            <i class="text-gray-600 dark:text-gray-300 fas fa-store"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                {{ $bill->reseller->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{ $bill->created_at->format('d M Y') }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $bill->total_quantity }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    RP. {{ number_format($bill->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        RP. {{ number_format($bill->amount_paid, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium {{ $bill->status == 'Belum Bayar' ? 'text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-900/50' : 'text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50' }} rounded-full">
                                        {{ $bill->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('bills.show', $bill->id) }}"
                                            class="p-2 text-sm  font-medium text-white bg-blue-600 dark:bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <i class="fas fa-eye "></i>
                                        </a>
                                        <form action="{{ route('bill.restore', $bill->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="p-2 text-sm font-medium text-white bg-green-600 dark:bg-green-500 border border-transparent rounded-lg hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                                <i class="fas fa-recycle"></i>
                                            </button>
                                        </form>

                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                    Tidak ada Tagihan ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </dialog>



    @push('custom_script')
        <script>
            function previewImageEdit(event) {
                const input = event.target;
                const wrapper = input.closest(".upload-wrapper");

                const imgPreview = wrapper.querySelector(".img-preview");
                const fileArea = wrapper.querySelector(".file-area");

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.src = e.target.result;
                        imgPreview.style.display = "block";
                        fileArea.style.display = "none";
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
