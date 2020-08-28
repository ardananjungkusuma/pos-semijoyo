<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Distributor</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Distributor</h6>
    </div>
    <div class="card-body">
        <a href="<?= base_url() ?>distributor/tambah" class="btn btn-sm btn-success shadow-sm mb-3"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
        <a href="<?= base_url() ?>distributor/cetakPDF" class="btn btn-sm btn-primary shadow-sm mb-3"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Semua Data</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="listDistributor">
                <thead style="background-color: #4e73df;color:white">
                    <tr>
                        <th scope="col">Nama Distributor</th>
                        <th scope="col">Nomer Telfon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($distributor as $d) :
                    ?>
                        <tr>
                            <td><?= $d['nama_distributor'] ?></td>
                            <td><?= $d['no_telpon'] ?></td>
                            <td><?= $d['alamat'] ?></td>
                            <td><a href="<?= base_url() ?>distributor/ubah/<?= $d['id_distributor'] ?>" class="btn btn-success">Edit</a>
                                <a href="<?= base_url() ?>distributor/hapus/<?= $d['id_distributor'] ?>" onclick="return confirm('Jika data distributor dihapus maka barang yang distok oleh distributor ikut terhapus juga. Apakah Anda Yakin Ingin Menghapus <?= $d['nama_distributor'] ?>?');" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>