<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Edit Data Buku') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi buku "{{ $book->judul }}"
                </p>
            </div>
            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                &larr; Kembali ke Katalog
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">

                <form method="POST" action="{{ route('books.update', $book) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Judul Buku --}}
                    <div>
                        <x-input-label for="judul" :value="__('Judul Buku *')" />
                        <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" :value="old('judul', $book->judul)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('judul')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Penulis --}}
                        <div>
                            <x-input-label for="penulis" :value="__('Nama Penulis / Pengarang *')" />
                            <x-text-input id="penulis" name="penulis" type="text" class="mt-1 block w-full" :value="old('penulis', $book->penulis)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('penulis')" />
                        </div>

                        {{-- Penerbit --}}
                        <div>
                            <x-input-label for="penerbit" :value="__('Penerbit *')" />
                            <x-text-input id="penerbit" name="penerbit" type="text" class="mt-1 block w-full" :value="old('penerbit', $book->penerbit)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('penerbit')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Tahun Terbit --}}
                        <div>
                            <x-input-label for="tahun_terbit" :value="__('Tahun Terbit *')" />
                            <x-text-input id="tahun_terbit" name="tahun_terbit" type="number" min="1900" max="{{ date('Y') + 1 }}" class="mt-1 block w-full" :value="old('tahun_terbit', $book->tahun_terbit)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tahun_terbit')" />
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <x-input-label for="kategori" :value="__('Kategori *')" />
                            <x-text-input id="kategori" name="kategori" type="text" class="mt-1 block w-full" :value="old('kategori', $book->kategori)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                        </div>

                        {{-- Stok --}}
                        <div>
                            <x-input-label for="stok" :value="__('Jumlah Stok (Eksemplar) *')" />
                            <x-text-input id="stok" name="stok" type="number" min="0" class="mt-1 block w-full" :value="old('stok', $book->stok)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stok')" />
                        </div>
                    </div>

                    {{-- ISBN --}}
                    <div>
                        <x-input-label for="isbn" :value="__('Nomor ISBN *')" />
                        <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full font-mono" :value="old('isbn', $book->isbn)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                    </div>

                    {{-- Deskripsi / Sinopsis --}}
                    <div>
                        <x-input-label for="deskripsi" :value="__('Deskripsi / Sinopsis Ringkas')" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" 
                                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('books.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

