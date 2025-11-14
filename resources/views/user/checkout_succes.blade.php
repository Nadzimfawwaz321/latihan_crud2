<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pembayaran Berhasil | Dlogok Prestige</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
      color: #f0f0f0;
    }

    h2,
    h5,
    h6 {
      color: #d4af37 !important;
    }

    .text-muted {
      color: #bbbbbb !important;
    }

    .card {
      background: #111;
      border-radius: 12px;
      border: 1px solid #333;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
      color: #f5f5f5;
    }

    .list-group-item {
      background: #1a1a1a;
      color: #eee;
      border: 1px solid #333;
    }

    .btn-prestige {
      background: #d4af37;
      color: #0d0d0d !important;
      border: none;
      border-radius: 25px;
      padding: 8px 22px;
      transition: .3s;
    }

    .btn-prestige:hover {
      background: #b8922c;
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
    }
  </style>
</head>

<body>

  <div class="container py-5">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Terima kasih!</h2>
      <p class="text-muted">Pesanan kamu telah berhasil diproses oleh <strong>Dlogok Prestige</strong>.</p>
    </div>

    <div class="card p-4 mb-4">
      <h5 class="mb-3">Ringkasan Pesanan — #{{ $order->id }}</h5>

      <div class="row">
        <div class="col-md-6">
          <p><strong>Nama:</strong> {{ $order->nama }}</p>
          <p><strong>Email:</strong> {{ $order->email ?? '-' }}</p>
          <p><strong>No HP:</strong> {{ $order->no_hp ?? '-' }}</p>
        </div>
        <div class="col-md-6">
          <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
          <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
        </div>
      </div>

      <hr style="border-color:#444">

      <h6>Items</h6>
      <ul class="list-group mb-3">
        @foreach($order->items as $it)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <div class="fw-semibold">{{ $it->nama_produk }}</div>
              <small class="text-muted">Rp {{ number_format($it->harga, 0, ',', '.') }} × {{ $it->qty }}</small>
            </div>
            <div class="fw-bold text-prestige">Rp {{ number_format($it->subtotal, 0, ',', '.') }}</div>
          </li>
        @endforeach
      </ul>

      <div class="text-end">
        <a href="{{ route('user.produk.index') }}" class="btn btn-prestige">Kembali Belanja</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>