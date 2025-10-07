<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            👋 Selamat datang, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-6 space-y-8">

            <!-- Greeting Card -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 rounded-2xl shadow-lg">
                <h3 class="text-white text-lg font-semibold">Selamat datang kembali di Perpustakaan Digital!</h3>
                <p class="text-indigo-100 text-sm mt-1">Ayo cari dan pinjam buku favoritmu hari ini 📚</p>
            </div>

            <div class="flex justify-between items-center mb-6">
                    <h2 class="text-gray-200 text-lg font-semibold">📚 Daftar Buku</h2>
                    <a href="{{ route('user.borrowings.history') }}"
                    class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                    📜 Lihat Riwayat
                    </a>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow hover:shadow-indigo-500/30 transition">
                    <div class="flex items-center justify-between">
                        <h4 class="text-gray-300 text-sm font-semibold">Total Buku</h4>
                        <div class="bg-indigo-600 text-white px-3 py-1 text-xs rounded">📖</div>
                    </div>
                    <p class="text-3xl font-bold text-white mt-3">{{ \App\Models\Book::count() }}</p>
                    <p class="text-gray-500 text-xs mt-1">Buku yang bisa kamu pinjam</p>
                </div>

                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow hover:shadow-indigo-500/30 transition">
                    <div class="flex items-center justify-between">
                        <h4 class="text-gray-300 text-sm font-semibold">Riwayat Peminjaman</h4>
                        <div class="bg-yellow-600 text-white px-3 py-1 text-xs rounded">🕐</div>
                    </div>
                    <p class="text-3xl font-bold text-white mt-3">{{ \App\Models\Borrowing::where('user_id', Auth::id())->count() }}</p>
                    <p class="text-gray-500 text-xs mt-1">Total buku yang pernah kamu pinjam</p>
                </div>

                


                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow hover:shadow-indigo-500/30 transition">
                    <div class="flex items-center justify-between">
                        <h4 class="text-gray-300 text-sm font-semibold">Status Terakhir</h4>
                        <div class="bg-green-600 text-white px-3 py-1 text-xs rounded">✅</div>
                    </div>
                    <p class="text-white mt-3 text-sm">
                        {{ optional(\App\Models\Borrowing::where('user_id', Auth::id())->latest()->first())->status ?? 'Belum ada peminjaman' }}
                    </p>
                </div>
            </div>

            <!-- Borrow Button -->
            <div class="text-center mt-8">
                <a href="{{ route('user.borrowings.index') }}"
                   class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-lg px-8 py-3 rounded-xl shadow-lg transition">
                    ➕ Pinjam Buku Sekarang
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
