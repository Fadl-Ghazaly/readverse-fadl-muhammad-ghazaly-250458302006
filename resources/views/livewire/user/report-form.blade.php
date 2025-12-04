<div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        
        @if (session()->has('message'))
            <div class="bg-green-50 border-b border-green-100 px-4 py-3 text-sm text-green-700 flex items-center gap-2 animate-fade-in-down">
                <i class="bi bi-check-circle-fill text-green-500"></i>
                {{ session('message') }}
                <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @endif

        <div class="p-6">
            <h5 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill text-red-500"></i>
                Laporkan {{ ucfirst($targetType) }}
            </h5>

            <form wire:submit.prevent="submit">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori Laporan</label>
                        <select wire:model="kategori" 
                                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm transition-colors">
                            <option value="">-- Pilih Kategori --</option>
                            <option>Pelanggaran Aturan</option>
                            <option>Konten Tidak Pantas</option>
                            <option>Spam</option>
                            <option>Lainnya</option>
                        </select>
                        @error('kategori') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Detail</label>
                        <textarea wire:model="deskripsi" 
                                  rows="3" 
                                  class="w-full rounded-lg border-slate-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm transition-colors"
                                  placeholder="Jelaskan alasan laporan Anda..."></textarea>
                        @error('deskripsi') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                            <i class="bi bi-flag-fill mr-2"></i>
                            Kirim Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
