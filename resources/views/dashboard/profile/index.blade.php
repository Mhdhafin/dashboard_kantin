@extends('layouts.main')


@section('title', 'Profil')
@section('subtitle', 'Kelola informasi akun anda')

@section('content')

        <!-- Main content -->
        <div class="lg:pl-72">
            <div class="xl:pr-96">
                <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-6">


                    <!-- Profile Header -->
                    <div class="mb-8">
                        <div class="md:flex md:items-center md:justify-between">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">Profile</h2>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola informasi profile dan pengaturan akun Anda</p>
                            </div>
                            <div class="mt-4 flex md:ml-4 md:mt-0">
                                <a onclick="document.getElementById('modal_profile_edit{{ $user->id }}').showModal()" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    <i class="fas fa-edit -ml-0.5 mr-1.5 h-5 w-5"></i>
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Card -->
                    <div class="overflow-hidden bg-white dark:bg-gray-800 shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="sm:flex sm:items-center sm:justify-between">
                                <div class="sm:flex sm:space-x-5">
                                    <div class="flex-shrink-0">
                                        <img class="mx-auto h-20 w-20 rounded-full" src="{{ asset('assets/img/profile.png') }}" alt="{{ $user->name }}">
                                    </div>
                                    <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                        <p class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">{{ $user->name }}</p>
                                        <p class="text-lg font-medium text-gray-700 dark:text-gray-500">{{ $user->email }}</p>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $user->role }}</p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Personal Information -->
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Informasi Personal</h3>
                                <div class="mt-5 border-t border-gray-200 dark:border-gray-700">
                                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->name }}</dd>
                                        </div>
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->email }}</dd>
                                        </div>
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Telepon</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->phone ?: '-' }}</dd>
                                        </div>
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->address ?: '-' }}</dd>
                                        </div>
                                        @if($user->bio)
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bio</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->bio }}</dd>
                                        </div>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Informasi Akun</h3>
                                <div class="mt-5 border-t border-gray-200 dark:border-gray-700">
                                    <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Role</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->role }}</dd>
                                        </div>
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                            <dd class="mt-1 sm:col-span-2 sm:mt-0">
                                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' }}">
                                                    {{ $user->status_display }}
                                                </span>
                                            </dd>
                                        </div>
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Verified</dt>
                                            <dd class="mt-1 sm:col-span-2 sm:mt-0">
                                                @if($user->email_verified_at)
                                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                                        <i class="fas fa-check mr-1"></i>
                                                        Terverifikasi
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        Belum Terverifikasi
                                                    </span>
                                                @endif
                                            </dd>
                                        </div>
                                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bergabung</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->created_at->format('d M Y') }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <dialog id="modal_profile_edit{{ $user->id }}" class="modal px-4 py-6 bg-gray-100 dark:bg-gray-900 rounded-lg shadow-sm mt-6 overflow-scroll">
        <div class="modal-box">
            <form method="dialog">
                <button
                    class="btn btn-sm btn-circle btn-ghost text-gray-900 dark:text-white absolute right-2 top-2">✕</button>
            </form>
            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                   Edit Profile
                </h3>

            </div>
            <form action="{{ route('users.store') }}" method="post"
                class="mt-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                    <div >
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                           Nama <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nama reseller">
                    </div>
                    <div >
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Email anda">
                    </div>
                   
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200 dark:border-gray-700">
                    <button onclick="modal_profile_edit.close()" type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
                        id="cancel-button">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-blue-500 border border-transparent rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                        id="save-button">
                        <i class="fas fa-save mr-2"></i>
                        Simpan 
                    </button>
                </div>
            </form>
        </div>
    </dialog>
@endsection