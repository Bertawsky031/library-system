<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100">📜 Riwayat Peminjaman</h2>
    </x-slot>

    <div class="p-8 bg-gray-900 min-h-screen">
        <!-- Filter Section -->
        <div class="bg-gray-800 p-4 rounded-xl border border-gray-700 mb-6">
            <form method="GET" action="{{ route('user.borrowings.history') }}" class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="text-gray-400 text-sm">Status</label>
                    <select name="status" class="bg-gray-900 text-gray-200 px-3 py-2 rounded border border-gray-600">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Dari</label>
                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="bg-gray-900 text-gray-200 px-3 py-2 rounded border border-gray-600">
                </div>

                <div>
                    <label class="text-gray-400 text-sm">Sampai</label>
                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="bg-gray-900 text-gray-200 px-3 py-2 rounded border border-gray-600">
                </div>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                    🔍 Filter
                </button>
            </form>
        </div>

        <!-- Table Section -->
        <table class="min-w-full text-gray-300 border border-gray-700 rounded-xl">
            <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2">Judul Buku</th>
                    <th class="px-4 py-2">Tanggal Pinjam</th>
                    <th class="px-4 py-2">Tanggal Kembali</th>
                    <th class="px-4 py-2 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrowings as $borrow)
                    <tr class="hover:bg-gray-700/50 transition">
                        <td class="px-4 py-2">{{ $borrow->book->title }}</td>
                        <td class="px-4 py-2">{{ $borrow->borrow_date_formatted }}</td>
                        <td class="px-4 py-2">{{ $borrow->return_date_formatted }}</td>
                        <td class="px-4 py-2 text-center">
                            @switch($borrow->status)
                                @case('approved')
                                    <span class="bg-green-600/20 text-green-400 px-3 py-1 rounded-full text-xs font-semibold">Approved</span>
                                    @break
                                @case('pending')
                                    <span class="bg-yellow-600/20 text-yellow-400 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                                    @break
                                @case('returned')
                                    <span class="bg-blue-600/20 text-blue-400 px-3 py-1 rounded-full text-xs font-semibold">Returned</span>
                                    @break
                                @default
                                    <span class="bg-red-600/20 text-red-400 px-3 py-1 rounded-full text-xs font-semibold">Rejected</span>
                            @endswitch
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada riwayat peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $borrowings->links('vendor.pagination.tailwind') }}
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('user.borrowings.index') }}" class="text-indigo-400 hover:text-indigo-300 underline">
                ← Kembali ke Daftar Buku
            </a>
        </div>
    </div>
</x-app-layout>
