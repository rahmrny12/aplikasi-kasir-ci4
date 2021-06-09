<?= view('layout/header'); ?>
<?= view('layout/sidebar'); ?>
<?= view('layout/topbar'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="card mb-3 col-lg-8">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="<?= base_url('assets/img/profile/' . $user['foto']); ?>" class="card-img my-3">
    </div>
    <div class="col-md-8">
      <a class="float-right mt-2" href="<?= base_url('home/edit-profile'); ?>">Edit Profile</a>
      <div class="card-body">
        <h5 class="card-title"><?= $user['nama_user']; ?></h5>
        <p class="card-text"><?= $user['email']; ?></p>
        <p class="card-text"><small class="text-muted">Sejak <?= date('d M Y', strtotime($user['tgl_ditambahkan'])); ?></small></p>
      </div>
    </div>
  </div>
</div>

<?= view('layout/footer'); ?>