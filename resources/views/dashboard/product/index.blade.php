@extends('layouts.main')
@section('title', 'Products')
@section('subtitle', 'Kelola semua produk dari reseller yang terdaftar')

{{-- @dd($products) --}}
@section('content')
    <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-1 max-w-lg">


            <form action="{{ route('products.index') }}" method="GET">
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


        <button onclick="my_modal_3.showModal()"
            class="btn flex items-center px-4 py-2 space-x-2 text-white bg-gray-800 dark:bg-gray-600 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-500 focus:ring-2 focus:ring-gray-500">
            <i class="fas fa-plus"></i>
            <span>Tambah Produk</span>
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Produk -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Produk</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ count($products) }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">+3 produk baru minggu ini</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                    <i class="text-blue-600 dark:text-blue-400 fas fa-info-circle"></i>
                </div>
            </div>
        </div>



        <!-- Stok Habis -->
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Stok Habis</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                        {{ count($products->where('stock', '<', 1)) }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Perlu restok segera</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-red-100 dark:bg-red-900/50 rounded-lg">
                    <i class="text-red-600 dark:text-red-400 fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>


    </div>

    <!-- Product Table -->
    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Produk</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola semua produk yang tersedia dari reseller</p>
        </div>

        <!-- Desktop Table -->
        <div class=" z-0 overflow-x-auto lg:block">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Gambar</th>
                        <th <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Produk</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Kategori</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Reseller</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Harga</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Stok</th>


                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($productSearch ?? $products as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">
                                <img src="{{ asset('/uploads/products/' . $product->image) }}"
                                    class="w-24 h-20 object-cover rounded" alt="{{ $product->name }}">
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $color = match ($product->category) {
                                        'Makanan' => 'orange',
                                        'Minuman' => 'blue',
                                        'Snack' => 'yellow',
                                        'Peralatan' => 'green',
                                        default => 'gray',
                                    };
                                @endphp
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-medium text-{{ $color }}-800 bg-{{ $color }}-100 dark:text-{{ $color }}-200 dark:bg-{{ $color }}-900/50 rounded-full">
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                {{ $product->reseller->name }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                {{ $product->stock }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($product->stock > 0)
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium text-green-800 bg-green-100 dark:text-green-200 dark:bg-green-900/50 rounded-full">Aktif</span>
                                @else
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-900/50 rounded-full">Tidak
                                        Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="relative inline-block text-left">
                                    <button onclick="toggleActionDropdown('dropdown-{{ $product->id }}')"
                                        class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div id="dropdown-{{ $product->id }}"
                                        class="absolute right-0 z-10 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform scale-95"
                                        data-dropdown>
                                        <div class="py-1">
                                            <a href="{{ url('/dashboard/products/' . $product->id) }}"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-eye mr-3 text-blue-500"></i> Detail
                                            </a>
                                            <a onclick="document.getElementById('modal_edit{{ $product->id }}').showModal()"
                                                class="flex cursor-pointer items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-edit mr-3 text-green-500"></i> Edit
                                            </a>
                                            <form action="/dashboard/products/{{ $product->id }}" method="POST"
                                                class="flex hover:bg-red-50 dark:hover:bg-red-900/20">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="flex items-center px-4 py-2 text-sm text-red-600 dark:text-red-400">
                                                    <i class="fas fa-ban mr-3"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Tidak ada produk ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>



    </div>




    <dialog id="my_modal_3" class="modal px-4 py-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow-sm mt-6 overflow-scroll">
        <div class="modal-box">
            <form method="dialog">
                <button
                    class="btn btn-sm btn-circle btn-ghost text-gray-900 dark:text-white absolute right-2 top-2">✕</button>
            </form>
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Produk Baru
                </h3>

            </div>
            <form action="{{ url('/dashboard/products') }}" method="post" enctype="multipart/form-data"
                class="mt-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Nama Produk -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nama produk">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option class="hidden">Pilih kategori</option>
                            <option value="Makanan">Makanan </option>
                            <option value="Minuman">Minuman</option>
                            <option value="Snack">Snack</option>
                            <option value="Peralatan">Peralatan</option>
                        </select>
                    </div>

                    <!-- Reseller -->
                    <div>
                        <label for="reseller_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Reseller <span class="text-red-500">*</span>
                        </label>
                        <select id="reseller_id" name="reseller_id" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option class="hidden">Pilih Reseller</option>
                            @foreach ($resellers as $reseller)
                                <option value="{{ $reseller->id }}">{{ $reseller->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                            </div>
                            <input type="number" id="price" name="price" required min="0"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="0">
                        </div>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" required min="0"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="0">
                    </div>



                    <!-- Upload Gambar -->
                    <div class="sm:col-span-2">
                        <label class="block mt-4 text-sm">
                            <span class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar
                                Produk</span>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col relative py-4 items-center justify-center w-full h-64 border-2 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600 bg-gray-300 border-dashed rounded-lg cursor-pointer ">
                                    <img id="img-preview" class="w-full h-full hidden object-contain">
                                    <div class="flex flex-col file items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click
                                                to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)
                                        </p>
                                    </div>
                                    <input id="dropzone-file" name="image" onchange="previewImage()" id="image imgInp"
                                        value="{{ old('image') }}" type="file" class="hidden image h-20" />
                                </label>
                            </div>

                        </label>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200 dark:border-gray-700">
                    <button onclick="my_modal_3.close()" type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                        id="cancel-button">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                        id="save-button">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    @foreach ($products as $product)
        <dialog id="modal_edit{{ $product->id }}"
            class="modal px-4 py-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow-sm mt-6 overflow-scroll">
            <div class="modal-box">
                <form method="dialog">
                    <button onclick="closeEditModal({{ $product->id }})"
                        class="btn btn-sm btn-circle btn-ghost text-gray-900 dark:text-white absolute right-2 top-2">✕</button>
                </form>
                <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Produk
                    </h3>

                </div>
                <form id="confirm" action="{{ url('/dashboard/products', $product->id) }}" method="post"
                    enctype="multipart/form-data" class="mt-6 space-y-6">
                    @method('PUT')
                    @csrf
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Nama Produk -->
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Produk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ $product->name }}" readonly
                                required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan nama produk">
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select id="category" name="category" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="{{ $product->category }}" class="hidden">{{ $product->category }}
                                </option>
                                <option value="Makanan">Makanan </option>
                                <option value="Minuman">Minuman</option>
                                <option value="Snack">Snack</option>
                                <option value="Peralatan">Peralatan</option>
                            </select>
                        </div>

                        <!-- Reseller -->
                        <div>
                            <label for="reseller_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Reseller <span class="text-red-500">*</span>
                            </label>
                            <select id="reseller_id" value="{{ $product->reseller->name }}" name="reseller_id" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="{{ $product->reseller->id }}" class="hidden">
                                    {{ $product->reseller->name }}</option>
                                @foreach ($resellers as $reseller)
                                    <option value="{{ $reseller->id }}">{{ $reseller->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga -->
                    <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Harga <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                                </div>
                                <input type="number" id="price" name="price" value="{{ $product->price }}"
                                    required min="0"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0">
                            </div>
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="stock" name="stock" value="{{ $product->stock }}" required
                                min="0"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="0">
                        </div>



                        <!-- Upload Gambar -->
                        <div class="sm:col-span-2">
                            <label class="block mt-4 text-sm">
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar
                                    Produk</span>
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
                                        <input id="dropzone-file" name="image" onchange="previewImage()"
                                            id="image imgInp" value="{{ old('image') }}" type="file"
                                            class="hidden image h-20" />
                                    </label>
                                </div>

                            </label>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div
                        class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200 dark:border-gray-700">
                        <button onclick="document.getElementById('modal_edit{{ $product->id }}').close()" type="button"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                            id="cancel-button">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </button>
                        <button type="submit" id="changes-button"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                            >
                            <i class="fas fa-save mr-2"></i>
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
    @endforeach


    <script>
        document.getElementById('changes-button').addEventListener('click', function(e) {
            Swal.fire({
                title: "Yakin Mau ubah produk?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire("Perubahan berhasil disimpan!", "", "success");
                    document.getElementById('confirm').submit();
                } else if (result.isDenied) {
                    Swal.fire("Perubahan dibatalkan", "", "info");
                }
            });
        });
    </script>
@endsection
