<?= view('layout/auth_header'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Silahkan Login!</h1>
                                </div>

                                <?php if ((session()->getFlashdata('warning'))) : ?>
                                    <div class="alert alert-warning">
                                        <?= session()->getFlashdata('warning');?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                    <div class="alert alert-success">
                                        <?= session()->getFlashdata('success');?>
                                    </div>
                                <?php endif; ?>

                                <form action="<?= base_url('auth/login'); ?>" method="post"class="user">
                                    <!-- input email -->
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan Alamat Email..." value="<?= old('email'); ?>" autofocus>
                                        <div class="invalid-feedback ml-4">
                                            <?= $validation->getError('email'); ?>
                                        </div>
                                    </div>
                                    <!-- input password -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-user <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukkan Password">
                                            <div class="input-group-append">
                                                <span class="input-group-text rounded-right" onclick="showPass()">
                                                    <i class="fas fa-eye" style="cursor: pointer; font-size: 20px;"></i>
                                                </span>
                                            </div>
                                            <div class="invalid-feedback ml-4">
                                                <?= $validation->getError('password'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/registrasi'); ?>">Belum Punya Akun? Register!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?= view('layout/auth_footer'); ?>