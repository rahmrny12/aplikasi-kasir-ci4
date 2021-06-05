<?= view('layout/auth_header'); ?>

<div class="container">
    
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                        </div>

                        <?php
                        if (!empty(session()->getFlashdata('success'))) : ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success');?>
                            </div>     
                        <?php endif; ?>

                        <form action="<?= base_url('auth/prosesRegistrasi'); ?>" method="post" class="user">
                            <!-- input nama -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="name" name="nama" placeholder="Nama Lengkap" value="<?= old('nama'); ?>">
                                <div class="invalid-feedback ml-4">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                            </div>
                            <!-- input email -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Alamat Email" value="<?= old('email'); ?>">
                                <div class="invalid-feedback ml-4">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <!-- input password -->
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password" value="<?= old('password'); ?>">
                                    <div class="invalid-feedback ml-4">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <!-- input konf_password -->
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user <?= ($validation->hasError('konf_password')) ? 'is-invalid' : '' ?>"
                                        id="konf_password" name="konf_password" placeholder="Konfirmasi Password">
                                    <div class="invalid-feedback ml-4">
                                        <?= $validation->getError('konf_password'); ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= view('layout/auth_footer'); ?>