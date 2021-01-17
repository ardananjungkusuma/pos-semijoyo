<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Stok Penjualan</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Stok Penjualan</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url() ?>stokpenjualan/tambah" class="btn btn-sm btn-success shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
        <a href="<?= base_url() ?>stokpenjualan/exportExcel" target="_blank" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-file-excel fa-sm text-white-50"></i> Cetak Excel Stok Penjualan</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="listBarang">
                <thead style="background-color: #4e73df;color:white">
                    <tr>
                        <th scope="col">Nama Stok</th>
                        <th scope="col">Harga Stok</th>
                        <th scope="col">Satuan Stok</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($stok as $s) :
                    ?>
                        <tr>
                            <td><?= $s['nama_stok'] ?></td>
                            <td><?= number_format($s['harga_stok'], 0, ',', '.') ?></td>
                            <td><?= $s['satuan_stok'] ?></td>
                            <td><a href="<?= base_url() ?>stokpenjualan/ubah/<?= $s['id_stok'] ?>" class="btn btn-success">Edit</a>
                                <a href="<?= base_url() ?>stokpenjualan/hapus/<?= $s['id_stok'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?= $s['nama_stok'] ?>?');" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>