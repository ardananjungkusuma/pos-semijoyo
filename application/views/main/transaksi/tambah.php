<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kasir</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi Pembelian</h6>
    </div>
    <div class="card-body">
        <b style="color: red;"><?= validation_errors(); ?></b>
        <div class="form-group">
            <label>Tanggal Pembelian : </label>
            <label id="date"><?= date('d-m-Y') ?></label><br>
            <label>Nama Distributor</label>
            <select class="form-control" id="id_stok" name="id_stok" required>
                <option value="Pilih Barang">Pilih Barang</option>
                <?php foreach ($stok as $s) {
                ?>

                    <option value="<?= $s['id_stok'] ?>"><?= $s['nama_stok'] ?></option>
                <?php              } ?>
            </select>
            <label>Jumlah Barang</label>
            <input type="number" id="jumlah_beli" name="jumlah_beli" class="form-control mb-2" placeholder="0" required>
        </div>
        <a href="<?= base_url() ?>transaksi" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
        <button class="btn btn-sm btn-primary shadow-sm mb-3" onclick="tambahBarang()"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Barang</button>
        <span class="float-right" style="font-weight: bold;font-size: 30px">
            Total Harga : <span id="total_harga">0</span>
        </span>


        <!-- Tabel Total Transaksi -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="table_pembelian">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabel_transaksi">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    let num = 0;
    let harga = 0;

    function tambahBarang() {
        let id_stok = $('#id_stok').val();
        let jumlah_beli = $('#jumlah_beli').val();
        if (jumlah_beli > 0) {
            $.ajax({
                type: 'POST',
                data: `id_stok=${id_stok}`,
                url: '<?= base_url() . "stokpenjualan/getStokPenjualan" ?>',
                dataType: 'json',
                success: (hasil) => {
                    $("#table_pembelian").find('tbody')
                        .append(`<tr id="produk[${num}]">
                                <td>${hasil.nama_stok}</td>
                                <td>
                                    <input class="form-control" type="number" id="qty_beli[${num}]" value="${jumlah_beli}">
                                </td>
                                <td>${hasil.harga_stok}</td>
                                <td  id="subtotal[${num}]">${jumlah_beli * hasil.harga_stok}</td>
                                <td>
                                    <button class="btn btn-warning" onclick="editProduk('${num}')">Edit</button>
                                    <button class="btn btn-danger" onclick="hapusProduk('${num}')">Hapus</button>
                                </td>
                             </tr>`);
                    harga += jumlah_beli * hasil.harga_stok;
                    $('#total_harga').html(harga);
                }
            })
            $('#jumlah_beli').val('');
            num++;
        } else {
            alert("Jumlah Beli Tidak Bisa Kurang Dari 0");
        }
    }

    function editProduk(id) {
        let qty_update = $(`#qty_beli[${id}]`).val();
        console.log(qty_update);
        // document.getElementById(`subtotal[${id}]`).value()
    }

    function hapusProduk(id) {
        let current_price = document.getElementById(`subtotal[${id}]`).innerText;
        harga -= current_price;
        $('#total_harga').html(harga);
        var row = document.getElementById(`produk[${id}]`);
        row.parentNode.removeChild(row);
    }
</script>