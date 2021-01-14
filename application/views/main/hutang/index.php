<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pengutang</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengutang</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url() ?>hutang/tambah" class="btn btn-sm btn-success shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="listPengutang">
                <thead style="background-color: #4e73df;color:white">
                    <tr>
                        <th scope="col">Nama Pengutang</th>
                        <th scope="col">Nomer Telfon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tanggal Hutang</th>
                        <th scope="col">Jumlah Hutang</th>
                        <th scope="col">Catatan Hutang</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($hutang as $h) :
                        $dateTime = new DateTime($h['tanggal_hutang']);
                        $dateTime = $dateTime->format('d-m-Y');
                    ?>
                        <tr>
                            <td><?= $h['nama_pengutang'] ?></td>
                            <td><?= $h['no_telpon'] ?></td>
                            <td><?= $h['alamat'] ?></td>
                            <td><?= $dateTime ?></td>
                            <td><?= number_format($h['jumlah_hutang'], 0, ',', '.') ?></td>
                            <td><?= $h['catatan_hutang'] ?></td>
                            <td><?= $h['status'] ?></td>
                            <td><a href="<?= base_url() ?>hutang/ubah/<?= $h['id_hutang'] ?>" class="btn btn-success">Edit</a>
                                <a href="<?= base_url() ?>hutang/hapus/<?= $h['id_hutang'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Hutang <?= $h['nama_pengutang'] ?>?');" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>