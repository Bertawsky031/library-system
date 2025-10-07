<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Manage Books -->
                <a href="{{ route('admin.books.index') }}" 
                   class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-xl shadow-lg p-8 hover:scale-105 transition-transform duration-200 flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-12 w-12 mb-4" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 6V4m0 16v-2m8-6h2M4 12H2m15.364-7.364l1.414 1.414M6.222 17.778l-1.414 1.414M18.364 18.364l1.414-1.414M7.636 5.636L6.222 4.222M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <h3 class="text-2xl font-bold">Kelola Buku</h3>
                    <p class="text-sm mt-2 text-blue-100">Tambah, edit, atau hapus buku di perpustakaan.</p>
                </a>

                <!-- Borrowing Management -->
                <a href="{{ route('admin.borrowings.index') }}" 
                   class="bg-gradient-to-r from-green-500 to-green-700 text-white rounded-xl shadow-lg p-8 hover:scale-105 transition-transform duration-200 flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-12 w-12 mb-4" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 8c1.656 0 3 1.344 3 3s-1.344 3-3 3-3-1.344-3-3 1.344-3 3-3zm0 10c4.418 0 8-3.582 8-8S16.418 2 12 2 4 5.582 4 10c0 2.387 1.046 4.537 2.732 6.05L5 21l3.95-1.732C10.463 21.954 12.613 22 15 22c.171 0 .341 0 .51-.01" />
                    </svg>
                    <h3 class="text-2xl font-bold">Peminjaman Buku</h3>
                    <p class="text-sm mt-2 text-green-100">Kelola peminjaman dan pengembalian buku.</p>
                </a>

                <!-- User Management (optional future) -->
                <a href="#" 
                   class="bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-xl shadow-lg p-8 hover:scale-105 transition-transform duration-200 flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-12 w-12 mb-4" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6v-2a4 4 0 014-4h3m-7-4a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                    <h3 class="text-2xl font-bold">Data User</h3>
                    <p class="text-sm mt-2 text-purple-100">Kelola akun pengguna sistem.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
