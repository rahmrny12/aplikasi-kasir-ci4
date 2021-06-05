<?= view('layout/header'); ?>
<?= view('layout/sidebar'); ?>
<?= view('layout/topbar'); ?>
        
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Laporan Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-light">
                        <li class="breadcrumb-item"><a href="<?= base_url('Transaksi'); ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
 
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Waktu Transaksi</th>
                                                <th>Operator</th>
                                                <th>Pembayaran</th>
                                                <th>Uang Kembali</th>
                                                <th>Total Transaksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $i = 1 + (4 * ($page_counter - 1));
                                        foreach ($laporan as $row) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $row['tanggal_transaksi']; ?></td>
                                                <td><?= $row['waktu_transaksi']; ?></td>
                                                <td><?= $row['user']; ?></td>
                                                <td><?= 'Rp. ' . number_format($row['bayar_transaksi']); ?></td>
                                                <td><?= 'Rp. ' . number_format($row['kembalian_transaksi']); ?></td>
                                                <td><?= 'Rp. ' . number_format($row['total_transaksi']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                            <tr>
                                                <td colspan="6" class="textx-center">Total Keseluruhan</td>
                                                <td><?= 'Rp. ' . number_format($laporan_total['total_transaksi']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?= $pager->links('laporan', 'custom_pager'); ?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer'); ?>