<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <div class="row">
            <div class="col-sm-6">
                <label class=" form-control-label">Tanggal Awal</label>
                <div class="input-group">
                    <input type="date" name="startDate" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <label class=" form-control-label">Tanggal Akhir</label>
                <div class="input-group">
                    <input type="date" name="endDate" class="form-control" required>
                </div>
            </div>
        </div><br>
        <?php if ($filter) { ?>
            <a href="<?= base_url() ?>transaksi" class="btn btn-sm btn-secondary shadow-sm mb-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Tampilkan Semua Data</a>
        <?php } ?>
        <button class="btn btn-sm btn-warning shadow-sm mb-3" onclick="filterDate()"><i class="fas fa-search fa-sm text-white-50"></i> Filter Data</button>
        <a href="<?= base_url() ?>transaksi/tambah" class="btn btn-sm btn-success shadow-sm mb-3" target="_blank"><i class="fas fa-plus fa-sm text-white-50"></i> Menu Kasir</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="listBarang">
                <thead style="background-color: #4e73df;color:white">
                    <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Tanggal Pembelian</th>
                        <th scope="col">Jam Pembelian</th>
                        <th scope="col">Total Pembayaram</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($transaksi as $t) :
                    ?>
                        <tr>
                            <td><?= $t['id_transaksi'] ?></td>
                            <td><?= date("d-m-Y", strtotime($t['tanggal_transaksi'])) ?></td>
                            <td><?= $t['jam_transaksi'] ?></td>
                            <td><?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <button data-toggle="modal" data-target="#detailModal" class="btn btn-warning" onclick="detailTransaksi('<?= $t['id_transaksi'] ?>','<?= number_format($t['total_harga'], 0, ',', '.') ?>')"><i class="fa fa-eye"></i> Detail</button>
                                <a href="<?= base_url() ?>transaksi/cetakInvoice/<?= $t['id_transaksi'] ?>" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> Cetak Nota</a>
                                <a href="<?= base_url() ?>transaksi/hapus/<?= $t['id_transaksi'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Transaksi <?= $t['id_transaksi'] ?>?\nDetail pembelian barang akan ikut terhapus juga saat anda menghapus transaksi ini. Hapus?');" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi <span id="id_transaksi_detail"></span> </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table border="0" class="table">
                    <thead class="thead-dark">
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>SubTotal</th>
                    </thead>
                    <tbody id="targetData">

                    </tbody>
                    <tr style="background-color:#ddd;font-weight: bold;">
                        <td colspan="1">Total Pembayaran</td>
                        <td colspan="2">
                            <center>
                                Rp. <span id="totalDetail"></span>
                            </center>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <script>
        function detailTransaksi(invoice, totalDetail) {
            let bodyDetail = document.querySelector('.modal_body');
            console.log(totalDetail);
            document.getElementById('id_transaksi_detail').textContent = `${invoice}`;
            document.getElementById('totalDetail').textContent = `${totalDetail}`;
            $.ajax({
                type: 'POST',
                url: `<?= base_url() ?>transaksi/detailTransaksi/${invoice}`,
                dataType: 'json',
                success: (hasil) => {
                    let isi = '';
                    hasil.forEach(function(item) {
                        isi += `<tr>
                                <td>${item.nama_barang}</td> 
                                <td>${item.jumlah_barang}</td> 
                                <td>Rp. ${item.harga_barang}</td> 
                           </tr>`
                    });
                    $('#targetData').html(isi);
                }
            });
        }

        function filterDate() {
            let tanggal_awal = $(`[name="startDate"]`).val();
            let tanggal_akhir = $(`[name="endDate"]`).val();
            if (tanggal_awal != "" && tanggal_akhir != "") {
                console.log(`${tanggal_awal}, ${tanggal_akhir}`);
                window.location.href = `<?= base_url() ?>transaksi/index/${tanggal_awal}/${tanggal_akhir}`;
            } else {
                alert("Tanggal Awal dan Akhir Harus Dipilih!!");
            }
        }
    </script>