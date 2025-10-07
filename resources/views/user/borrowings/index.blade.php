<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100">📖 Daftar Buku</h2>
    </x-slot>

    <div class="p-8 bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto space-y-6">
            @if (session('success'))
                <div class="p-4 bg-green-700/20 border border-green-600 text-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 bg-red-700/20 border border-red-600 text-red-300 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <table class="min-w-full text-gray-300 border border-gray-700 rounded-xl">
                <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2 text-left">Judul</th>
                        <th class="px-4 py-2 text-left">Penulis</th>
                        <th class="px-4 py-2 text-center">Stok</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="hover:bg-gray-700/50 transition">
                            <td class="px-4 py-2">{{ $book->title }}</td>
                            <td class="px-4 py-2">{{ $book->author ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">{{ $book->stock }}</td>
                            <td class="px-4 py-2 text-center">
                                @if ($book->stock > 0)
                                    <form action="{{ route('user.borrowings.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">
                                            Pinjam
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500 text-sm">Stok habis</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="mt-6">
    {{ $borrowings->links('vendor.pagination.tailwind') }}
</div>
            </table>
        </div>
    </div>
</x-app-layout>
