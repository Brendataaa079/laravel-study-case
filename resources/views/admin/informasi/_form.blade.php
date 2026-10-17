@csrf
<div class="field">
    <label for="judul">Judul</label>
    <input id="judul" type="text" name="judul" value="{{ old('judul', $informasi->judul) }}">
    @error('judul') <small class="err">{{ $message }}</small> @enderror
</div>

<div class="field">
    <label for="kategori">Kategori</label>
    <select id="kategori" name="kategori">
        <option value="">-- Pilih kategori --</option>
        @foreach (\App\Models\Informasi::KATEGORI as $k)
            <option value="{{ $k }}" @selected(old('kategori', $informasi->kategori) === $k)>{{ $k }}</option>
        @endforeach
    </select>
    @error('kategori') <small class="err">{{ $message }}</small> @enderror
</div>

<div class="field">
    <label for="isi">Isi informasi</label>
    <textarea id="isi" name="isi">{{ old('isi', $informasi->isi) }}</textarea>
    @error('isi') <small class="err">{{ $message }}</small> @enderror
</div>

<div class="field">
    <label for="tanggal_publikasi">Tanggal publikasi</label>
    <input id="tanggal_publikasi" type="date" name="tanggal_publikasi"
           value="{{ old('tanggal_publikasi', $informasi->tanggal_publikasi?->format('Y-m-d')) }}">
    @error('tanggal_publikasi') <small class="err">{{ $message }}</small> @enderror
</div>

<div class="field">
    <label for="status">Status</label>
    <select id="status" name="status">
        @foreach (\App\Models\Informasi::STATUS as $s)
            <option value="{{ $s }}" @selected(old('status', $informasi->status) === $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    @error('status') <small class="err">{{ $message }}</small> @enderror
</div>

<div class="form-actions">
    <button type="submit" class="btn">Simpan</button>
    <a href="{{ route('admin.informasi.index') }}" class="btn ghost">Batal</a>
</div>