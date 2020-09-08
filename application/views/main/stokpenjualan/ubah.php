<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Restock Barang</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Restock Barang</h6>
    </div>
    <div class="card-body">
        <b style="color: red;"><?= validation_errors(); ?></b>
        <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>barang/prosesUbah">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="hidden" value="<?= $barang->id_barang ?>" name="id_barang" required>
                <input type="text" id="nama_barang" value="<?= $barang->nama_barang ?>" name="nama_barang" class="form-control mb-2" placeholder="Nama" required>
                <label>Nama Distributor</label>
                <select class="form-control" id="id_distributor" name="id_distributor">
                    <option value="<?= $barang->id_distributor ?>"> Distributor <?= $barang->nama_distributor ?></option>
                    <?php foreach ($distributor as $d) {
                    ?>
                        <option value="<?= $d['id_distributor'] ?>"><?= $d['nama_distributor'] ?></option>
                    <?php              } ?>
                </select>
                <label>Jumlah Barang</label>
                <input type="number" value="<?= $barang->jumlah_barang ?>" id="jumlah_barang" name="jumlah_barang" class="form-control mb-2" placeholder="0" required>
                <label>Satuan Barang</label>
                <input type="text" id="satuan_barang" value="<?= $barang->satuan_barang ?>" name="satuan_barang" class="form-control mb-2" placeholder="Dus/Kg" required>
                <label>Harga Barang</label>
                <input type="number" id="harga_barang" value="<?= $barang->harga_barang ?>" name="harga_barang" class="form-control mb-2" placeholder="0">
            </div>
            <a href="<?= base_url() ?>barang" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <button type="submit" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-edit fa-sm text-white-50"></i> Ubah Data</button>
        </form>
    </div>
</div>