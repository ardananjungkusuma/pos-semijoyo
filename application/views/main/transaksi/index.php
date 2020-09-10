<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url() ?>transaksi/tambah" class="btn btn-sm btn-success shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
        <a href="<?= base_url() ?>transaksi/cetakPDF" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Semua Data</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="listBarang">
                <thead style="background-color: #4e73df;color:white">
                    <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Tanggal Pembelian</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($transaksi as $t) :
                    ?>
                        <tr>
                            <td><?= $t['id_invoice'] ?></td>
                            <td><?= $t['tanggal_transaksi'] ?></td>
                            <td><?= $t['nama_barang'] ?></td>
                            <td><?= $t['jumlah_barang'] ?></td>
                            <td><?= number_format($t['harga_barang'], 0, ',', '.') ?></td>
                            <td>
                                <a href="<?= base_url() ?>transaksi/detail/<?= $t['id_invoice'] ?>" class="btn btn-warning">Detail</a>
                                <a href="<?= base_url() ?>transaksi/ubah/<?= $t['id_invoice'] ?>" class="btn btn-success">Edit</a>
                                <a href="<?= base_url() ?>transaksi/hapus/<?= $t['id_invoice'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?= $t['id_invoice'] ?>?');" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>