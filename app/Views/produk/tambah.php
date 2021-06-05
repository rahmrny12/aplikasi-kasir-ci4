<?= view('layout/header'); ?>
<?= view('layout/sidebar'); ?>
<?= view('layout/topbar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb bg-light float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('/produk'); ?>">Produk</a></li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          
          <?= form_open('produk/prosesTambah') ?>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group"> 
                      <?php
                        echo form_label('Kategori');
                        echo form_dropdown('id_kategori', $kategori, old('id_kategori'), ['class' => $validation->hasError('id_kategori') ? 'form-control custom-select is-invalid' : 'form-control custom-select']);
                      ?>
                      <div class="invalid-feedback ml-2">
                        <?= $validation->getError('id_kategori'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <?php 
                        echo form_label('Nama');
                        $nama_produk = [
                          'type'  => 'text',
                          'name'  => 'nama_produk',
                          'id'    => 'nama_produk',
                          'value' => old('nama_produk'),
                          'class' => $validation->hasError('nama_produk') ? 'form-control is-invalid' : 'form-control',
                          'placeholder' => 'Nama Produk'
                        ];
                        echo form_input($nama_produk); 
                      ?>
                      <div class="invalid-feedback ml-2">
                        <?= $validation->getError('nama_produk'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php 
                        echo form_label('Harga');
                        $harga_produk = [
                          'type'  => 'text',
                          'name'  => 'harga_produk',
                          'id'    => 'harga_produk',
                          'value' => old('harga_produk'),
                          'class' => $validation->hasError('harga_produk') ? 'form-control is-invalid' : 'form-control',
                          'placeholder' => '0'
                        ];
                      ?>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Rp.</div>
                        </div>
                        <?= form_input($harga_produk);  ?>
                        <div class="invalid-feedback ml-2">
                          <?= $validation->getError('harga_produk'); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                  <a href="<?= base_url('produk'); ?>" class="btn btn-outline-primary">Back</a>
                  <button type="submit" class="btn btn-primary float-right">Simpan</button>
              </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= view('layout/footer'); ?>