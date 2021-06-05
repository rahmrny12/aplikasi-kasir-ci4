<?= view('layout/header'); ?>
<?= view('layout/sidebar'); ?>
<?= view('layout/topbar'); ?>
        
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Produk</h1>
                </div>
            </div>
        </div>
    </div>
 
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-header pt-4">
                            <?= form_open('produk'); ?>
                                <div class="input-group mb-3 col-5 my-0 float-left">
                                    <?php
                                    echo form_dropdown('keyword', $kategori, null, ['class' => 'custom-select']); 
                                    ?>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary rounded-right mr-3" type="submit">Cari</button>
                                    </div>
                                </div>
                            <?= form_close(); ?>
                            <?= form_open('produk'); ?>
                                <div class="input-group mb-3 col-5 my-0 float-left">
                                    <?php 
                                    $keyword = [
                                        'type'          => 'text',
                                        'name'          => 'keyword',
                                        'id'            => 'keyword',
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Masukkan Keyword Produk'
                                    ];
                                    echo form_input($keyword);
                                    ?>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary rounded-right mr-3" type="submit">Cari</button>
                                    </div>
                                </div>
                            <?= form_close(); ?>
                            <a href="<?= base_url('produk/tambah'); ?>" class="btn btn-primary float-right" id="btn-tambah">Tambah</a>
                        </div>
                        <div class="card-body pb-0">
                         
                            <?php
                            if(!empty(session()->getFlashdata('success'))){ ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success');?>
                            </div>     
                            <?php } ?>

                            <?php if(!empty(session()->getFlashdata('warning'))){ ?>
                            <div class="alert alert-warning">
                                <?= session()->getFlashdata('warning');?>
                            </div>
                            <?php } ?>
 
                            <div class="table-responsive">
                                <table class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th class="text-center aksi-produk">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 + (4 * ($page_counter - 1));
                                        foreach($produk as $row) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['nama_produk']; ?></td>
                                            <td><?= $row['nama_kategori']; ?></td>
                                            <td><?= "Rp. " . number_format($row['harga_produk']); ?></td>
                                            <td class="text-center aksi-produk">
                                                <div class="btn-group">
                                                    <a href="<?= base_url('produk/edit/' . $row['id_produk']); ?>" class="btn btn-sm btn-info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="<?= base_url('produk/hapus/' . $row['id_produk']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?= $pager->links('produk', 'custom_pager'); ?>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </div>
</div>

<?= view('layout/footer'); ?>