<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Distributor</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Distributor</h6>
    </div>
    <div class="card-body">
        <b style="color: red;"><?= validation_errors(); ?></b>
        <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>distributor/prosesUbah">
            <div class="form-group">
                <label>Nama Distributor</label>
                <input type="hidden" id="id_distributor" value="<?= $distributor->id_distributor ?>" name="id_distributor" class="form-control mb-2" placeholder="Nama" required>
                <input type="text" id="nama_distributor" value="<?= $distributor->nama_distributor ?>" name="nama_distributor" class="form-control mb-2" placeholder="Nama" required>
                <label>No Telpon</label>
                <input type="text" id="no_telpon" name="no_telpon" value="<?= $distributor->no_telpon ?>" class="form-control mb-2" placeholder="No Telpon" required>
                <label>Alamat</label>
                <input type="text" id="alamat" name="alamat" value="<?= $distributor->alamat ?>" class="form-control mb-2" placeholder="Alamat">
                <small>*Alamat Tidak Wajib Diisi</small>
            </div>
            <a href="<?= base_url() ?>distributor" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <button type="submit" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-edit fa-sm text-white-50"></i> Ubah Data</button>
        </form>
    </div>
</div>