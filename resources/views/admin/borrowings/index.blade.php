<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100">📋 Manajemen Peminjaman</h2>
    </x-slot>

    <div class="p-8 bg-gray-900 min-h-screen">
        @if (session('success'))
            <div class="p-4 bg-green-700/20 border border-green-600 text-green-300 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full text-gray-300 border border-gray-700 rounded-xl">
            <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Buku</th>
                    <th class="px-4 py-2">Tanggal Pinjam</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowings as $borrow)
                    <tr class="hover:bg-gray-700/50 transition">
                        <td class="px-4 py-2">{{ $borrow->user->name }}</td>
                        <td class="px-4 py-2">{{ $borrow->book->title }}</td>
                        <td class="px-4 py-2">{{ $borrow->borrow_date_formatted }}</td>
                        <td class="px-4 py-2 capitalize">{{ $borrow->status }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            @if ($borrow->status === 'pending')
                                <form action="{{ route('admin.borrowings.approve', $borrow->id) }}" method="POST" class="inline-block">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">Approve</button>
                                </form>
                                <form action="{{ route('admin.borrowings.reject', $borrow->id) }}" method="POST" class="inline-block">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Reject</button>
                                </form>
                            @elseif ($borrow->status === 'approved')
                                <form action="{{ route('admin.borrowings.returned', $borrow->id) }}" method="POST" class="inline-block">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm">Returned</button>
                                </form>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
