<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Stok Penjualan</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Stok Penjualan</h6>
    </div>
    <div class="card-body">
        <b style="color: red;"><?= validation_errors(); ?></b>
        <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>stokpenjualan/tambah">
            <div class="form-group">
                <label>Nama Stok Penjualan</label>
                <select class="js-example-basic-single form-control" id="nama_stok" name="nama_stok" required>
                    <option value="" selected disabled hidden>Pilih Barang</option>
                    <?php foreach ($barang as $b) {
                    ?>
                        <option value="<?= $b['nama_barang'] ?>"><?= $b['nama_barang'] ?></option>
                    <?php              } ?>
                </select>
                <label>Harga Stok</label>
                <input type="number" id="harga_stok" name="harga_stok" class="form-control mb-2" placeholder="0" required>
                <label>Satuan Stok</label>
                <input type="text" id="satuan_stok" name="satuan_stok" class="form-control mb-2" placeholder="Dus/Kg/pcs" required>
            </div>
            <a href="<?= base_url() ?>stokpenjualan" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <button type="submit" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</button>
        </form>
    </div>
</div>