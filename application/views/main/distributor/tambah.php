<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Distributor</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Distributor</h6>
    </div>
    <div class="card-body">
        <b style="color: red;"><?= validation_errors(); ?></b>
        <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>distributor/tambah">
            <div class="form-group">
                <label>Nama Distributor</label>
                <input type="text" id="nama_distributor" name="nama_distributor" class="form-control mb-2" placeholder="Nama" required>
                <label>No Telpon</label>
                <input type="text" id="no_telpon" name="no_telpon" class="form-control mb-2" placeholder="No Telpon" required>
                <label>Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control mb-2" placeholder="Alamat">
                <small>*Alamat Tidak Wajib Diisi</small>
            </div>
            <button type="submit" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</button>
        </form>
    </div>
</div>