<div class="content-wrapper">
  <section class="content-header">
    <h1><?= $title ?></h1>
  </section>

  <section class="content">
    <?php if ($this->session->flashdata('pesan')): ?>
      <div class="alert alert-success"><?= $this->session->flashdata('pesan') ?></div>
    <?php endif; ?>

    <div class="box">
      <div class="box-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Produk</th>
              <th>Rating</th>
              <th>Komentar</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ulasan as $u): ?>
              <tr>
                <td>
                  <?php if ($u->foto): ?>
                    <img src="<?= base_url('uploads/' . $u->foto) ?>" width="50"><br>
                  <?php endif; ?>
                  <?= $u->nama_produk ?>
                </td>
                <td><?= $u->rating ?> / 5</td>
                <td><?= $u->komentar ?></td>
                <td><?= date('d M Y H:i', strtotime($u->created_at)) ?></td>
                <td><a href="<?= base_url('user/ulasan/edit/' . $u->id) ?>" class="btn btn-warning btn-sm">Edit</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
