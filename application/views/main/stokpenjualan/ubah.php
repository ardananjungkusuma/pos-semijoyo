<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Stok Penjualan</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Stok Penjualan</h6>
    </div>
    <div class="card-body">
        <b style="color: red;"><?= validation_errors(); ?></b>
        <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>stokpenjualan/prosesUbah">
            <div class="form-group">
                <input type="hidden" value="<?= $stok->id_stok ?>" name="id_stok" required>
                <label>Harga Stok</label>
                <input type="number" value="<?= $stok->harga_stok ?>" id="harga_stok" name="harga_stok" class="form-control mb-2" placeholder="0" required>
                <label>Satuan stok</label>
                <input type="text" id="satuan_stok" value="<?= $stok->satuan_stok ?>" name="satuan_stok" class="form-control mb-2" placeholder="Dus/Kg" required>
            </div>
            <a href="<?= base_url() ?>stok" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <button type="submit" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-edit fa-sm text-white-50"></i> Ubah Data</button>
        </form>
    </div>
</div>