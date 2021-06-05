<?= view('layout/header'); ?>
<?= view('layout/sidebar'); ?>
<?= view('layout/topbar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Kategori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb bg-light float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('/kategori') ?>">Kategori</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
 
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="<?= base_url('kategori/prosesEdit/' . $kategori['id_kategori']); ?>" method="post">
                  <div class="form-group">
                      <label for="">Nama</label>
                      <input type="text" value="<?= $kategori['nama_kategori']; ?>" class="form-control <?= ($validation->hasError('nama_kategori')) ? 'is-invalid' : ''; ?>" name="nama_kategori" placeholder="Masukkan nama kategori">
                      <div class="invalid-feedback">
                        <?= $validation->getError('nama_kategori'); ?>
                      </div>
                  </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('kategori'); ?>" class="btn btn-outline-primary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

<?= view('layout/footer'); ?>