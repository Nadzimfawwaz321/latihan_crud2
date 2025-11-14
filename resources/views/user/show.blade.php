<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $produk->nama }} | Dlogok Prestige</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --gold: #d4af37;
      --gold-soft: #e7c766;
      --black: #0d0d0d;
      --dark: #151515;
    }

    body {
      background: linear-gradient(135deg, #0c0c0c, #1a1a1a);
      font-family: 'Poppins', sans-serif;
      color: white;
    }

    .title {
      color: var(--gold);
      font-weight: 700;
    }

    .price {
      color: var(--gold-soft);
      font-size: 1.8rem;
      font-weight: 700;
    }

    .btn-gold {
      background: var(--gold);
      color: #000;
      border-radius: 25px;
      padding: 10px 25px;
      font-weight: 600;
      border: none;
      transition: 0.3s;
    }

    .btn-gold:hover {
      background: var(--gold-soft);
      transform: scale(1.05);
      box-shadow: 0 0 12px rgba(212, 175, 55, 0.6);
    }

    .btn-outline-light-custom {
      border-radius: 25px;
      padding: 10px 25px;
      color: var(--gold);
      border: 1px solid var(--gold);
      transition: 0.3s;
    }

    .btn-outline-light-custom:hover {
      background: var(--gold);
      color: #000;
      transform: scale(1.05);
    }

    .desc-box {
      background: var(--dark);
      padding: 20px;
      border-radius: 12px;
      border: 1px solid rgba(212, 175, 55, 0.2);
    }

    img {
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(212, 175, 55, 0.15);
    }
  </style>
</head>

<body>

  <div class="container py-5">
    <div class="row justify-content-center align-items-start">

      <!-- FOTO MOBIL -->
      <div class="col-md-5 mb-4">
        @if($produk->foto)
          <img src="{{ asset('uploads/' . $produk->foto) }}" class="img-fluid">
        @else
          <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid">
        @endif
      </div>

      <!-- DETAIL PRODUK -->
      <div class="col-md-6">
        <h2 class="title mb-3">{{ $produk->nama }}</h2>

        <div class="desc-box mb-3">
          <p class="mb-0">{{ $produk->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>
        </div>

        <h4 class="price mb-4">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h4>

        {{-- Pesan sukses/error --}}
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="d-flex gap-3">
          <a href="{{ route('user.produk.index') }}" class="btn-outline-light-custom">← Kembali</a>

          <form action="{{ route('cart.add', $produk->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-gold">Tambah ke Keranjang</button>
          </form>
        </div>
      </div>

    </div>
  </div>

</body>

</html>