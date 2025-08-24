@extends('layouts.main')


@section('title', 'Daftar Akun Baru')

@section('content')
<div class="min-h-screen flex">
     <!-- Left Side - Register Form -->
     <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
         <div class="mx-auto w-full max-w-sm lg:w-96">
             <!-- Header -->
             <div class="text-center mb-8">
                 <div class="flex items-center justify-center mb-6">
                     <div class="flex items-center justify-center w-12 h-12 bg-gray-800 dark:bg-gray-600 rounded-lg">
                         <i class="text-xl text-white fas fa-store"></i>
                     </div>
                 </div>
                 <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                     Daftar Akun Baru
                 </h2>
                 <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                     Sudah punya akun?
                     <a href="{{ route('login')}}"
                         class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300"
                         onclick="navigateWithTheme('{{ route('login')}}')">
                         masuk di sini
                     </a>
                 </p>
             </div>

             <!-- Register Form -->
             <form class="space-y-6" action="{{ route('register.post') }}" method="POST">
              @csrf
                     <div>
                         <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                             Nama 
                         </label>
                         <div class="mt-1 relative">
                             <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                 <i class="fas fa-user text-gray-400 dark:text-gray-500"></i>
                             </div>
                             <input id="name" name="name" type="text" required
                                 class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                 placeholder="Nama Anda">
                         </div>
                     </div>

                     
                 

                 <div>
                     <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                         Email
                     </label>
                     <div class="mt-1 relative">
                         <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                             <i class="fas fa-envelope text-gray-400 dark:text-gray-500"></i>
                         </div>
                         <input id="email" name="email" type="email" autocomplete="email" required
                             class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                             placeholder="Masukkan email Anda">
                     </div>
                 </div>


                 <div>
                     <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                         Password
                     </label>
                     <div class="mt-1 relative">
                         <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                             <i class="fas fa-lock text-gray-400 dark:text-gray-500"></i>
                         </div>
                         <input id="password" name="password" type="password" autocomplete="new-password" required
                             class="appearance-none block w-full pl-10 pr-10 py-3 border border-gray-300 dark:border-gray-600 rounded-lg placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                             placeholder="Minimal 8 karakter" minlength="8">
                         <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                             onclick="togglePassword('password')">
                             <i class="fas fa-eye text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300"
                                 id="password-toggle"></i>
                         </button>
                     </div>
                     {{-- <!-- Password Strength Indicator -->
                     <div class="mt-2">
                         <div class="flex space-x-1">
                             <div class="h-1 flex-1 bg-gray-200 dark:bg-gray-600 rounded" id="strength-1"></div>
                             <div class="h-1 flex-1 bg-gray-200 dark:bg-gray-600 rounded" id="strength-2"></div>
                             <div class="h-1 flex-1 bg-gray-200 dark:bg-gray-600 rounded" id="strength-3"></div>
                             <div class="h-1 flex-1 bg-gray-200 dark:bg-gray-600 rounded" id="strength-4"></div>
                         </div>
                         <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" id="strength-text">Password harus
                             minimal 8 karakter</p>
                     </div> --}}
                 </div>


                 <div class="flex items-center">
                     <input id="terms" name="terms" type="checkbox" required
                         class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700">
                     <label for="terms" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                         Saya setuju dengan
                         <a href="#"
                             class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">Syarat
                             & Ketentuan</a>
                         dan
                         <a href="#"
                             class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">Kebijakan
                             Privasi</a>
                     </label>
                 </div>

                 <div>
                     <button type="submit"
                         class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gray-800 dark:bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-900 transition-colors duration-200">
                         <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                             <i class="fas fa-user-plus text-gray-300 group-hover:text-gray-200"></i>
                         </span>
                         Daftar Sekarang
                     </button>
                 </div>

                 {{-- <!-- Social Register -->
                 <div class="mt-6">
                     <div class="relative">
                         <div class="absolute inset-0 flex items-center">
                             <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                         </div>
                         <div class="relative flex justify-center text-sm">
                             <span class="px-2 bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400">Atau
                                 daftar dengan</span>
                         </div>
                     </div>

                     <div class="mt-6 grid grid-cols-2 gap-3">
                         <button type="button"
                             class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                             <i class="fab fa-google text-red-500"></i>
                             <span class="ml-2">Google</span>
                         </button>

                         <button type="button"
                             class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                             <i class="fab fa-facebook text-blue-600"></i>
                             <span class="ml-2">Facebook</span>
                         </button>
                     </div>
                 </div> --}}
             </form>

             <!-- Dark Mode Toggle -->
             <div class="mt-8 flex justify-center">
                 <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200"
                     id="dark-mode-toggle" title="Toggle Dark Mode">
                     <i class="text-gray-600 dark:text-gray-300 fas fa-sun dark:hidden" id="light-icon"></i>
                     <i class="text-gray-300 fas fa-moon hidden dark:block" id="dark-icon"></i>
                 </button>
             </div>
         </div>
     </div>

     <!-- Right Side - Image/Branding -->
     <div class="hidden lg:block relative w-0 flex-1">
         <div
             class="absolute inset-0 h-full w-full bg-gradient-to-br from-blue-800 to-blue-900 dark:from-blue-900 dark:to-black">
             <div class="flex flex-col justify-center items-center h-full text-white p-12">
                 <div class="text-center">
                     <div class="mb-8">
                         <div
                             class="flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-6">
                             <i class="text-3xl fas fa-users"></i>
                         </div>
                     </div>
                     <h1 class="text-4xl font-bold mb-4">Bergabung Bersama Kami</h1>
                     <p class="text-xl text-blue-200 mb-8">Mulai perjalanan bisnis reseller Anda hari ini</p>
                     <div class="space-y-4 text-left max-w-md">
                         <div class="flex items-center space-x-3">
                             <i class="fas fa-rocket text-blue-400"></i>
                             <span>Setup cepat dalam 5 menit</span>
                         </div>
                         <div class="flex items-center space-x-3">
                             <i class="fas fa-shield-alt text-blue-400"></i>
                             <span>Keamanan data terjamin</span>
                         </div>
                         <div class="flex items-center space-x-3">
                             <i class="fas fa-chart-line text-blue-400"></i>
                             <span>Tingkatkan penjualan hingga 300%</span>
                         </div>
                         <div class="flex items-center space-x-3">
                             <i class="fas fa-headset text-blue-400"></i>
                             <span>Dukungan pelanggan 24/7</span>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>
@endsection
