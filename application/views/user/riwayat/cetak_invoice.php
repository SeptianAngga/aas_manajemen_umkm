<!DOCTYPE html>
<html>
<head>
  <title>Invoice</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
      padding: 6px;
    }
    th {
      background: #f2f2f2;
    }
  </style>
</head>
<body>
  <h2>INVOICE PESANAN</h2>
  <p><strong>ID Pesanan:</strong> <?= $pesanan->id ?></p>
  <p><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($pesanan->created_at)) ?></p>

  <table>
    <thead>
      <tr>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php $total = 0; foreach ($detail as $d): 
        $subtotal = $d->harga * $d->jumlah;
        $total += $subtotal;
      ?>
      <tr>
        <td><?= $d->nama_produk ?></td>
        <td>Rp<?= number_format($d->harga, 0, ',', '.') ?></td>
        <td><?= $d->jumlah ?></td>
        <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th colspan="3">Total</th>
        <th><strong>Rp<?= number_format($total, 0, ',', '.') ?></strong></th>
      </tr>
    </tbody>
  </table>
</body>
</html>
