<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .table thead {
      background-color: #b00020;
      color: #fff;
    }
    .btn-custom {
      border-radius: 30px;
      transition: 0.3s;
    }
    .btn-custom:hover {
      transform: scale(1.07);
      box-shadow: 0 0 10px rgba(176, 0, 32, 0.5);
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      animation: fadeUp 0.6s ease-in-out;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-danger fw-bold m-0">Daftar Produk</h2>
      <a href="{{ route('produk.create') }}" class="btn btn-danger btn-custom px-4">+ Tambah Produk</a>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Tabel Produk --}}
    <div class="table-responsive">
      <table class="table align-middle text-center">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th style="width: 150px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data as $i => $item)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td>{{ $item->deskripsi ?? '-' }}</td>
            <td>
              @if($item->foto)
                <img src="{{ asset('uploads/'.$item->foto) }}" width="70" class="rounded shadow-sm">
              @else
                <span class="text-muted">Tidak ada foto</span>
              @endif
            </td>
            <td>
              <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm btn-custom">Edit</a>
              <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm btn-custom" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-muted text-center py-3">Belum ada data produk.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
