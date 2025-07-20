<div class="content-wrapper">
  <section class="content-header">
    <h1><?= $title ?></h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <form action="<?= base_url('user/produk') ?>" method="get" class="form-inline pull-right">
          <label>Filter Kategori:</label>
          <select name="kategori" class="form-control">
            <option value="">Semua</option>
            <?php foreach ($kategori_all as $k): ?>
              <option value="<?= $k->id ?>" <?= ($this->input->get('kategori') == $k->id) ? 'selected' : '' ?>>
                <?= $k->nama_kategori ?>
              </option>
            <?php endforeach; ?>
          </select>
          <button type="submit" class="btn btn-default">Tampilkan</button>
        </form>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($produk as $p): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td width="80">
                  <?php if ($p->foto): ?>
                    <img src="<?= base_url('uploads/' . $p->foto) ?>" width="70">
                  <?php else: ?>
                    <em>Belum ada</em>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?= base_url('user/produk/detail/' . $p->id) ?>">
                    <?= $p->nama_produk ?>
                  </a>
                </td>
                <td>Rp<?= number_format($p->harga, 0, ',', '.') ?></td>
                <td><?= word_limiter($p->deskripsi, 15) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
