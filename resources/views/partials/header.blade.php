  <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 lg:hidden" id="mobile-menu-button">
                            <i class="text-gray-600 dark:text-gray-300 fas fa-bars"></i>
                        </button>
                        <div class="flex items-center space-x-3">
                            <i class="text-xl text-gray-600 dark:text-gray-300 fas fa-layer-group"></i>
                            <div>
                                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">@yield('title')</h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400">@yield('subtitle')</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dark Mode Toggle -->
                    <div class="flex items-center space-x-4">
                        <button class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" id="dark-mode-toggle" title="Toggle Dark Mode">
                            <i class="text-gray-600 dark:text-gray-300 fas fa-sun block dark:hidden" id="light-icon"></i>
                            <i class="text-gray-600 dark:text-gray-300 fas fa-moon px-0 invisible dark:visible" id="dark-icon"></i>
                        </button>
                    </div>
                </div>
            </header>