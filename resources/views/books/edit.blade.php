<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-semibold text-slate-900 tracking-tight">
                    Edit Buku
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Perbarui data dan informasi untuk buku "{{ $book->judul }}"
                </p>
            </div>
            <x-button href="{{ route('books.index') }}" variant="secondary" class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali</span>
            </x-button>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <x-card class="p-6 sm:p-8">
            <form method="POST" action="{{ route('books.update', $book) }}" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Judul Buku --}}
                <div>
                    <x-input-label for="judul" :value="__('Judul Buku')" />
                    <x-text-input id="judul" 
                                  name="judul" 
                                  type="text" 
                                  class="mt-1.5 block w-full" 
                                  :value="old('judul', $book->judul)" 
                                  required 
                                  autofocus />
                    <x-input-error class="mt-1.5" :messages="$errors->get('judul')" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Penulis --}}
                    <div>
                        <x-input-label for="penulis" :value="__('Penulis')" />
                        <x-text-input id="penulis" 
                                      name="penulis" 
                                      type="text" 
                                      class="mt-1.5 block w-full" 
                                      :value="old('penulis', $book->penulis)" 
                                      required />
                        <x-input-error class="mt-1.5" :messages="$errors->get('penulis')" />
                    </div>

                    {{-- Penerbit --}}
                    <div>
                        <x-input-label for="penerbit" :value="__('Penerbit')" />
                        <x-text-input id="penerbit" 
                                      name="penerbit" 
                                      type="text" 
                                      class="mt-1.5 block w-full" 
                                      :value="old('penerbit', $book->penerbit)" 
                                      required />
                        <x-input-error class="mt-1.5" :messages="$errors->get('penerbit')" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    {{-- Tahun Terbit --}}
                    <div>
                        <x-input-label for="tahun_terbit" :value="__('Tahun Terbit')" />
                        <x-text-input id="tahun_terbit" 
                                      name="tahun_terbit" 
                                      type="number" 
                                      min="1900" 
                                      max="{{ date('Y') + 1 }}" 
                                      class="mt-1.5 block w-full" 
                                      :value="old('tahun_terbit', $book->tahun_terbit)" 
                                      required />
                        <x-input-error class="mt-1.5" :messages="$errors->get('tahun_terbit')" />
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <x-input-label for="kategori" :value="__('Kategori')" />
                        <x-text-input id="kategori" 
                                      name="kategori" 
                                      type="text" 
                                      class="mt-1.5 block w-full" 
                                      :value="old('kategori', $book->kategori)" 
                                      required />
                        <x-input-error class="mt-1.5" :messages="$errors->get('kategori')" />
                    </div>

                    {{-- Stok --}}
                    <div>
                        <x-input-label for="stok" :value="__('Stok (Eksemplar)')" />
                        <x-text-input id="stok" 
                                      name="stok" 
                                      type="number" 
                                      min="0" 
                                      class="mt-1.5 block w-full" 
                                      :value="old('stok', $book->stok)" 
                                      required />
                        <x-input-error class="mt-1.5" :messages="$errors->get('stok')" />
                    </div>
                </div>

                {{-- ISBN --}}
                <div>
                    <x-input-label for="isbn" :value="__('Nomor ISBN')" />
                    <x-text-input id="isbn" 
                                  name="isbn" 
                                  type="text" 
                                  class="mt-1.5 block w-full font-mono text-sm" 
                                  :value="old('isbn', $book->isbn)" 
                                  required />
                    <x-input-error class="mt-1.5" :messages="$errors->get('isbn')" />
                </div>

                {{-- Deskripsi --}}
                <div>
                    <x-input-label for="deskripsi" :value="__('Deskripsi / Sinopsis (Opsional)')" />
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="3" 
                              class="mt-1.5 block w-full text-sm border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                    <x-input-error class="mt-1.5" :messages="$errors->get('deskripsi')" />
                </div>

                {{-- Tombol Aksi Bawah Kanan --}}
                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                    <x-button href="{{ route('books.index') }}" variant="secondary">
                        Batal
                    </x-button>
                    <x-button type="submit" variant="primary">
                        Simpan Perubahan
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
