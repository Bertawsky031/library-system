<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            ➕ {{ __('Tambah Buku') }}
        </h2>
    </x-slot>

    <div class="p-8 bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto bg-gray-800 rounded-xl shadow-lg p-8 border border-gray-700">
            
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-600/20 border border-red-500 text-red-300 rounded-lg">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.books.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-gray-300 font-medium">Judul Buku</label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title') }}" 
                           class="mt-1 w-full rounded-lg bg-gray-700 border border-gray-600 text-gray-100 p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label for="author" class="block text-gray-300 font-medium">Penulis</label>
                    <input type="text" name="author" id="author" 
                           value="{{ old('author') }}" 
                           class="mt-1 w-full rounded-lg bg-gray-700 border border-gray-600 text-gray-100 p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="stock" class="block text-gray-300 font-medium">Stok</label>
                        <input type="number" name="stock" id="stock" 
                               value="{{ old('stock', 1) }}" 
                               class="mt-1 w-full rounded-lg bg-gray-700 border border-gray-600 text-gray-100 p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-gray-300 font-medium">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 w-full rounded-lg bg-gray-700 border border-gray-600 text-gray-100 p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('admin.books.index') }}" 
                       class="px-4 py-2 rounded-lg bg-gray-600 hover:bg-gray-700 text-gray-200 transition">Kembali</a>
                    <button type="submit" 
                            class="px-6 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow transition">
                        Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
