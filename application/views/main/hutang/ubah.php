<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pengutang</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Pengutang</h6>
    </div>
    <div class="card-body">
        <b style="color: red;"><?= validation_errors(); ?></b>
        <form method="POST" enctype="multipart/form-data" action="<?= base_url() ?>hutang/prosesUbah">
            <div class="form-group">
                <label>Nama Pengutang</label>
                <input type="hidden" id="id_hutang" value="<?= $hutang->id_hutang ?>" name="id_hutang" required>
                <input type="text" id="nama_pengutang" value="<?= $hutang->nama_pengutang ?>" name="nama_pengutang" class="form-control mb-2" placeholder="Nama" required>
                <label>No Telpon</label>
                <input type="text" id="no_telpon" name="no_telpon" value="<?= $hutang->no_telpon ?>" class="form-control mb-2" placeholder="No Telpon" required>
                <small>*No Telpon Tidak Wajib Diisi</small><br>
                <label>Alamat</label>
                <input type="text" id="alamat" name="alamat" value="<?= $hutang->alamat ?>" class="form-control mb-2" placeholder="Alamat">
                <small>*Alamat Tidak Wajib Diisi</small><br>
                <label>Jumlah Hutang</label>
                <input type="number" id="jumlah_hutang" required value="<?= $hutang->jumlah_hutang ?>" name="jumlah_hutang" class="form-control mb-2" placeholder="500000">
                <label>Status Hutang</label>
                <select class="form-control" id="status" name="status">
                    <option value="<?= $hutang->status ?>"><?= $hutang->status ?></option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                </select>
            </div>
            <a href=" <?= base_url() ?>hutang" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <button type="submit" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-edit fa-sm text-white-50"></i> Ubah Data</button>
        </form>
    </div>
</div>