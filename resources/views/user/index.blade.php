<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Katalog Mobil | Dlogok Prestige</title>
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
    }

    /* NAVBAR */
    .navbar {
      background: var(--black);
      border-bottom: 1px solid rgba(212, 175, 55, 0.3);
      box-shadow: 0 2px 15px rgba(0, 0, 0, .6);
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 1.4rem;
      color: var(--gold) !important;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .btn-light {
      background: var(--gold);
      border: none;
      color: #000;
      font-weight: 600;
      border-radius: 30px;
    }

    /* CARD MOBIL */
    .card {
      background: var(--dark);
      border-radius: 18px;
      overflow: hidden;
      border: 1px solid rgba(212, 175, 55, 0.25);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
      transition: all 0.4s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 28px rgba(212, 175, 55, 0.25);
    }

    .card img {
      height: 220px;
      object-fit: cover;
      transition: 0.4s;
      filter: brightness(0.9);
    }

    .card:hover img {
      transform: scale(1.05);
      filter: brightness(1.05);
    }

    .card-title {
      color: var(--gold);
      font-weight: 600;
    }

    .btn-gold {
      background: var(--gold);
      color: black;
      border-radius: 25px;
      font-weight: 600;
      transition: 0.3s;
      border: none;
    }

    .btn-gold:hover {
      background: var(--gold-soft);
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(212, 175, 55, 0.6);
    }

    /* FOOTER */
    footer {
      margin-top: 60px;
      background: var(--black);
      color: var(--gold);
      padding: 25px 0;
      text-align: center;
      font-size: 14px;
      border-top: 1px solid rgba(212, 175, 55, 0.3);
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container d-flex justify-content-between">
      <a class="navbar-brand" href="{{ route('user.produk.index') }}">Dlogok Prestige</a>
      <a href="{{ route('cart.index') }}" class="btn btn-light px-4">Keranjang</a>
    </div>
  </nav>

  <div class="container py-5">
    <h2 class="fw-bold text-center mb-5" style="color: var(--gold); letter-spacing:1px;">Katalog Mobil Premium</h2>

    <div class="row">
      @forelse($data as $item)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
          <div class="card h-100 text-center">

            @if($item->foto)
              <img src="{{ asset('uploads/' . $item->foto) }}" class="card-img-top">
            @else
              <img src="https://via.placeholder.com/250x220?text=No+Image" class="card-img-top">
            @endif

            <div class="card-body">
              <h5 class="card-title">{{ $item->nama }}</h5>
              <p class="text-light mb-3">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
              <a href="{{ route('user.produk.show', $item->id) }}" class="btn btn-gold px-4">Lihat Detail</a>
            </div>

          </div>
        </div>
      @empty
        <div class="col-12 text-center text-light">Belum ada mobil tersedia.</div>
      @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4 text-light">
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>

  <footer>
    <p>© {{ date('Y') }} Dlogok Prestige | Premium Auto Gallery</p>
  </footer>

</body>

</html>