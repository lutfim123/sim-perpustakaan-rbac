<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Tambah Buku Baru') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Isi formulir berikut untuk mendaftarkan koleksi buku baru ke katalog perpustakaan
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

                <form method="POST" action="{{ route('books.store') }}" class="space-y-6">
                    @csrf

                    {{-- Judul Buku --}}
                    <div>
                        <x-input-label for="judul" :value="__('Judul Buku *')" />
                        <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" :value="old('judul')" required autofocus placeholder="Contoh: Pemrograman Web Lanjut dengan Laravel" />
                        <x-input-error class="mt-2" :messages="$errors->get('judul')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Penulis --}}
                        <div>
                            <x-input-label for="penulis" :value="__('Nama Penulis / Pengarang *')" />
                            <x-text-input id="penulis" name="penulis" type="text" class="mt-1 block w-full" :value="old('penulis')" required placeholder="Contoh: Dr. Dosen Pengajar, M.Kom." />
                            <x-input-error class="mt-2" :messages="$errors->get('penulis')" />
                        </div>

                        {{-- Penerbit --}}
                        <div>
                            <x-input-label for="penerbit" :value="__('Penerbit *')" />
                            <x-text-input id="penerbit" name="penerbit" type="text" class="mt-1 block w-full" :value="old('penerbit')" required placeholder="Contoh: Informatika Press" />
                            <x-input-error class="mt-2" :messages="$errors->get('penerbit')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Tahun Terbit --}}
                        <div>
                            <x-input-label for="tahun_terbit" :value="__('Tahun Terbit *')" />
                            <x-text-input id="tahun_terbit" name="tahun_terbit" type="number" min="1900" max="{{ date('Y') + 1 }}" class="mt-1 block w-full" :value="old('tahun_terbit', date('Y'))" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tahun_terbit')" />
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <x-input-label for="kategori" :value="__('Kategori *')" />
                            <x-text-input id="kategori" name="kategori" type="text" class="mt-1 block w-full" :value="old('kategori')" required placeholder="Contoh: Pemrograman" />
                            <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                        </div>

                        {{-- Stok --}}
                        <div>
                            <x-input-label for="stok" :value="__('Jumlah Stok (Eksemplar) *')" />
                            <x-text-input id="stok" name="stok" type="number" min="0" class="mt-1 block w-full" :value="old('stok', 1)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stok')" />
                        </div>
                    </div>

                    {{-- ISBN --}}
                    <div>
                        <x-input-label for="isbn" :value="__('Nomor ISBN (Unik) *')" />
                        <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full font-mono" :value="old('isbn')" required placeholder="Contoh: 978-602-1234-56-1" />
                        <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                    </div>

                    {{-- Deskripsi / Sinopsis --}}
                    <div>
                        <x-input-label for="deskripsi" :value="__('Deskripsi / Sinopsis Ringkas')" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" 
                                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" 
                                  placeholder="Tuliskan rangkuman isi buku, topik bahasan, atau target pembaca...">{{ old('deskripsi') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('books.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                            Simpan Buku ke Database
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

