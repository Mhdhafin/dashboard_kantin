  <aside class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-colors duration-200">
                <!-- Logo/Brand -->
                <div class="flex items-center h-16 px-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-800 dark:bg-gray-600 rounded">
                            <i class="text-sm text-white fas fa-store"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-800 dark:text-white">Manajemen Kantin</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Dashboard</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                    <p class="mb-3 text-xs font-medium tracking-wider text-gray-400 dark:text-gray-500 uppercase">Menu Utama</p>
                    
                    <a href="/" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('/') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg">
                        <i class="w-4  {{ Request::is('/') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-chart-bar"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    
                    <a href="/dashboard/resellers" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/resellers') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg">
                        <i class="w-4  {{ Request::is('dashboard/resellers') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-users"></i>
                        <span>Vendor</span>
                    </a>
                    <a href="/dashboard/products" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/products') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg">
                        <i class="w-4  {{ Request::is('dashboard/products') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-box"></i>
                        <span>Produk</span>
                    </a>
                    
                    <a href="/dashboard/orders" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/orders') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg">
                        <i class="w-4  {{ Request::is('dashboard/orders') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-shopping-cart"></i>
                        <span>Pesanan</span>
                    </a>
                    
                    <a href="/dashboard/bills" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/bills') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg">
                        <i class="w-4  {{ Request::is('dashboard/bills') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-tags"></i>
                        <span>Tagihan</span>
                    </a>
                    <a href="/dashboard/payments" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/payments') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg">
                        <i class="w-4  {{ Request::is('dashboard/payments') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-credit-card"></i>
                        <span>Pembayaran</span>
                    </a>
                    
                    <a href="#" class="flex items-center px-3 py-2 space-x-3 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 group">
                        <i class="w-4 fas fa-file-alt text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                        <span>Laporan</span>
                    </a>
                    

                </nav>

                <!-- Admin Info with Dropdown -->
                <div class="relative p-4 border-t border-gray-200 dark:border-gray-700">
                    <button class="flex items-center w-full space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200" id="desktop-profile-button">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full">
                            <i class="text-sm text-gray-600 dark:text-gray-300 fas fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0 text-left">
                            <p class="text-sm font-medium text-gray-800 dark:text-white truncate">Admin Kantin</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">admin@kantin.com</p>
                        </div>
                        <i class="text-gray-400 dark:text-gray-500 fas fa-chevron-up transition-transform duration-200" id="desktop-profile-chevron"></i>
                    </button>
                    
                    <!-- Desktop Profile Dropdown -->
                    <div class="absolute bottom-full left-4 right-4 mb-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform translate-y-2" id="desktop-profile-dropdown">
                        <div class="py-2">
                            <a href="{{ route('users.index')}}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <i class="w-4 mr-3 fas fa-user-circle"></i>
                                Profile Saya
                            </a>
                            
                            <hr class="my-2 border-gray-200 dark:border-gray-600">
                            <a href="/logout/{{ auth()->user()->id }}" class="flex items-center px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                <i class="w-4 mr-3 fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>


        <!-- Mobile sidebar backdrop -->
        <div class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden transition-opacity duration-300 ease-linear opacity-0 pointer-events-none" id="sidebar-backdrop"></div>

        <!-- Mobile sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden" id="mobile-sidebar">
            <div class="flex flex-col h-full">
                <!-- Mobile Logo/Brand -->
                <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-800 dark:bg-gray-600 rounded">
                            <i class="text-sm text-white fas fa-store"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-800 dark:text-white">Manajemen Kantin</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Dashboard</p>
                        </div>
                    </div>
                    <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700" id="close-sidebar">
                        <i class="text-gray-600 dark:text-gray-300 fas fa-times"></i>
                    </button>
                </div>

                <!-- Mobile Navigation Menu -->
                <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                    <p class="mb-3 text-xs font-medium tracking-wider text-gray-400 dark:text-gray-500 uppercase">Menu Utama</p>
                    
                    <a href="/" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('/') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg group mobile-menu-item">
                        <i class="w-4  {{ Request::is('/') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-chart-bar"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    
                    <a href="/dashboard/resellers" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/resellers') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg group mobile-menu-item">
                        <i class="w-4  {{ Request::is('dashboard/resellers') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-users"></i>
                        <span>Vendor</span>
                    </a>
                    <a href="/dashboard/products" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/products') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg group mobile-menu-item">
                        <i class="w-4  {{ Request::is('dashboard/products') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-box"></i>
                        <span>Produk</span>
                    </a>
                    
                    <a href="/dashboard/orders" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/orders') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg  group mobile-menu-item">
                        <i class="w-4  {{ Request::is('dashboard/orders') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-shopping-cart"></i>
                        <span>Pesanan</span>
                    </a>
                    
                    <a href="/dashboard/bills" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/bills') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg group mobile-menu-item" >
                        <i class="w-4  {{ Request::is('dashboard/bills') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-tags"></i>
                        <span>Tagihan</span>
                    </a>
                    <a href="/dashboard/payments" class="flex items-center px-3 py-2 space-x-3 font-medium {{ Request::is('dashboard/payments') ? 'text-blue-700 dark:text-blue-400 bg-blue-50' : 'text-gray-600 dark:text-gray-300  hover:bg-gray-50 dark:hover:bg-gray-700 '}}   rounded-lg group mobile-menu-item">
                        <i class="w-4  {{ Request::is('dashboard/payments') ? 'text-blue-700' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 '}}  fas fa-credit-card"></i>
                        <span>Pembayaran</span>
                    </a>
                    
                    <a href="#" class="flex items-center px-3 py-2 space-x-3 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 group">
                        <i class="w-4 fas fa-file-alt text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                        <span>Laporan</span>
                    </a>
                </nav>

                <!-- Mobile Admin Info with Dropdown -->
                <div class="relative p-4 border-t border-gray-200 dark:border-gray-700">
                    <button class="flex items-center w-full space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200" id="mobile-profile-button">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full">
                            <i class="text-sm text-gray-600 dark:text-gray-300 fas fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0 text-left">
                            <p class="text-sm font-medium text-gray-800 dark:text-white truncate">Admin Kantin</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">admin@kantin.com</p>
                        </div>
                        <i class="text-gray-400 dark:text-gray-500 fas fa-chevron-up transition-transform duration-200" id="mobile-profile-chevron"></i>
                    </button>
                    
                    <!-- Mobile Profile Dropdown -->
                    <div class="absolute bottom-full left-4 right-4 mb-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform translate-y-2" id="mobile-profile-dropdown">
                        <div class="py-2">
                            <a href="{{ route('users.index')}}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <i class="w-4 mr-3 fas fa-user-circle"></i>
                                Profile Saya
                            </a>
                           
                            <hr class="my-2 border-gray-200 dark:border-gray-600">
                            <a href="/logout/{{ auth()->user()->id }}" class="flex items-center px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                <i class="w-4 mr-3 fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>