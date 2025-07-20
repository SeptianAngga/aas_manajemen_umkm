<div class="content-wrapper">
  <section class="content-header">
    <h1>Detail Pesanan</h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-body">
        <p><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($pesanan->created_at)) ?></p>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Produk</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Subtotal</th>
              <th>Ulasan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total = 0;
            foreach ($detail as $d):
              $subtotal = $d->jumlah * $d->harga;
              $total += $subtotal;
            ?>
            <tr>
              <td>
                <?php if ($d->foto): ?>
                  <img src="<?= base_url('uploads/' . $d->foto) ?>" width="50"><br>
                <?php endif; ?>
                <?= $d->nama_produk ?>
              </td>
              <td><?= $d->jumlah ?></td>
              <td>Rp<?= number_format($d->harga, 0, ',', '.') ?></td>
              <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
              <td>
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalUlasan<?= $d->id_produk ?>">
                  Beri Ulasan
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="4">Total</th>
              <th>Rp<?= number_format($total, 0, ',', '.') ?></th>
            </tr>
          </tfoot>
        </table>

        <a href="<?= base_url('user/riwayat/cetak/' . $pesanan->id) ?>" class="btn btn-success btn-sm">Download Invoice (PDF)</a>
        <a href="<?= base_url('user/riwayat') ?>" class="btn btn-default">Kembali</a>
      </div>
    </div>

    <!-- 💬 MODAL ULASAN PER PRODUK -->
    <?php foreach ($detail as $d): ?>
    <div class="modal fade" id="modalUlasan<?= $d->id_produk ?>" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= base_url('user/ulasan/simpan') ?>" method="post">
            <div class="modal-header">
              <h4 class="modal-title">Ulasan untuk: <?= $d->nama_produk ?></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id_produk" value="<?= $d->id_produk ?>">

              <div class="form-group">
                <label>Rating (1-5)</label>
                <select name="rating" class="form-control" required>
                  <option value="">-- Pilih Rating --</option>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                  <?php endfor; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Komentar</label>
                <textarea name="komentar" class="form-control" rows="3" placeholder="Tulis komentar anda..." required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

  </section>
</div>
