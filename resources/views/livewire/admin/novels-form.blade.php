<div class="card mb-4">
    <div class="card-body">

        <h5 class="card-title">Tambah Novel Baru</h5>

        <form wire:submit.prevent="store" enctype="multipart/form-data">

            {{-- Judul --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" wire:model="title">
                    @error('title') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" wire:model="description" rows="4"></textarea>
                    @error('description') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            {{-- Genre --}}
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">Genre</label>
    <div class="col-sm-10">
        <div class="d-flex flex-wrap gap-2">
            @foreach($allGenres as $genre)
                <div class="form-check form-check-inline">
                    <input type="checkbox"
                           id="genre_{{ $genre->id }}"
                           wire:model="selectedGenres"
                           value="{{ $genre->id }}"
                           class="form-check-input">
                    <label for="genre_{{ $genre->id }}" class="form-check-label">{{ $genre->nama }}</label>
                </div>
            @endforeach
        </div>
        @error('selectedGenres') 
            <span class="text-danger">{{ $message }}</span> 
        @enderror
    </div>
</div>

            {{-- Cover Image --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Cover Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" wire:model="cover_image">
                    @error('cover_image') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            {{-- Penulis --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Penulis</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" wire:model="author">
                    @error('author') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            {{-- Status --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-select" wire:model="status">
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                    @error('status') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>

        </form>
    </div>
</div>
