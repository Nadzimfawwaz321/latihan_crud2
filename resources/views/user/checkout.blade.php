<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Checkout | Dlogok Prestige</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
      font-family: 'Poppins', sans-serif;
      color: #f0f0f0;
    }

    h5 {
      color: #d4af37 !important;
    }

    .card {
      background: #111;
      border-radius: 12px;
      border: 1px solid #333;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
      color: #f5f5f5;
    }

    .form-label {
      color: #d4af37;
    }

    .form-control,
    textarea {
      background: #1a1a1a !important;
      border: 1px solid #444;
      color: #fff !important;
    }

    .form-control:focus {
      border-color: #d4af37;
      box-shadow: 0 0 8px rgba(212, 175, 55, 0.5);
    }

    .list-group-item {
      background: #1a1a1a;
      border: 1px solid #333;
      color: #eee;
    }

    .btn-prestige {
      background: #d4af37;
      color: #0d0d0d !important;
      border: none;
      border-radius: 10px;
      transition: .3s;
    }

    .btn-prestige:hover {
      background: #b8922c;
      transform: scale(1.05);
      box-shadow: 0 0 12px rgba(212, 175, 55, 0.5);
    }

    .btn-outline-prestige {
      border: 1px solid #d4af37;
      color: #d4af37 !important;
      border-radius: 10px;
    }

    .btn-outline-prestige:hover {
      background: #d4af37;
      color: #0d0d0d !important;
    }

    .text-muted {
      color: #bbb !important;
    }
  </style>
</head>

<body>

  <div class="container py-5">
    <div class="row g-4">

      <!-- FORM CHECKOUT -->
      <div class="col-md-6">
        <div class="card p-4">
          <h5 class="mb-3 fw-bold">Form Checkout</h5>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email (opsional)</label>
              <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
              <label class="form-label">No. HP / WhatsApp</label>
              <input type="text" name="no_hp" class="form-control">
            </div>

            <div class="mb-3">
              <label class="form-label">Alamat Lengkap</label>
              <textarea name="alamat" rows="4" class="form-control" required></textarea>
            </div>

            <div class="d-flex justify-content-between">
              <a href="{{ route('cart.index') }}" class="btn btn-outline-prestige">Kembali</a>
              <button type="submit" class="btn btn-prestige">Bayar & Checkout</button>
            </div>

          </form>
        </div>
      </div>

      <!-- RINGKASAN PESANAN -->
      <div class="col-md-6">
        <div class="card p-4">
          <h5 class="mb-3 fw-bold">Ringkasan Pesanan</h5>

          <ul class="list-group mb-3">
            @foreach($cart as $id => $item)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <div class="fw-semibold">{{ $item['nama'] }}</div>
                  <small class="text-muted">Rp {{ number_format($item['harga'], 0, ',', '.') }} × {{ $item['qty'] }}</small>
                </div>
                <div class="fw-bold">Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</div>
              </li>
            @endforeach
          </ul>

          <div class="d-flex justify-content-between">
            <div class="text-muted">Total</div>
            <div class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</div>
          </div>

        </div>
      </div>

    </div>
  </div>

</body>

</html>