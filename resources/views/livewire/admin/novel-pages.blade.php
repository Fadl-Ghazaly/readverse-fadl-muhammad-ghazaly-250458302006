<div>
    <h1>Daftar Halaman Novel (Novel Pages)</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <select wire:model="episode_id">
            <option value="">-- Pilih Episode --</option>
            @foreach($episodes as $ep)
                <option value="{{ $ep->id }}">{{ $ep->novel->title }} - {{ $ep->title }}</option>
            @endforeach
        </select>

        <input type="number" wire:model="page_number" placeholder="Nomor Halaman">
        <textarea wire:model="caption" placeholder="Caption"></textarea>
        <input type="file" wire:model="image">
        <input type="file" wire:model="file">
        <select wire:model="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <button type="submit">Simpan</button>
    </form>

    <hr>

    <table>
        <thead>
            <tr>
                <th>Episode</th>
                <th>Novel</th>
                <th>No Halaman</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($novelPages as $page)
                <tr>
                    <td>{{ $page->episode->title }}</td>
                    <td>{{ $page->episode->novel->title }}</td>
                    <td>{{ $page->page_number }}</td>
                    <td>{{ $page->status }}</td>
                    <td>
                        <button wire:click="edit({{ $page->id }})">Edit</button>
                        <button wire:click="delete({{ $page->id }})">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
