<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container py-4">
    <h2 class="text-danger fw-bold mb-4">Edit Produk</h2>
    <form action="{{ route('produk.update', $item->id) }}" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
      </div>
      <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $item->harga }}" required>
      </div>
      <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $item->deskripsi }}</textarea>
      </div>
      <div class="mb-3">
        <label>Foto</label><br>
        @if($item->foto)
          <img src="{{ asset('uploads/' . $item->foto) }}" width="90" class="mb-2">
        @endif
        <input type="file" name="foto" class="form-control">
      </div>
      <button class="btn btn-danger">Update</button>
      <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>

</html>