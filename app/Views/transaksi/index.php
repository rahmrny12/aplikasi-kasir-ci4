<?= view('layout/header'); ?>
<?= view('layout/sidebar'); ?>
<?= view('layout/topbar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Transaksi</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <?php
          if (!empty(session()->getFlashdata('success'))) { ?>
            <div class="alert alert-success">
              <?= session()->getFlashdata('success'); ?>
            </div>
          <?php } ?>

          <?php if (!empty(session()->getFlashdata('warning'))) { ?>
            <div class="alert alert-warning">
              <?= session()->getFlashdata('warning'); ?>
            </div>
          <?php } ?>

          <?= form_open('transaksi/simpan') ?>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <?php
                    echo form_label('Produk');
                    echo form_dropdown('id_produk', $jenis_produk, old('id_produk'), ['class' => ($validation->hasError('id_produk')) ? 'form-control custom-select is-invalid' : 'form-control custom-select']);
                    ?>
                    <div class="invalid-feedback">
                      <?= $validation->getError('id_produk'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php
                    echo form_label('Jumlah', 'jumlah_produk');
                    $jumlah_produk = [
                      'type'          => 'number',
                      'name'          => 'jumlah_produk',
                      'id'            => 'jumlah_produk',
                      'class'         =>  'form-control',
                      'placeholder'   => '1',
                      'autocomplete'  => 'off'
                    ];
                    echo form_input($jumlah_produk);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-primary">Simpan</button>
            </div>
          </div>
          <?= form_close() ?>
        </div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    $total = 0;
                    if (empty($produk)) {
                      $produk = [];
                    }
                    foreach ($produk as $row) { ?>
                      <?php $subtotal = $row['jumlah_produk'] * $row['harga_produk']; ?>
                      <tr class="gradeU">
                        <td><?= $i++ ?></td>
                        <td><?= $row['nama_produk'] . ' - ' . anchor('transaksi/hapus/' . $row['id_detail'], 'Hapus', ['class' => 'text-danger']) ?></td>
                        <td><?= $row['jumlah_produk'] ?></td>
                        <td>Rp. <?= number_format($row['harga_produk'], 2) ?></td>
                        <td>Rp. <?= number_format($subtotal) ?></td>
                      </tr>
                    <?php $total += $subtotal;
                    } ?>
                    <tr class="gradeA">
                      <td colspan="4" class="text-center">TOTAL</td>
                      <td>Rp. <?= number_format($total, 2); ?></td>
                    </tr>
                  </tbody>
                </table>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right mb-3" id="modalButton" data-toggle="modal" data-target="#modal">Checkout</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('transaksi/bayar'); ?>
      <div class="modal-body">

        <?php if (!empty(session()->getFlashdata('bayar'))) { ?>
          <div id="alert" class="alert alert-warning" role="alert">
            <?= session()->getFlashdata('bayar'); ?>
          </div>
        <?php } ?>

        <div class="form-group">
          <?php
          echo form_label('Total', 'total_bayar');
          $total_bayar = [
            'type'      => 'text',
            'name'      => 'total_bayar',
            'id'        => 'total_bayar',
            'class'     => 'form-control',
            'value'     => $total,
            'readonly'  => 'on'
          ];
          ?>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Rp.</div>
            </div>
            <?= form_input($total_bayar);  ?>
          </div>
        </div>
        <div class="form-group">
          <?php
          echo form_label('Bayar', 'bayar');
          $bayar = [
            'type'        => 'number',
            'name'        => 'bayar',
            'id'          => 'bayar',
            'value'       => old('bayar'),
            'class'       => $validation->hasError('bayar_transaksi') ? 'form-control is-invalid' : 'form-control',
            'placeholder' => '0'
          ];
          ?>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Rp.</div>
            </div>
            <?= form_input($bayar);  ?>
            <div class="invalid-feedback">
              <?= $validation->getError('bayar_transaksi'); ?>
            </div>
          </div>
          <small>Tekan <b>Tab</b> untuk melihat kembalian</small>
        </div>
        <div class="form-group">
          <?php
          echo form_label('Kembalian', 'kembalian');
          $kembalian = [
            'type'        => 'text',
            'name'        => 'kembalian',
            'id'          => 'kembalian',
            'value'       => old('kembalian'),
            'class'       => 'form-control',
            'readonly'    => 'on',
            'placeholder' => '0'
          ];
          ?>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Rp.</div>
            </div>
            <?= form_input($kembalian); ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Bayar</button>
      </div>
      <?= form_close(); ?>
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
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">

  <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>


<script type="text/javascript">
  // cek jika ada error validasi atau session maka tampilkan modal otomatis
  <?php if (!empty($validation->hasError('bayar_transaksi') || $validation->hasError('kembalian_transaksi')) || !empty(session()->getFlashdata('bayar'))) { ?>
    $(document).ready(function() {
      $('#modal').modal('show');
    });
  <?php } ?>

  // jika total bayar masih kosong alias belum ada produk disimpan maka disable button
  $(document).ready(function() {
    let total = $('#total_bayar').val();
    if (total == 0) {
      $("#modalButton").attr("disabled", true);
    }
  });

  // jika pada input bayar ditekan tab maka jalankan fungsi getKembalian
  document.getElementById('bayar').addEventListener("keydown", function(event) {
    if (event.key === 'Tab') {
      getKembalian();
      event.preventDefault();
    }
  });

  // sekedar melihat kembalian namun tidak disimpan di database, kembalian tetap diproses di controller transaksi
  function getKembalian() {
    var total_bayar = parseInt(document.getElementById('total_bayar').value);
    var bayar = parseInt(document.getElementById('bayar').value);

    if (bayar < total_bayar) {
      var kembalian = 'Pembayaran tidak mencukupi :(';
    } else if (bayar != total_bayar) {
      var kembalian = bayar - total_bayar;
    } else {
      kembalian = 'Kembalian Pas :)';
    }

    document.getElementById('kembalian').value = kembalian;
  }
</script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>