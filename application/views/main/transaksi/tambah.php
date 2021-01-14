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
            <select class="js-example-basic-single form-control" id="id_stok" name="id_stok" required>
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
        <button class="btn btn-sm btn-primary shadow-sm mb-3" onclick="tambahBarang()"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang</button>
        <!-- Tabel Total Transaksi -->
        <div class="table-responsive">
            <form method="POST" id="transaksi_form">
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
                    <!-- btn submit disini dan total tagihan disini -->
                </table>
                <input type="hidden" name="total_harga_form" id="total_harga_form" value="">
                <button class="btn btn-sm btn-success shadow-sm mb-3 float-right" type="submit"><i class="fas fa-download fa-sm text-white-50"></i>Bayar & Cetak Transaksi</button>
            </form>
            <span class="float-left" style="font-weight: bold;font-size: 30px">
                Total Harga : Rp. <span id="total_harga">0</span>
            </span>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#transaksi_form').on('submit', function(event) {
            event.preventDefault();
            let count_data = 0;
            $('.nama_barang').each(function() {
                count_data += 1;
            });
            if (count_data > 0) {
                console.log(count_data);
                let form_data = $(this).serialize();
                console.log(form_data);
                $.ajax({
                    url: "<?= base_url() ?>transaksi/tambahTransaksi",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        if (confirm("Transaksi Sukses.\nApakah anda ingin mencetak data?")) {

                        } else {
                            location.reload();
                        }
                    }
                })
            } else {
                alert("Transaksi anda masih kosong!!!");
            }
        });
    });
    let harga = 0;
    let input_jumlah_beli = document.getElementById("jumlah_beli");
    let num = 0;
    input_jumlah_beli.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            tambahBarang();
        }
    });

    function tambahBarang() {
        let id_stok = $('#id_stok').val();
        let jumlah_beli = $('#jumlah_beli').val();
        num = num + 1;
        if (jumlah_beli > 0) {
            $.ajax({
                type: 'POST',
                data: `id_stok=${id_stok}`,
                url: '<?= base_url() . "stokpenjualan/getStokPenjualan" ?>',
                dataType: 'json',
                success: (hasil) => {
                    $("#table_pembelian").find('tbody')
                        .append(`<tr id="produk_${num}">
                                <td id="name-product-${num}">
                                    ${hasil.nama_stok}
                                </td>
                                <td>
                                    <input class="form-control" name="qty_beli-${num}" type="number" id="qty_beli[${num}]" value="${jumlah_beli}">
                                </td>
                                <td id="price-${num}">${hasil.harga_stok}</td>
                                <td id="subtotal-${num}">
                                    ${jumlah_beli * hasil.harga_stok}
                                </td>
                                <td>
                                    <a class="btn btn-warning" onclick="editProduk('${num}')">Edit</a>
                                    <button class="btn btn-danger" onclick="hapusProduk('${num}')">Hapus</button>
                                </td>
                                </tr>`);
                    $("#table_pembelian").find('tbody')
                        .append(
                            `
                            <tr id="form_${num}">
                                <input class="nama_barang" type="hidden" name="hidden_nama_barang[]" id="nama_barang${num}" value="${hasil.nama_stok}">
                                <input type="hidden" name="hidden_jumlah_barang[]" id="jumlah_barang${num}" value="${document.getElementById(`qty_beli[${num}]`).value}">
                                <input type="hidden" name="hidden_harga_barang[]" id="harga_barang${num}" value="${document.getElementById(`subtotal-${num}`).innerText}">
                            </tr>
                            `
                        );
                    harga += jumlah_beli * hasil.harga_stok;
                    $('#total_harga').html(harga);
                    $(`[name="total_harga_form"]`).val(harga);
                }
            })
            $('#jumlah_beli').val('');

        } else {
            alert("Jumlah Beli Tidak Bisa Kurang Dari 0");
        }
    }

    function editProduk(id) {
        let current_subtotal = document.getElementById(`subtotal-${id}`).innerText;
        let current_qty_update = $(`[name="qty_beli-${id}"]`).val();
        if (current_qty_update > 0) {
            let current_price = document.getElementById(`price-${id}`).innerText;
            harga -= current_subtotal;
            harga += current_qty_update * current_price;
            document.getElementById(`subtotal-${id}`).innerText = `${current_qty_update * current_price}`;
            document.getElementById(`harga_barang${id}`).value = `${current_qty_update * current_price}`;
            document.getElementById(`jumlah_barang${id}`).value = `${current_qty_update}`;
            $('#total_harga').html(harga);
            $(`[name="total_harga_form"]`).val(harga);
        } else {
            alert("Jumlah minimal 1");
        }
    }

    function hapusProduk(id) {
        let current_subtotal = document.getElementById(`subtotal-${id}`).innerText;
        harga -= current_subtotal;
        $('#total_harga').html(harga);
        $(`[name="total_harga_form"]`).val(harga);
        $(`#produk_${id}`).remove();
        $(`#form_${id}`).remove();
    }

    function cetakTransaksi() {
        let invoice = "INV" + new Date().getTime();
        if (harga > 0) {
            if (confirm("Yakin ingin Bayar?")) {

                console.log(`${invoice}\n`);
            }
        } else {
            alert("Cetak Gagal (Transaksi Kosong)");
        }
    }
</script>