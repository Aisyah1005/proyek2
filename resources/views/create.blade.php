<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nama Produk</label>
    <input type="text" name="name" class="form-control" required>

    <label>Kategori</label>
    <select name="category" class="form-control">
        <option value="favorite">Favorit</option>
        <option value="monthly">Bulan Ini</option>
        <option value="new">Terbaru</option>
    </select>

    <label>Harga</label>
    <input type="number" name="price" class="form-control" required>

    <label>Deskripsi</label>
    <textarea name="description" class="form-control"></textarea>

    <label>Gambar</label>
    <input type="file" name="image" class="form-control" required>

    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>
