<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard User</h1>
  </section>

  <section class="content">
    <div class="alert alert-info">
      Halo, <strong><?= $this->session->userdata('nama') ?></strong>! Anda login sebagai <strong><?= $this->session->userdata('level') ?></strong>.
    </div>

    <div class="row">
      <!-- BOX: Profil -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><i class="fa fa-user"></i></h3>
            <p>Profil Saya</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="<?= base_url('user/profil') ?>" class="small-box-footer">
            Lihat Profil <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- BOX: Produk -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= $total_produk ?></h3>
            <p>Total Produk</p>
          </div>
          <div class="icon">
            <i class="fa fa-cube"></i>
          </div>
          <a href="<?= base_url('user/produk') ?>" class="small-box-footer">
            Lihat Produk <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- BOX: Keranjang -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?= $total_keranjang ?></h3>
            <p>Keranjang Saya</p>
          </div>
          <div class="icon">
            <i class="fa fa-shopping-cart"></i>
          </div>
          <a href="<?= base_url('user/keranjang') ?>" class="small-box-footer">
            Lihat Keranjang <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- BOX: Riwayat -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?= $total_pesanan ?></h3>
            <p>Riwayat Pesanan</p>
          </div>
          <div class="icon">
            <i class="fa fa-history"></i>
          </div>
          <a href="<?= base_url('user/riwayat') ?>" class="small-box-footer">
            Lihat Riwayat <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- BOX: Ulasan -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-purple">
          <div class="inner">
            <h3><?= $total_ulasan ?></h3>
            <p>Ulasan Saya</p>
          </div>
          <div class="icon">
            <i class="fa fa-comments"></i>
          </div>
          <a href="<?= base_url('user/ulasan') ?>" class="small-box-footer">
            Lihat Ulasan <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
