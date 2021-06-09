<?= view('layout/header'); ?>
<?= view('layout/sidebar'); ?>
<?= view('layout/topbar'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">
  <div class="col-lg-8">

    <?= form_open_multipart('home/prosesEdit'); ?>

    <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
    <input type="hidden" name="foto_lama" value="<?= $user['foto']; ?>">
    <div class="form-group row">
      <label for="email" class="col-sm-3 col-form-label">Email</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="email" name="email" data-toggle="tooltip" data-placement="bottom" title="Email tidak bisa diganti." value="<?= $user['email'] ?>" readonly>
      </div>
    </div>
    <div class="form-group row">
      <label for="nama_user" class="col-sm-3 col-form-label">Nama Lengkap</label>
      <div class="col-sm-8">
        <input type="text" class="<?= ($validation->hasError('nama_user')) ? 'form-control is-invalid' : 'form-control'; ?>" id="nama_user" name="nama_user" value="<?= $user['nama_user'] ?>">
        <div class="invalid-feedback">
          <?= $validation->getError('nama_user'); ?>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-3">Foto</div>
      <div class="col-sm-8">
        <div class="row">
          <div class="col-sm-3">
            <img src="<?= base_url('assets/img/profile/' . $user['foto']); ?>" class="img-thumbnail img-preview">
          </div>
          <div class="col-sm-9">
            <div class="custom-file">
              <input type="file" class="<?= ($validation->hasError('foto')) ? 'custom-file-input is-invalid' : 'custom-file-input'; ?>" id="foto" name="foto" onchange="preview()">
              <div class="invalid-feedback">
                <?= $validation->getError('foto'); ?>
              </div>
              <label class="custom-file-label" for="foto">Pilih gambar</label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row justify-content-end">
      <div class="col-sm-9">
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
    </div>

    <?= form_close() ?>

  </div>
</div>

<?= view('layout/footer'); ?>