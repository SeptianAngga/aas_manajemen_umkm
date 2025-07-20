<div class="content-wrapper">
  <section class="content-header">
    <h1>Detail Produk</h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-body">
        <h3><?= $produk->nama_produk ?></h3>

        <p><strong>Harga:</strong> Rp<?= number_format($produk->harga, 0, ',', '.') ?></p>
        <p><strong>Deskripsi:</strong> <?= $produk->deskripsi ?></p>
        <p><strong>Kategori:</strong>
          <?php foreach ($kategori as $k): ?>
            <span class="label label-primary"><?= $k->nama_kategori ?></span>
          <?php endforeach; ?>
        </p>
        <?php if ($produk->foto): ?>
          <img src="<?= base_url('uploads/' . $produk->foto) ?>" width="200" class="img-thumbnail">
        <?php endif; ?>

        <hr>
        <h4><i class="fa fa-comments"></i> Ulasan Pengguna</h4>
        <?php if ($ulasan): ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>User</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ulasan as $u): ?>
              <tr>
                <td><?= $u->nama ?></td>
                <td><?= $u->rating ?> / 5</td>
                <td><?= $u->komentar ?></td>
                <td><?= date('d M Y H:i', strtotime($u->created_at)) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-info">Belum ada ulasan untuk produk ini.</div>
        <?php endif; ?>

        <a href="<?= base_url('admin/produk') ?>" class="btn btn-default">Kembali</a>
      </div>
    </div>
  </section>
</div>
