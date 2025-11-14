<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Produk | Dlogok Prestige</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --gold: #d4af37;
      --gold-soft: #e7c766;
      --dark: #0f0f0f;
      --card-bg: #1a1a1a;
    }

    body {
      background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
      font-family: "Poppins", sans-serif;
      color: #fff;
    }

    .title {
      color: var(--gold);
      font-weight: 700;
    }

    .card-custom {
      background: var(--card-bg);
      border-radius: 14px;
      border: 1px solid rgba(212, 175, 55, 0.25);
      box-shadow: 0 6px 20px rgba(212, 175, 55, 0.12);
    }

    label {
      font-weight: 600;
      color: var(--gold-soft);
    }

    .form-control,
    .form-control:focus {
      background: #111;
      border: 1px solid #333;
      color: #fff;
    }

    .btn-gold {
      background: var(--gold);
      color: #000;
      font-weight: 600;
      border-radius: 25px;
      padding: 8px 25px;
      border: none;
      transition: 0.3s;
    }

    .btn-gold:hover {
      background: var(--gold-soft);
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(212, 175, 55, .6);
    }

    .btn-outline-gold {
      color: var(--gold);
      border: 1px solid var(--gold);
      border-radius: 25px;
      padding: 8px 25px;
      transition: 0.3s;
    }

    .btn-outline-gold:hover {
      background: var(--gold);
      color: #000;
      transform: scale(1.05);
    }
  </style>
</head>

<body>

  <div class="container py-5">
    <div class="card card-custom p-4 mx-auto" style="max-width: 650px;">

      <h2 class="text-center title mb-4">Tambah Produk</h2>

      {{-- Pesan Error --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Form Tambah --}}
      <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-5">
          <label>Nama Produk</label>
          <input type="text" name="nama" class="form-control" placeholder="Masukkan nama produk" required>
        </div>

        <div class="mb-5">
          <label>Harga (Rp)</label>
          <input type="number" name="harga" class="form-control" placeholder="Masukkan harga" required>
        </div>

        <div class="mb-5">
          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3" placeholder="Tulis deskripsi produk"></textarea>
        </div>

        <div class="mb-5">
          <label>Foto Produk</label>
          <input type="file" name="foto" class="form-control">
        </div>

        <div class="text-end">
          <button type="submit" class="btn-gold">Simpan</button>
          <a href="{{ route('produk.index') }}" class="btn-outline-gold ms-2">Kembali</a>
        </div>

      </form>
    </div>
  </div>

</body>

</html>