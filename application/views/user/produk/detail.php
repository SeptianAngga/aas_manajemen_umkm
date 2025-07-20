<div class="content-wrapper">
  <section class="content-header">
    <h1><?= $title ?></h1>
  </section>

  <section class="content">
    <form action="<?= base_url('user/keranjang/tambah') ?>" method="post">
  <input type="hidden" name="id_produk" value="<?= $produk->id ?>">
  <input type="number" name="jumlah" value="1" min="1" class="form-control" style="width:80px; display:inline-block">
  <button type="submit" class="btn btn-success">Tambah ke Keranjang</button>
</form>

    <div class="box box-primary">
      <div class="box-body">
        <?php if ($produk): ?>
          <div class="row">
            <div class="col-md-4">
              <?php if ($produk->foto): ?>
                <img src="<?= base_url('uploads/' . $produk->foto) ?>" class="img-responsive img-thumbnail">
              <?php else: ?>
                <em>Foto tidak tersedia</em>
              <?php endif; ?>
            </div>
            <div class="col-md-8">
              <h3><?= $produk->nama_produk ?></h3>
              <p><strong>Harga:</strong> Rp<?= number_format($produk->harga, 0, ',', '.') ?></p>
              <p><strong>Deskripsi:</strong> <?= $produk->deskripsi ?></p>
              <p><strong>Kategori:</strong>
                <?php foreach ($kategori as $k): ?>
                  <span class="label label-info"><?= $k->nama_kategori ?></span>
                <?php endforeach; ?>
                <h3>Ulasan Produk</h3>
<?php if ($ulasan): ?>
  <ul class="list-group">
    <?php foreach ($ulasan as $u): ?>
      <li class="list-group-item">
        <strong><?= $u->nama ?></strong> <br>
        <span style="color: gold;"><?= str_repeat('★', $u->rating) ?><?= str_repeat('☆', 5 - $u->rating) ?></span><br>
        <?= $u->komentar ?><br>
        <small class="text-muted"><?= date('d M Y H:i', strtotime($u->created_at)) ?></small>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>Belum ada ulasan untuk produk ini.</p>
<?php endif; ?>

              </p>
              <a href="<?= base_url('user/produk') ?>" class="btn btn-default">Kembali</a>
            </div>
          </div>
        <?php else: ?>
          <div class="alert alert-warning">Produk tidak ditemukan.</div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
