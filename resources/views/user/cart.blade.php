<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Keranjang | Dlogok Prestige</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
      font-family: 'Poppins', sans-serif;
      color: #f5f5f5;
    }

    h2 {
      color: #d4af37 !important;
    }

    .card {
      background: #111;
      border: 1px solid #333;
      border-radius: 14px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
    }

    table tbody tr td {
      color: #e6e6e6 !important;
    }

    thead {
      background: #d4af37 !important;
      color: #0d0d0d !important;
    }

    .btn-prestige {
      background: #d4af37;
      border: none;
      color: #0d0d0d !important;
      border-radius: 25px;
      transition: 0.3s;
    }

    .btn-prestige:hover {
      background: #b8922c;
      transform: scale(1.05);
      box-shadow: 0 0 12px rgba(212, 175, 55, 0.6);
    }

    .btn-outline-prestige {
      border: 1px solid #d4af37;
      color: #d4af37 !important;
      border-radius: 25px;
    }

    .btn-outline-prestige:hover {
      background: #d4af37;
      color: #0d0d0d !important;
    }
  </style>
</head>

<body>

  <div class="container py-5">
    <h2 class="fw-bold text-center mb-4">Keranjang Belanja - Dlogok Prestige</h2>

    @if(session('success'))
      <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if(empty($cart))
      <div class="text-center text-muted mt-5">
        <p>Keranjang masih kosong.</p>
        <a href="{{ route('user.produk.index') }}" class="btn btn-prestige mt-2">Kembali Belanja</a>
      </div>
    @else
      <div class="card p-4">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="text-center">
              <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="align-middle">
              @foreach($cart as $id => $item)
                <tr>
                  <td class="text-center">
                    @if($item['foto'])
                      <img src="{{ asset('uploads/' . $item['foto']) }}" width="60" class="rounded">
                    @else
                      <img src="https://via.placeholder.com/60x60" alt="no image" class="rounded">
                    @endif
                  </td>
                  <td>{{ $item['nama'] }}</td>
                  <td class="text-center">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                  <td class="text-center">{{ $item['qty'] }}</td>
                  <td class="text-center">Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</td>
                  <td class="text-center">
                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                      @csrf
                      <button class="btn btn-sm btn-outline-prestige px-3">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
          <div>
            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-outline-prestige">Kosongkan</button>
            </form>
          </div>
          <h5 class="fw-bold text-end mb-0">Total: Rp {{ number_format($total, 0, ',', '.') }}</h5>
        </div>

        <div class="text-end mt-4">
          <a href="{{ route('user.produk.index') }}" class="btn btn-outline-prestige me-2">← Lanjut Belanja</a>
          <a href="{{ route('checkout.index') }}" class="btn btn-prestige px-4">Checkout</a>
        </div>
      </div>
    @endif
  </div>

</body>

</html>