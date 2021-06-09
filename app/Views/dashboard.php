<?= view('layout/header'); ?>
<?= view('layout/sidebar'); ?>
<?= view('layout/topbar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right bg-light">
            <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-3 text-white shadow-sm bg-success border-success">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body">
                    <h3 class="font-weight-bold"><?= $jumlah_transaksi; ?></h3>
                    <span>Transaksi</span>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-dollar-sign fa-4x float-left icon"></i>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="<?= base_url('transaksi/laporan'); ?>" class="font-weight-bold text-success text-decoration-none more-info">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card mb-3 text-white shadow-sm bg-warning border-warning">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body">
                    <h3 class="font-weight-bold"><?= $jumlah_produk; ?></h3>
                    <span>Produk</span>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-cart-plus fa-4x float-left icon"></i>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="<?= base_url('produk'); ?>" class="font-weight-bold text-warning text-decoration-none more-info">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card mb-3 text-white shadow-sm bg-info border-info">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body">
                    <h3 class="font-weight-bold"><?= $jumlah_kategori; ?></h3>
                    <span>Kategori</span>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-tag fa-4x float-left icon"></i>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="<?= base_url('kategori'); ?>" class="font-weight-bold text-info text-decoration-none more-info">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-5">
          <div class="card mb-5">
            <div class="card-header">
              <h5 class="m-0">Transaksi Terbaru</h5>
            </div>
            <div class="card-body pb-0">
              <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($transaksi as $row) : ?>
                      <tr>
                        <td><?= date('Y-m-d', strtotime($row['waktu_transaksi'])); ?></td>
                        <td><?= date('H:i:s', strtotime($row['waktu_transaksi'])); ?></td>
                        <td><?= 'Rp. ' . number_format($row['total_transaksi']); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card mb-3">
            <div class="card-header">
              <h5 class="m-0">Grafik Penjualan</h5>
            </div>
            <div class="card-body">
              <canvas id="grafik"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; <?= date('Y') ?> - Rahmat Rendy Prayogo - </span>
      <span class="text-primary font-weight-lighter">Made with <i class="fas fa-heart"></i></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up">
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- menambahkan evek hover untuk card -->
<script>
  $(document).ready(function() {

    $(".card").hover(
      function() {
        $(this).addClass('shadow pb-1');
      },
      function() {
        $(this).removeClass('shadow pb-1');
      }
    );

  });
</script>

<!-- memproses grafik produk pada dashboard -->
<script>
  var ctx = document.getElementById('grafik').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?= $nama_grafik; ?>],
      datasets: [{
        label: 'Data Penjualan Barang',
        backgroundColor: '#ADD8E6',
        borderColor: '#93C3D2',
        data: [<?= $jumlah_grafik; ?>]
      }]
    },
    options: {
      indexAxis: 'y',
    }
  });
</script>


<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>