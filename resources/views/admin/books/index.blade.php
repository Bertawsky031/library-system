<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            📚 {{ __('Kelola Buku') }}
        </h2>
    </x-slot>

    <div class="p-8 bg-gray-900 min-h-screen">
        <!-- Header & Search -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-3 sm:space-y-0">
            <a href="{{ route('admin.books.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                + Tambah Buku
            </a>

            <!-- Search bar -->
            <div class="relative w-full sm:w-1/3">
                <input type="text" id="searchInput"
                    class="w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="🔍 Cari buku berdasarkan judul atau penulis...">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-3 top-2.5 h-5 w-5 text-gray-400 pointer-events-none" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M16.65 10.65A6 6 0 1110.65 4a6 6 0 016 6.65z" />
                </svg>
            </div>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-600/20 border border-green-500 text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border border-gray-700 shadow-lg bg-gray-800">
            <table id="bookTable" class="min-w-full text-sm text-gray-300">
                <thead class="bg-gray-700/80 text-gray-100 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-center">No</th>
                        <th class="px-6 py-3 text-left">Judul</th>
                        <th class="px-6 py-3 text-left">Penulis</th>
                        <th class="px-6 py-3 text-center">Stok</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="bookBody" class="divide-y divide-gray-700">
                    @forelse ($books as $index => $book)
                        <tr class="hover:bg-gray-700/60 transition">
                            <td class="px-6 py-3 text-center text-gray-300">{{ $index + 1 }}</td>
                            <td class="px-6 py-3 font-medium text-gray-100">{{ $book->title }}</td>
                            <td class="px-6 py-3">{{ $book->author ?? '-' }}</td>
                            <td class="px-6 py-3 text-center">{{ $book->stock }}</td>
                            <td class="px-6 py-3 text-center space-x-2">
                                <a href="{{ route('admin.books.edit', $book->id) }}"
                                   class="inline-block px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs rounded transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-400">Tidak ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
                <div class="mt-6">
    {{ $borrowings->links('vendor.pagination.tailwind') }}
</div>
            </table>
        </div>
    </div>

    <!-- 🔍 Real-Time Search Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.getElementById('bookBody');
            const rows = tableBody.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function () {
                const keyword = this.value.toLowerCase();
                let visibleCount = 0;

                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    if (cells.length < 2) continue;

                    const title = cells[1].textContent.toLowerCase();
                    const author = cells[2].textContent.toLowerCase();

                    if (title.includes(keyword) || author.includes(keyword)) {
                        rows[i].style.display = '';
                        visibleCount++;
                        cells[0].textContent = visibleCount; // nomor urut dinamis
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            });
        });
    </script>
</x-app-layout>
