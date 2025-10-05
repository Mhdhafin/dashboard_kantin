@extends('layouts.main')
@section('title', 'Pesanan')
@section('subtitle', 'Kelola pesanan anda kepada vendor')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold dark:text-white">Daftar Pesanan</h3>
            <button onClick="my_modal_3.showModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded flex items-center">
                <i class="fas fa-plus mr-2"></i> Pesanan
            </button>
        </div>

        <!-- Search and Filter -->
        <div class="flex flex-col md:flex-row justify-between mb-6 space-y-4 md:space-y-0">
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                 <form action="{{ route('orders.index') }}" method="GET">
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
            <div class="flex space-x-2">
                <button
                    class="border rounded-lg px-4 py-2 flex items-center space-x-2 hover:bg-gray-50 text-gray-900 dark:border-gray-600 dark:hover:bg-gray-700 dark:text-white">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
                <button
                    class="border rounded-lg px-4 py-2 flex items-center space-x-2 hover:bg-gray-50 text-gray-900 dark:border-gray-600 dark:hover:bg-gray-700 dark:text-white">
                    <i class="fas fa-download"></i>
                    <span>Export</span>
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="{{ $orders->count() > 3 ? 'overflow-x-auto' : 'overflow-y-hidden' }}">
            <table class="min-w-full   divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Reseller
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Produk
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Total
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Row 1 -->
                    @forelse ($orderSearch ?? $orders as $order )
                         <tr class="table-row hover:bg-gray-50 dark:hover:bg-gray-700">

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                <div class="flex gap-2 items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                        <i class="fas fa-store "></i>
                                    </div>
                                    <span>{{ $order->reseller->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                @if ($order->saleItems->count() > 0)
                                    <ul class="list-disc pl-5">
                                        @foreach ($order->saleItems as $item)
                                            <li>{{ $item->product->name }} ({{ $item->quantity }})</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $order->saleItems->sum('quantity') }} items
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                RP. {{ number_format($order->total_amount, '0', ',', '.') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $order->order_date }} 
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap  text-sm font-medium">
                                <div class="relative inline-block text-left">
                                    <button onclick="toggleActionDropdown('dropdown-{{ $order->id }}')"
                                        class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div id="dropdown-{{ $order->id }}"
                                        class="absolute   -right-16 z-10 -mt-4  w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform scale-95"
                                        data-dropdown>
                                        <div class="py-1">
                                            <a href="{{ url('/dashboard/orders/' . $order->id) }}"
                                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <i class="fas fa-eye mr-3 text-blue-500"></i>
                                                Detail
                                            </a>
                                            <div class="flex hover:bg-green-50 dark:hover:bg-green-900/20">
                                                <form id="confirm"  action="/dashboard/orders/{{ $order->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="delete"
                                                        class="flex items-center px-4 py-2 text-sm text-green-600 dark:text-green-400 ">
                                                       <i class="fas fa-circle-check mr-3"></i>
                                                        Selesai
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
                                Tidak ada produk ditemukan.
                            </td>
                        </tr>
                    @endforelse
                       
                    
                </tbody>
            </table>
        </div>

    </div>
    <dialog id="my_modal_3" class="modal px-4 py-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow-sm mt-6 overflow-scroll">
        <div  class=" modal-box">
            <template id="product-options" hidden>
    @foreach ($products as $product)
        <option value="{{ $product->id }}">{{ $product->name }} (Rp{{ number_format($product->price) }})</option>
    @endforeach
</template>
            <form method="dialog">
                <button
                    class="btn btn-sm btn-circle btn-ghost text-gray-900 dark:text-white absolute right-2 top-2">✕</button>
            </form>
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Orderan Baru
                </h3>

            </div>
            <form action="{{ url('/dashboard/orders') }}" method="post" class="mt-6 space-y-6">
                @csrf
                <div id="dynamic-fields" class=" grid grid-cols-1 gap-6 sm:grid-cols-2">




                    <div class="sm:col-span-2">
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



                    <div class="sm:col-span-2">
                        <label for="order_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Pesan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="order_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                  <div class="sm:col-span-2 flex items-center gap-5">
    <div class="w-full">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Produk <span class="text-red-500">*</span>
        </label>
        <select name="items[0][product_id]" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option class="hidden">Pilih Produk</option>
            @foreach ($products as $product)
                @if ($product->stock > 0)
                    <option value="{{ $product->id }}">{{ $product->name }} (Rp{{ number_format($product->price) }})</option>
                    @else
                    <option value="{{ $product->id }}" disabled>{{ $product->name }} (Stok Habis)</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="w-full">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Jumlah <span class="text-red-500">*</span>
        </label>
        <input type="number" name="items[0][quantity]" required min="1"
            class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="0">
    </div>
</div>
                   

                    

                </div>

                <div class="mt-4">
                        <button type="button" id="add-field"
                            class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            + Tambah Produk
                        </button>
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

    <script>
           document.getElementById('delete').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({ 
                title: "Apakah Anda yakin?",
                text: "Apakah anda yakin ingin melakukan aksi ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, konfirmasi!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('confirm').submit();
                }
            });
        });
    </script>
@endsection
