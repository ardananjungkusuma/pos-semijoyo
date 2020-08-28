<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Barang</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url() ?>barang/tambah" class="btn btn-sm btn-success shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
        <a href="<?= base_url() ?>barang/cetakPDF" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Semua Data</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="listBarang">
                <thead style="background-color: #4e73df;color:white">
                    <tr>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Nama Distributor</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Total Harga Barang</th>
                        <th scope="col">Tanggal Pembelian</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($barang as $b) :
                    ?>
                        <tr>
                            <td><?= $b['nama_barang'] ?></td>
                            <td><?= $b['nama_distributor'] ?></td>
                            <td><?= $b['jumlah_barang'] ?></td>
                            <td><?= number_format($b['harga_barang'], 0, ',', '.') ?></td>
                            <td><?= $b['tanggal_beli'] ?></td>
                            <td><a href="<?= base_url() ?>barang/ubah/<?= $b['id_barang'] ?>" class="btn btn-success">Edit</a>
                                <a href="<?= base_url() ?>barang/hapus/<?= $b['id_barang'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?= $b['nama_barang'] ?>?');" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>