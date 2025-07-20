<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Ulasan</h1>
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Ulasan untuk: <?= $ulasan->nama_produk ?></h3>
      </div>

      <form action="<?= base_url('user/ulasan/update/' . $ulasan->id) ?>" method="post">
        <div class="box-body">
          <input type="hidden" name="id_produk" value="<?= $ulasan->id_produk ?>">

          <div class="form-group">
            <label for="rating">Rating</label>
            <select name="rating" id="rating" class="form-control" required>
              <option value="">-- Pilih Rating --</option>
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>" <?= ($ulasan->rating == $i) ? 'selected' : '' ?>>
                  <?= $i ?>
                </option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="komentar">Komentar</label>
            <textarea name="komentar" id="komentar" class="form-control" rows="4" required><?= $ulasan->komentar ?></textarea>
          </div>
        </div>

        <div class="box-footer">
          <a href="<?= base_url('user/ulasan') ?>" class="btn btn-default">Kembali</a>
          <button type="submit" class="btn btn-primary">Update Ulasan</button>
        </div>
      </form>
    </div>
  </section>
</div>
